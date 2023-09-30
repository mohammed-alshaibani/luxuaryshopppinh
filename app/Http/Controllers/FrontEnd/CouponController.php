<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    
     //
     /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id')->paginate(5);
        return view('BackEnd.Admin.Coupon.Index', compact('coupons'));
    }

    /**
     * Show the form for creating a new coupon.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('BackEnd.Admin.Coupon.Create');
    }

    /**
     * Store a newly created coupon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'value' => 'required|numeric',
            'type' => 'required|in:fixed,per',
            'max_user' => 'required|integer',
            'valid_date' => 'required|date',
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->input('code');
        $coupon->value = $request->input('value');
        $coupon->type = $request->input('type');
        $coupon->max_user = $request->input('max_user');
        $coupon->valid_date = $request->input('valid_date');
        $coupon->save();

        return redirect()->route('Coupon.Index')
            ->with('success', 'تم لإضافة الكوبون بنجاح');
    }

   
    /**
     * Show the form for editing the specified coupon.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        return view('BackEnd.Admin.Coupon.Edit', compact('coupon'));
    }

    /**
     * Update the specified coupon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $id,
            'value' => 'required|numeric',
            'type' => 'required|in:fixed,per',
            'max_user' => 'required|integer',
            'valid_date' => 'required|date',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->input('code');
        $coupon->value = $request->input('value');
        $coupon->type = $request->input('type');
        $coupon->max_user = $request->input('max_user');
        $coupon->valid_date = $request->input('valid_date');
        $coupon->save();

        return redirect()->route('Coupon.Index')
            ->with('success', 'تم تحديث الكوبون بنجاح');
    }

    /**
     * Remove the specified coupon from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
   
    public function destroy(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        if (empty($coupon)) {
            return redirect()->route('Coupon.Index');
        }
        $coupon->delete();
        return redirect()->route('Coupon.Index')->with('success', 'تم الحذف بنجاح');
    }


    /**
     * Display the specified category
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // Retrieve the coupon code from the request (assuming it is passed as a query parameter)
        $couponCode = request()->query('coupon');

        // Calculate the total price (assuming it is a property of the category model)
        $totalPrice = $category->price;

        // Apply the discount if a valid coupon code is provided
        if ($couponCode) {
            // Fetch the discount percentage from the database based on the coupon code
            $discountPercentage = $this->getDiscountPercentage($couponCode);


          // Apply the discount if a valid coupon code is provided
          if ($discountPercentage) {
            $discount = ($discountPercentage / 100) * $totalPrice;
            $totalPrice -= $discount;
        }
    }
        return view('dashboard.Admin.Category.Index', compact('category', 'totalPrice'));
    }

    public function applyCouponCode(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        
        // Retrieve the coupon from the database
        $coupon = Coupon::where('code', $couponCode)->first();
        
        if ($coupon) {
            // Apply the coupon logic here
            
            // For example, you can retrieve the discount percentage
            // and apply it to a product price
            $discountPercentage = $coupon->discount_percentage;
            $productPrice = 100; // Example product price
            $discountedPrice = $productPrice - ($productPrice * $discountPercentage / 100);
            
            // Store the discount information in the session
            Session::put('coupon', [
                'code' => $couponCode,
                'discounted_price' => $discountedPrice
            ]);
            
            // Return the response with the discounted price or any other information
            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully',
                'discounted_price' => $discountedPrice
            ]);
        } else {
            // Clear the coupon information from the session
            Session::forget('coupon');
            
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code'
            ]);
        }
    }
}
