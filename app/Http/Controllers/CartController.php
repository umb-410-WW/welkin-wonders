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

        // Ensure that increasing the quantity of given product does not exceed stock
        $currentQuantity = $item ? $item->quantity : 0;
        if ($currentQuantity + 1 > $product->stock_quantity) {
            return back()->with('error', 'Not enough stock for given request.');
        }

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
        // Check that the requested quantity is reasonable
        $requestedQuantity = (int) $request->input('quantity');
        if ($requestedQuantity < 1) {
            return back()->with('error', 'Quantity must be greater than zero.');
        }

        // Check the available quantity of the product
        $maxQuantity = $item->product->stock_quantity;
        if ($requestedQuantity > $maxQuantity) {
            return back()->with('error', 'Not enough stock for given request.');
        }

        // Otherwise, it should be safe to update the cart quantity for the given product
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
