<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    // Establish that each cart item belongs to some product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
