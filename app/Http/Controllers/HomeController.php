<?php

namespace App\Http\Controllers;

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

    // Directs the user to the admin dashboard when called
    public function admin() : view
    {
        return view('admin.index');
    }
}
