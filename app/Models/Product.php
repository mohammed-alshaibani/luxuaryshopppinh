<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    
    protected $fillable = [
        'tag',
        'name',
        'seller_price',
        'original_price',
        'different_price',
        'discounted_price',
        'description',
        'quantity',
        'category_id',
        'subcategory_id',
        'seller_id',
        'status',
        'featured',
        'trend',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function images()
  {
    return $this->hasMany(Images::class, 'product_id');
   }
   
public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('quantity');
    }

    public function returnOrderDetails()
    {
        return $this->hasMany(ReturnOrderDetail::class);
    }
}
