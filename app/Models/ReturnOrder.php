<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnOrder extends Model
{
    use HasFactory;
    protected $table = 'return_orders';

    protected $fillable = [
        'order_id',
        'reason',
        'note',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function returnOrderDetails()
{
    return $this->hasMany(ReturnOrderDetail::class, 'return_id');
}
}
