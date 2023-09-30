<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';

    
    protected $fillable = [
        'user_id',
        'prod_id',
       'user_review',
        
    ];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function rating(){

        return $this->belongsTo(Rate::class,'user_id','user_id');
    }
}
