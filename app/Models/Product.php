<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'is_active'
    ];

    // Establish a one-to-one relationship with ProductImage table
    public function image()
    {
        return $this->hasOne(ProductImage::class);
    }

    // Establish a one-to-many relationship between Reviews and products
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
