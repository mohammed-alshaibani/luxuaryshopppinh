<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\ReturnOrder;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ReturnOrderDetail;

class ReturnController extends Controller
{
     public function index()
    {
        $returns = ReturnOrder::orderBy('id', 'desc')->paginate(10);
        return view('BackEnd.Admin.Return.Index', compact('returns'));
      }
  
   public function create($id)
   {
       $order = Order::with('orderDetails')->find($id);
       $products = Product::all();
       $defaultStatus = 'قيد التحقق'; // Set the default status value
       return view('FrontEnd.create_return', compact('order', 'defaultStatus'));
   }
   
   public function store(Request $request)
   {
       $validatedData = $request->validate([
           'order_id' => 'required|exists:orders,id',
           'reason' => 'required',
           'note' => 'nullable',
           'status' => 'required|in:قيد التحقق,ملغي,تم الإرجاع',
           'return_order_details' => 'required|array',
           'return_order_details.*.product_id' => 'required|exists:products,id',
           'return_order_details.*.quantity' => 'required|integer|min:1',
       ]);
   
       DB::transaction(function () use ($validatedData) {
           $returnOrder = ReturnOrder::create([
               'order_id' => $validatedData['order_id'],
               'reason' => $validatedData['reason'],
               'note' => $validatedData['note'],
               'status' => $validatedData['status'],
           ]);
   
           foreach ($validatedData['return_order_details'] as $detailData) {
               ReturnOrderDetail::create([
                   'order_id' => $validatedData['order_id'],
                   'product_id' => $detailData['product_id'],
                   'return_id' => $returnOrder->id,
                   'quantity' => $detailData['quantity'],
               ]);
           }
       });
   
       return redirect()->route('FrontEnd.Index');
   }
   
   public function edit($id)
  {
    $return = ReturnOrder::findOrFail($id);
    $return_product = ReturnOrderDetail::where('return_id', $id)->get();
    $order = $return->order;
    $products = Product::all(); // Retrieve all products
    return view('BackEnd.Admin.Return.Edit', compact('return', 'order', 'products', 'return_product'));
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'reason' => 'required',
            'note' => 'nullable',
            'status' => 'required|in:قيد التحقق,ملغي,تم الإرجاع',
            'return_order_details' => 'required|array',
            'return_order_details.*.product_id' => 'required|exists:products,id',
            'return_order_details.*.quantity' => 'required|integer|min:1',
        ]);
    
        DB::transaction(function () use ($validatedData, $id) {
            $returnOrder = ReturnOrder::findOrFail($id);
            $returnOrder->update([
                'order_id' => $validatedData['order_id'],
                'reason' => $validatedData['reason'],
                'note' => $validatedData['note'],
                'status' => $validatedData['status'],
            ]);
    
            $returnOrder->returnOrderDetails()->delete();
    
            foreach ($validatedData['return_order_details'] as $detailData) {
                $returnOrder->returnOrderDetails()->create([
                    'order_id' => $validatedData['order_id'],
                    'product_id' => $detailData['product_id'],
                    'return_id' => $returnOrder->id,
                    'quantity' => $detailData['quantity'],
                ]);
            }
        });
    
        return redirect()->route('BackEnd.Return.Index')->with('success', 'تم تحديث طلب الإرجاع بنجاح');
    }
/**Return Order */
public function index_user()
{
    $returns =  ReturnOrder::orderBy('id', 'desc')->paginate(10);
    $returns_detail=ReturnOrderDetail::all();
    return view('BackEnd.User.Return.Index', compact('returns'));
}


    public function edit_user($id)
   {
    $return = ReturnOrder::findOrFail($id);
    $return_product = ReturnOrderDetail::where('return_id', $id)->get();
    $order = $return->order;
    $products = Product::all(); // Retrieve all products
    return view('BackEnd.User.Return.Edit', compact('return', 'order', 'products', 'return_product'));
  }
    
    public function update_user(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'reason' => 'required',
            'note' => 'nullable',
            'status' => 'required|in:قيد التحقق,ملغي,تم الإرجاع',
            'return_order_details' => 'nullable|array',
            'return_order_details.*.product_id' => 'nullable|exists:products,id',
            'return_order_details.*.quantity' => 'nullable|integer|min:1',
        ]);
    
        DB::transaction(function () use ($validatedData, $id) {
            $returnOrder = ReturnOrder::findOrFail($id);
            $returnOrder->update([
                'order_id' => $validatedData['order_id'],
                'reason' => $validatedData['reason'],
                'note' => $validatedData['note'],
                'status' => $validatedData['status'],
            ]);
    
           // $returnOrder->returnOrderDetails()->delete();
            $returnOrder->returnOrderDetails()->where('return_id', $returnOrder->id)->delete();

            foreach ($validatedData['return_order_details'] as $detailData) {
                $returnOrder->returnOrderDetails()->create([
                    'order_id' => $validatedData['order_id'],
                    'product_id' => $detailData['product_id'],
                    'return_id' => $returnOrder->id,
                    'quantity' => $detailData['quantity'],
                ]);
            }
        });
    
        return redirect()->route('User.Return.Index')->with('success', 'تم تحديث طلب الإرجاع بنجاح');
    }

    /**User */
    public function my_returns($id)
  {
    $return = ReturnOrder::findOrFail($id);
    $return_product = ReturnOrderDetail::where('return_id', $id)->get();
    $order = $return->order;
    $products = Product::all();
    return view('FrontEnd.ReturnOrderDetail', compact('return_product','return','order','products'));
     }

     public function index_show()
   {
    $returns =  ReturnOrder::orderBy('id', 'desc')->paginate(10);
    $returns_detail=ReturnOrderDetail::all();
    return view('FrontEnd.IndexReturn', compact('returns'));
    }


public function search_orders(Request $request)
{
    if ($request->ajax()) {
        $status = $request->input('searchInput'); // Retrieve the search input
        if ($status === '') {
            $data = ReturnOrder::orderBy('id', 'desc')->get();
        } else {
            $data = ReturnOrder::where('status', 'LIKE', "%{$status}%")
                         ->orderBy('id', 'desc')
                         ->get();
        }
        return view('BackEnd.User.Return.search_page', ['returns' => $data]);
    }
}
/*
public function search_return(Request $request)
{
    if ($request->ajax()) {
        $status = $request->input('searchInput'); // Retrieve the search input
        if ($status === '') {
            $data = ReturnOrder::orderBy('id', 'desc')->get();
        } else {
            $data = ReturnOrder::where('status', 'LIKE', "%{$status}%")
                         ->orderBy('id', 'desc')
                         ->get();
        }
        return view('BackEnd.Admin.Return.search_page', ['returns' => $data]);
    }
}*/
public function search_return(Request $request)
{
    if ($request->ajax()) {
        $status = $request->input('searchInput'); // Retrieve the search input
        if ($status === '') {
            $data = ReturnOrder::orderBy('id', 'desc')->get();
        } else {
            $data = ReturnOrder::where('status', 'LIKE', "%{$status}%")
                         ->orderBy('id', 'desc')
                         ->get();
        }
        return view('BackEnd.Admin.Return.search_page', ['returns' => $data]);
    }
}
}
