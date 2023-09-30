<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quant',
        'return_status',];
         // Define the relationship with Order model
   public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}
}

