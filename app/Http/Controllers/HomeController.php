<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    // Directs the user to the About Us page
    public function about() : view
    {
        return view('about');
    }

    // Directs the user to the Contact Us page
    public function contact() : view
    {
        return view('contact');
    }

    // Directs the user to the Readings page
    public function readings() : view
    {
        return view('readings');
    }

    // Directs the user to the Shop page
    public function shop(): view
    {
        return view('shop');
    }

    // Directs the user to the admin dashboard when called
    public function admin() : view
    {
        // All products
        $products = Product::all();

        // Pass all the products to the admin page for editing
        return view('admin.index', compact('products'));
    }
}
