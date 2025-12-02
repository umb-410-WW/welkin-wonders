<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    // Establish one-to-many relationship between carts and CartItems
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
