<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutOrderDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'url',
        'id_out_order',
        'user_id',
        'qty',
        'size',
        'price',
        'color',
        'note',
    ];

    public function outOrder()
    {
        return $this->belongsTo(OutOrder::class, 'id_out_order', 'id');
    }
}
