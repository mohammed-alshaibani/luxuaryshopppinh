<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'address', 'note'];

    public function products()
   {
    return $this->hasMany(Product::class, 'seller_id');
   }

}
