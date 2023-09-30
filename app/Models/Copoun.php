<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copoun extends Model
{
    use HasFactory;
    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'value',
        'type',
        'max_user',
        'usered_copuon',
        'valid_date',
    ];

    public function couponDetails(): HasMany
    {
        return $this->hasMany(CouponDetail::class);
    }    
}
