<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // App\Models\Product.php
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'description',
        'category_id',
        'image',
        'seller_id'
    ];
}
