<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutOrderController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'status' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'comment' => 'nullable|string',
            'order_items' => 'required|array',
            'order_items.*.url' => 'required|string',
            'order_items.*.qty' => 'required|integer',
            'order_items.*.size' => 'required|string',
            'order_items.*.price' => 'required|numeric',
            'order_items.*.color' => 'required|string',
            'order_items.*.note' => 'nullable|string',
        ]);

        $outOrder = OutOrder::create($validatedData);

        foreach ($validatedData['order_items'] as $orderItemData) {
            $outOrder->orderItems()->create($orderItemData);
        }

        return response()->json(['message' => 'تم إنشاء الطلب']);
    }

    public function show(OutOrder $outOrder)
    {
        $outOrder->load('orderItems');
        return response()->json($outOrder);
    }

    public function update(Request $request, OutOrder $outOrder)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'status' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'comment' => 'nullable|string',
            'order_items' => 'required|array',
            'order_items.*.url' => 'required|string',
            'order_items.*.qty' => 'required|integer',
            'order_items.*.size' => 'required|string',
            'order_items.*.price' => 'required|numeric',
            'order_items.*.color' => 'required|string',
            'order_items.*.note' => 'nullable|string',
        ]);

        $outOrder->update($validatedData);

        $outOrder->orderItems()->delete();

        foreach ($validatedData['order_items'] as $orderItemData) {
            $outOrder->orderItems()->create($orderItemData);
        }

        return response()->json(['message' => 'تم تحديث الطلب']);
    }

}
