<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ReturnOrderDetail extends Model
{
    use HasFactory; 
   
    protected $table = 'return_order_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'return_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function returnOrderDetails() // Update the method name
    {
        return $this->belongsTo(ReturnOrder::class, 'return_id');
    }
}