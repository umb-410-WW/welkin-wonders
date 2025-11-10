<?php

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
    Route::get('/shop', 'shop')->name('shop');

    /* Routes only available to Administrators. Only Administrators should be able to:
    - View the admin dashboard
    */
    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('/admin/dashboard', 'admin')->name('admin.dashboard');
    });
});

// Product Routes
Route::resource('products', ProductController::class);
Route::controller(ProductController::class)->group(function () {
    // Routes available to all users
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/{product:slug}', 'show')->name('products.show');

    /* Routes only available to Administrators. Only Administrators should be able to:
    - Create new products
    - Store products
    - See the Edit products view
    - Update products
    - Delete products
    */
    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/{product:slug}/edit', 'edit')->name('products.edit');
        Route::put('/products/{product:slug}', 'update')->name('products.update');
        Route::delete('/products/{product:slug}', 'destroy')->name('products.destroy');
    });
});
