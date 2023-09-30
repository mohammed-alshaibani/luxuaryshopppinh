<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CopounDetail extends Model
{
    use HasFactory;
    
    protected $table = 'coupon_details';
    protected $fillable = [
        'userdcode',
        'usered_copuon_de',
    ];

    

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
