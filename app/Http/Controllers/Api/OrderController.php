<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'fullname' => 'required|string',
            'phone' => 'required|string',
            'status' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'town' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'discount' => 'nullable|numeric',
            'total' => 'required|numeric',
            'delivery_price' => 'required|numeric',
            'note' => 'nullable|string',
            'return_status' => 'nullable|string',
            'payment_method' => 'required|string',
            'total_dis' => 'required|numeric',
            'coupon_used' => 'nullable|string',
            'order_details' => 'required|array',
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.price' => 'required|numeric',
            'order_details.*.quant' => 'required|integer',
            'order_details.*.return_status' => 'nullable|string',
        ]);

        // Create the order
        $order = Order::create($validatedData);

        // Create order details
        foreach ($validatedData['order_details'] as $orderDetailData) {
            $order->orderDetails()->create($orderDetailData);
        }

        return response()->json(['message' => 'Order created successfully.']);
    }
}
