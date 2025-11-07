<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; // HomeController

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

// Controls where the user is directed upon login
Route::controller(HomeController::class)->group(function () {

    Route::get('/about', 'about')->name('about'); // Goes to the About Us page
    Route::get('/contact', 'contact')->name('contact'); // Goes to the Contact Us page
    Route::get('/admin/dashboard', 'admin')->middleware(['auth', 'admin'])->name('admin.dashboard'); // Goes to the admin dashboard & uses the Admin middleware to check that the user is an admin
});

