<?php

use App\Http\Controllers\CheckoutController;

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
        Route::get('/products/{product:slug}/edit', 'edit')->name('products.edit');
        Route::put('/products/{product:slug}/update', 'update')->name('products.update');
        Route::delete('/products/{product:id}', 'destroy')->name('products.destroy');
    });

    // Routes available to all users
    Route::get('/shop', 'index')->name('products.shop');
    Route::get('/products/{product:slug}', 'show')->name('products.show');


    //temp checkout page 
    Route::post('/create-checkout', [CheckoutController::class, 'createCheckout'])->name('checkout.create');

    Route::post('/checkout/{product}', [CheckoutController::class, 'createCheckout'])->name('checkout.create');

    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

});
