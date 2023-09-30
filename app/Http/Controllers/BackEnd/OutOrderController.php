<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OutOrder;
use App\Models\OutOrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OutOrderController extends Controller
{
    
    public function Order_out(Request $request)
    {
        // Validate the request data
        $request->validate([
            'url' => 'required|array',
            'qty' => 'required|array',
            'size' => 'required|array',
            'price' => 'required|array',
            'color' => 'required|array',
            'note' => 'nullable|array',
        ]);
    
        $query = OutOrder::max('id');
        $data1 = new OutOrder();
        $data1->date = Carbon::now();
        $data1->status = "قيد الانتظار";
        $data1->comment = "سيتم التواصل معاك في أقرب وقت ممكن";
        $data1->user_id = auth::id();
        $data1->save();
    
        foreach ($request->url as $key => $items) {
            // Check if all required fields have values
            if (isset($request->qty[$key], $request->size[$key], $request->price[$key], $request->color[$key], $request->info[$key])) {
                $data = new OutOrderDetail();
                $data->url = $items;
                $data->id_out_order = $query + 1;
                $data->user_id = auth::id();
                $data->qty = $request->qty[$key];
                $data->size = $request->size[$key];
                $data->price = $request->price[$key];
                $data->color = $request->color[$key];
                $data->note = $request->info[$key];
                $data->save();
            }
        }
    
        return redirect('Order/my_out_orders');
    }

    public function my_out_order(){
        $out_orders =  OutOrder::where('user_id', auth::id())->get();
        $data2['out_orders'] = $out_orders;
        return view('FrontEnd.my_out_orders',$data2);
    }

    public function show_out_order_detaeal($id){
        $show_order = OutOrder::where('id',$id)->first();
        $deteal = OutOrderDetail::where('id_out_order',$id)->get();
        $data['s'] = $show_order;
        $data['l'] = $deteal;
        return view('FrontEnd.show_my_out_order',$data);
    }
    /**Order Admin */
    public function all_order_detaeal()
 {
    $orderDetails = OutOrder::with('user')->orderBy('id', 'desc')->paginate(10);
    return view('BackEnd.Admin.OutOrder.Index', compact('orderDetails'));
  }
    public function edit_order_detail($id)
   {
    $s = OutOrder::findOrFail($id);
    $l = $s->orderItems; // Retrieve the order items related to the OutOrder
    $statusOptions = ['قيد الإنتظار', 'تم الطلب', 'في مستودعتنا', 'تم التوصيل', 'ملغي'];
    return view('BackEnd.Admin.OutOrder.Edit', compact('s', 'statusOptions', 'l'));
   }
   public function update_order_detail(Request $request, $id)
   {
    $order = OutOrder::findOrFail($id);
    $order->status = $request->input('status');
    $order->comment = $request->input('comment');
    $order->save();

    // Redirect back or to a specific route after the update
    return redirect()->route('order_out_details')->with('success', 'Order updated successfully');
    }

    /**Order User */
    public function all_order_user()
    {
        $orderDetails = OutOrder::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('BackEnd.User.OutOrder.Index', compact('orderDetails'));
    }
        public function edit_order_user($id)
       {
        $s = OutOrder::findOrFail($id);
        $l = $s->orderItems; // Retrieve the order items related to the OutOrder
        $statusOptions = ['قيد الإنتظار', 'تم الطلب', 'في مستودعتنا', 'تم التوصيل', 'ملغي'];
        return view('BackEnd.User.OutOrder.Edit', compact('s', 'statusOptions', 'l'));
       }
       public function update_order_user(Request $request, $id)
       {
        $order = OutOrder::findOrFail($id);
        $order->status = $request->input('status');
        $order->comment = $request->input('comment');
        $order->save();
    
        // Redirect back or to a specific route after the update
        return redirect()->route('User.order_out_details')->with('success', 'Order updated successfully');
        }

        
public function search_orders(Request $request)
{
    if ($request->ajax()) {
        $status = $request->input('searchInput'); // Retrieve the search input
        if ($status === '') {
            $data = OutOrder::orderBy('id', 'desc')->get();
        } else {
            $data = OutOrder::where('status', 'LIKE', "%{$status}%")
                         ->orderBy('id', 'desc')
                         ->get();
        }
        return view('BackEnd.User.OutOrder.search_page', ['orderDetails' => $data]);
    }
}

public function search_order(Request $request)
{
    if ($request->ajax()) {
        $status = $request->input('searchInput'); // Retrieve the search input
        if ($status === '') {
            $data = OutOrder::orderBy('id', 'desc')->get();
        } else {
            $data = OutOrder::where('status', 'LIKE', "%{$status}%")
                         ->orderBy('id', 'desc')
                         ->get();
        }
        return view('BackEnd.Admin.OutOrder.search_page', ['orderDetails' => $data]);
    }
}

public function search_outorders(Request $request)
{
    if ($request->ajax()) {
        $searchInput = $request->searchput; // Corrected the variable name
        $data = OutOrder::where('id', 'like', "%{$searchInput}%")
                      ->orderBy("id", "desc") // Corrected "orderby" to "orderBy"
                      ->get();  // Added "get()" to retrieve the results
                      return view('BackEnd.Admin.OutOrder.search_page', ['orderDetails' => $data]);
        }
}

public function search_for_outorder(Request $request)
{
    if ($request->ajax()) {
        $searchInput = $request->searchput; // Corrected the variable name
        $data = OutOrder::where('id', 'like', "%{$searchInput}%")
                      ->orderBy("id", "desc") // Corrected "orderby" to "orderBy"
                      ->get();  // Added "get()" to retrieve the results
                      return view('BackEnd.User.OutOrder.search_page', ['orderDetails' => $data]);
        }
}
}
