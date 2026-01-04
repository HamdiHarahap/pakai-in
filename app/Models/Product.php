<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'price',
        'image'
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks() 
    {
        return $this->hasMany(ProductStock::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
        });
    }
}
