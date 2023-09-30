<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\CopounDetail;
use App\Models\Copoun;
use App\Models\Coin;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Paying;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**Copouns */
    public function addcoupon(Request $r){
        $cop = session()->get('cop');  
            $totals = 0;
            $newPrice = 0;
            $totals1 = 0;
      if(Auth::check()){
            if(session('cart'))
                foreach(session('cart') as $id => $details){
                 $totals += $details['price'] * $details['quantity'];
                 $totals1 = $totals;
                }        
            $result = Copoun::where('code',$r->coupon_code)->first();
            $c_d = CopounDetail::where('userdcode',$r->coupon_code)->first();
            if($result){
                $value = $result->value;
                $max = $result->max_user;
                $max_userd = $result->usered_copuon;
                if(date('y-m-d',strtotime(date('y-m-d'))) >= (date('y-m-d',strtotime($result->valid_date))) or  $max_userd >= $max ){
                    $status="error";
                    $msg="لقد انتهت صلاحيه الكوبون";
                }elseif($c_d  and $c_d->usered_copuon_de == Auth::id()){
                    $status="error";
                    $msg="هذا الكوبون مفعل في حسابك مسبقا";
                }else{
                    $data['usered_copuon_de'] = Auth::id();
                    $data['userdcode'] = $r->coupon_code;
                    CopounDetail::create($data);
                    if($result->type == 'per'){
                        $newPrice=($value/100)*$totals;
                        $totals=round($totals-$newPrice);
                        $totals1 = $totals1 - $totals; 
                         $status="success";
                         $msg="ـم تطبيق الخصم بنجاح";
 
                    }else{
                        $totals=$totals-$value;
                        $status="success";
                        $msg="ـم تطبيق الخصم بنجاح";
                        $totals1 = $totals1 - $totals;
                    }
                    if(!$cop){
                        $cop = [
                        $id => [
                            "totla" => $totals,
                            "dis" => $totals1,
                            "user_id" => Auth::id(),
                        ]];
                    }else{
                        $cop = [
                            $id => [
                                "totla" => $totals,
                                "dis" => $totals1,
                                "user_id" => Auth::id(),
                            ]];
                    }
                    session()->put('cop', $cop);
                    Copoun::where('code',$r->coupon_code)->update([
                        'usered_copuon' => $max_userd + 1,]);
                }
            }else{
                $status="error";
                $msg="لقد ادخلت كوبون غير صالح";
            }
        }else{
            $status="error";
                $msg="يجب ان يكون لديك حساب لتطبيق الخصم";
        }
        return response()->json(['status'=>$status,'msg'=>$msg,'total'=>$totals,'totaldis'=>$totals1]); 
    }

    /**Orders */
    public function order(Request $r)
    {
        if (Auth::check()) {
            $totals = 0;
            $dis = 0;
            $couponUsed = false; // Flag variable to track coupon usage
            if (session('cop')) {
                foreach (session('cop') as $id => $details) {
                    $totals = $details['totla'];
                    $dis = $details['dis'];
                    $user_id = $details['user_id'];
                    $couponUsed = true; 
                }
            } else {
                foreach (session('cart') as $id => $details) {
                    $totals += $details['price'] * $details['quantity'];
                    $couponUsed = false; 
                }
            } 
            $query = Order::max('id');
            $data['coupon_used'] = $couponUsed; // Store the coupon usage status in the data array
            $data['order_date'] = Carbon::now();
            $data['user_id'] = Auth::id();
            $data['fullname'] = $r->fullname;
            $data['phone'] = $r->phone;
            $data['status'] = "قيد الإنتظار";
            $data['country'] = $r->country;
            $data['city'] = $r->city;
            $data['total_dis'] = $dis;
            $data['coupon_used'] = $couponUsed; // Pass the flag value to the order data
            $data['address1'] = $r->address1;
            $data['address2'] = $r->address2;
            $data['payment_method'] = $r->flexRadioDefault;
            $data['total'] = $totals;
            $data['delivery_price'] = 0.00;
            $data['note'] = 'شكرا لطلبك من متجرنا';
            $order = Order::create($data);

            foreach (session('cart') as $key => $b) {
                $update_quantity = Product::find($b['idproudct']);
                $query1 = DB::table('order_details')->insert([
                    'order_id' => $order->id,
                    'product_id' => $b['idproudct'],
                    'price' => $b['price'],
                    'quant' => $b['quantity'],
                ]);
                Product::where('id', $b['idproudct'])->update([
                    'quantity' => $update_quantity->quantity - $b['quantity'],
                    'trend' => $b['quantity'],
                ]);

            }

            session()->forget('cop');
            session()->forget('cart');
            return redirect('Orders/my_orders');
        } else {
            return view('FrontEnd.checkpage');
        }
    }

    public function my_orders()
    {
        $my_orders = Order::where('user_id', auth()->id())->get();
        return view('FrontEnd.my_orders', compact('my_orders'));
    }

    public function payment(){
        $sho_payment = Paying::all();
        $data['L'] = $sho_payment;
        return view('checkpage',$data);
    }

    public function show_order_detaeal($id)
   {
        $show_order = Order::where('id',$id)->with('orderDetails.product')->find($id);
        $deteal = OrderDetail::where('order_id',$id)->get();
        $data['s'] = $show_order;
        $coin = Coin::all();
        $data['s'] = $show_order;
        $data['l'] = $deteal;
        $data['c'] = $coin;
        return view('FrontEnd.show_my_order', $data);
    }
  
    public function all_order_detaeal()
    {
        $orderDetails = Order::orderBy('id', 'desc')->paginate(10);
        return view('BackEnd.Admin.Order.Index', compact('orderDetails'));
    }
    public function edit_order_detail(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $statusOptions = ['قيد الإنتظار', 'تم الطلب', 'في مستودعتنا', 'تم التوصيل', 'ملغي'];
        $delivery_price = $order->delivery_price;
        $note = $order->note;
        return view('BackEnd.Admin.Order.Edit', compact('order', 'statusOptions', 'delivery_price', 'note'));
    }
 
    public function update_order_detaeal(Request $request, $id)
    {
        // Retrieve the order based on the provided ID
        $order = Order::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'status' => 'required',
            'phone' => 'required',
            'address1' => 'required',
            'address2' => 'required',
        ]);

        // Update the order with the new information
        $order->status = $request->input('status');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->delivery_price = $request->input('delivery_price'); 
        $order->note = $request->input('note');
        $order->save();

        // Redirect to a success page or perform any other necessary action
        return redirect()->route('order_details.index')->with('success', 'Order updated successfully');
    }


    public function add_rate(Request $r){
        $star_rated = $r->input('product_rating');
        $proudct_id = $r->input('proudct_id');
        if(Auth()){
        $userid =  Auth::id();  
        $userid =  Auth::id();
        $existing_rating = Rate::where('user_id', $userid)->where('prod_id', $proudct_id)->first();
            if($existing_rating){
                $existing_rating->update(['stars_rating' =>$star_rated]);
            }else{
                Rate::create([
                    'user_id' => Auth::id(),
                    'prod_id' => $proudct_id,
                   'stars_rating' => $star_rated,
                        ]);
            
            }
            return  redirect()->back();
        }else{
            return 'يجب تسجيل الدخول أولا';
        }
    }
 
    /**Order User */
    public function all_order_user()
    {
        $orderDetails = Order::orderBy('id', 'desc')->paginate(10);
         return view('BackEnd.User.Order.Index', compact('orderDetails'));
    }
    public function edit_order_user($id)
   {
    $order = Order::findOrFail($id);
    $statusOptions = ['قيد الإنتظار', 'تم الطلب', 'في مستودعتنا', 'تم التوصيل', 'ملغي'];
    $delivery_price = $order->delivery_price; // Add this line to get the delivery price
    $note = $order->note; // Add this line to get the note
    return view('BackEnd.User.Order.Edit', compact('order', 'statusOptions', 'delivery_price', 'note'));
   }
    public function update_order_user(Request $request, $id)
    {
        // Retrieve the order based on the provided ID
        $order = Order::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'status' => 'required',
            'phone' => 'required',
            'address1' => 'required',
            'address2' => 'required',],
            [
                'status.required' => ' قم بتغير حالة الطلب',
            ]);

        // Update the order with the new information
        $order->status = $request->input('status');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->delivery_price = $request->input('delivery_price'); 
        $order->note = $request->input('note');
        $order->save();

        // Redirect to a success page or perform any other necessary action
        return redirect()->route('User.order_details.index')->with('success', 'Order updated successfully');
    }

  
public function search_orders(Request $request)
{
    if ($request->ajax()) {
        $status = $request->input('searchInput'); // Retrieve the search input
        if ($status === '') {
            $data = Order::orderBy('id', 'desc')->get();
        } else {
            $data = Order::where('status', 'LIKE', "%{$status}%")
                         ->orderBy('id', 'desc')
                         ->get();
        }
        return view('BackEnd.Admin.Order.search_page', ['orderDetails' => $data]);
    }
}
public function search_order(Request $request)
{
    if ($request->ajax()) {
        $status = $request->input('searchInput'); // Retrieve the search input
        if ($status === '') {
            $data = Order::orderBy('id', 'desc')->get();
        } else {
            $data = Order::where('status', 'LIKE', "%{$status}%")
                         ->orderBy('id', 'desc')
                         ->get();
        }
        return view('BackEnd.User.Order.search_page', ['orderDetails' => $data]);
    }
}
public function searchbyorder(Request $request)
{
    if ($request->ajax()) {
        $searchInput = $request->searchput; // Corrected the variable name
        $data = Order::where('id', 'like', "%{$searchInput}%")
                      ->orderBy("id", "desc") // Corrected "orderby" to "orderBy"
                      ->get();  // Added "get()" to retrieve the results
                      return view('BackEnd.Admin.Order.search_page', ['orderDetails' => $data]);
        }
}
public function searchfororder(Request $request)
{
    if ($request->ajax()) {
        $searchInput = $request->searchput; // Corrected the variable name
        $data = Order::where('id', 'like', "%{$searchInput}%")
                      ->orderBy("id", "desc") // Corrected "orderby" to "orderBy"
                      ->get();  // Added "get()" to retrieve the results
                      return view('BackEnd.User.Order.search_page', ['orderDetails' => $data]);
        }
}
}

