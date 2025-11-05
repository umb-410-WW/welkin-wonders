<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Directs the user to the admin dashboard when called
    public function admin() {
        return view('admin.index');
    }
}
