<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Returns a listing of the given cart's items
    public function index()
    {

        // Get the given cart or create a cart for the user
        $cart = auth()->user()->cart()->with('items.product')->firstOrCreate([]);

        // Calculate the total for the given user's cart
        $total = $cart->items->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cart', 'total'));
    }

    // Add a product to the given cart
    public function add(Product $product)
    {
        // Get the given user's cart
        $cart = auth()->user()->cart()->firstOrCreate([]);

        // Check whether the item is in the cart
        $item = $cart->items()->where('product_id', $product->id)->first();

        // Check if the item is already in the cart
        if ($item) {
            $item->update(['quantity' => $item->quantity + 1]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return back()->with('success', 'Added to cart!');
    }

    // Update the quantity of the given cart item
    public function update(Request $request, CartItem $item)
    {
        $item->update([
            'quantity' => $request->quantity
        ]);

        return back();
    }

    // Remove the cart item from the given cart
    public function remove(CartItem $item)
    {
        $item->delete();
        return back();
    }
}
