<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'status',
        'user_id',
        'comment',
    ];

    public function orderItems()
    {
        return $this->hasMany(OutOrderDetail::class, 'id_out_order', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
