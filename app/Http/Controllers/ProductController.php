<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // All products
        $products = Product::all();

        // Pass all the products to the shop page
        return view('shop', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ensure the request is valid
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
        ]);

        // Convert the checkbox to a boolean
        $data['is_active'] = $request->has('is_active');

        // Create the Product
        $product = Product::create($data);

        // Create ProductImage entries as needed
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                // Create an associated ProductImage for each image
                $product->images()->create(['image_path' => $path]);
            }
        }

        // Redirects the Administrator back to the Admin dashboard
        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $user = Auth::user();

        // Only let customers see active products (Administrators can still see inactive products)
        if (!$product->is_active && (!$user || !($user->user_type === 'admin'))) {
            return redirect('/');
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'slug' => 'string|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'numeric',
            'stock_quantity' => 'integer',
            'is_active' => 'boolean',
        ]);

        $product->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }
}
