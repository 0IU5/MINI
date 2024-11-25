<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/landing-page', function () {
    return view('landing-page');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
    }); // hanya untuk admin

    Route::middleware('role:user')->group(function () {
        Route::resource('addresses', AddressController::class);
        Route::resource('carts', CartController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('product_orders', ProductOrderController::class);
        Route::resource('reviews', ReviewController::class);
        Route::post('/api/validate-promo', DiscountController::class);
    }); // hanya untuk user
});

require __DIR__ . '/auth.php';
