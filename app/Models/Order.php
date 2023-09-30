<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fullname',
        'phone',
        'status',
        'country',
        'city',
        'town',
        'address1',
        'address2',
        'discount',
        'total',
        'delivery_price	',
        'note',
        'return_status',
        'payment_method',
        'total_dis',
        'coupon_used',
    ];
    // Define the relationship with OrderDetail model
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

    public function returnedProducts()
    {
        return $this->hasMany(ReturnOrder::class);
    }
}
