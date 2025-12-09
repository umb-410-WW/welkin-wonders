<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use function Pest\Laravel\get;

// HomeController
Route::get('/', function () {
    return view('about');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Navigation bar link routes
Route::controller(HomeController::class)->group(function () {
    // Routes available to all users
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/readings', 'readings')->name('readings');

    /* Routes only available to Administrators. Only Administrators should be able to:
    - View the admin dashboard
    */
    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('/admin/dashboard', 'admin')->name('admin.dashboard');
    });
});

// Product Routes
Route::controller(ProductController::class)->group(function () {
    /* Routes only available to Administrators. Only Administrators should be able to:
    - Create new products
    - Store products
    - See the Edit products view
    - Update products
    - Delete products
    */

    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/{product:id}/edit', 'edit')->name('products.edit');
        Route::put('/products/{product:id}', 'update')->name('products.update');
        Route::delete('/products/{product:id}', 'destroy')->name('products.destroy');
    });

    // Routes available to all users
    Route::get('/shop', 'index')->name('products.shop');
    Route::get('/products/{product:slug}', 'show')->name('products.show');
    Route::get('/random', 'random')->name('products.random');
});

// Cart Routes
Route::controller(CartController::class)->group(function () {
    /* Routes only available to logged-in users:
    - View their given cart
    - Add a product to their cart
    - Update an item (e.g. quantity) in their cart
    - Remove an item from their cart
    */
   Route::middleware(['auth', 'verified'])->group(function () {
       Route::get('/cart', 'index')->name('cart.index');
       Route::post('/cart/add/{product}', 'add')->name('cart.add');
       Route::post('/cart/update/{item}', 'update')->name('cart.update');
       Route::post('/cart/remove/{item}', 'remove')->name('cart.remove');
   });
});
