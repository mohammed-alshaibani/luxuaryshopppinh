<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use App\Models\CouponDetail;
class CopounController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');

        // Check if the coupon exists
        $coupon = Coupon::where('code', $couponCode)->first();

        if (!$coupon) {
            return response()->json(['message' => 'Invalid coupon code'], 404);
        }

        // Check if the coupon is already used by the user
        $userId = auth()->user()->id; // Assuming the user is authenticated
        $couponDetail = CouponDetail::where('coupon_id', $coupon->id)
            ->where('user_id', $userId)
            ->first();

        if ($couponDetail) {
            return response()->json(['message' => 'الكوبون مفعل من قبل في الحساب'], 400);
        }

        // Create a new coupon detail entry for the user
        $couponDetail = new CouponDetail([
            'user_id' => $userId,
        ]);

        // Associate the coupon detail with the coupon
        $coupon->couponDetails()->save($couponDetail);

        return response()->json(['message' => 'Coupon applied successfully'], 200);
    }

    public function removeCoupon()
    {
        // Remove the coupon from the user logic goes here
        // Assuming the user is authenticated

        $userId = auth()->user()->id;
        $couponDetail = CouponDetail::where('user_id', $userId)->first();

        if (!$couponDetail) {
            return response()->json(['message' => 'Coupon not found for the user'], 404);
        }

        $couponDetail->delete();

        return response()->json(['message' => 'Coupon removed'], 200);
    }
}