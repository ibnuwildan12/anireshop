<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\PaymentVerificationController;

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

//Membuat Route Authentikasi Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])
         ->name('admin.dashboard');
    Route::get('/admin/payments', [PaymentVerificationController::class, 'index'])
         ->name('admin.payments.index');
    Route::get('/admin/payments/{order}', [PaymentVerificationController::class, 'show'])
         ->name('admin.payments.show');
    Route::post('/admin/payments/{order}/approve', [PaymentVerificationController::class, 'approve'])
         ->name('admin.payments.approve');
    Route::post('/admin/payments/{order}/reject', [PaymentVerificationController::class, 'reject'])
         ->name('admin.payments.reject');
});

//Membuat Route Authentikasi User
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])
         ->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])
         ->name('checkout.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])
         ->name('orders.show');
    Route::get('/orders/{order}/payment', [PaymentController::class, 'show'])
         ->name('payments.show');
    Route::post('/orders/{order}/payment', [PaymentController::class, 'store'])
         ->name('payments.store');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

//Membuat Route Cart
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])
    ->name('cart.add');
Route::put('/cart/update/{product}', [CartController::class, 'update'])
    ->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])
    ->name('cart.remove');

//Membuat Route Checkout
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');
});

//Membuat Route Order
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');
});