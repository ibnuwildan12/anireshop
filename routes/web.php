<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\PaymentVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ShippingRateController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

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

    Route::get('/admin/categories', [CategoryController::class, 'index'])
        ->name('admin.categories.index');

    Route::get('/admin/categories/create', [CategoryController::class, 'create'])
        ->name('admin.categories.create');

    Route::post('/admin/categories', [CategoryController::class, 'store'])
        ->name('admin.categories.store');

    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])
    ->name('admin.categories.edit');

    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])
        ->name('admin.categories.update');

    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('admin.categories.destroy');

    Route::get('/admin/products', [AdminProductController::class, 'index'])
        ->name('admin.products.index');

    Route::get('/admin/products/create', [AdminProductController::class, 'create'])
        ->name('admin.products.create');
    
    Route::post('/admin/products', [AdminProductController::class, 'store'])
        ->name('admin.products.store');

    Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])
        ->name('admin.products.edit');
    
    Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])
        ->name('admin.products.update');

    Route::delete('/admin/products/{product}/images/{image}', [AdminProductController::class, 'destroyImage'])
        ->name('admin.products.images.destroy');

    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])
        ->name('admin.products.destroy');

    Route::get('/admin/shipping-rates', [ShippingRateController::class, 'index'])
        ->name('admin.shipping-rates.index');
    
    Route::get('/admin/shipping-rates/create', [ShippingRateController::class, 'create'])
        ->name('admin.shipping-rates.create');
    
    Route::post('/admin/shipping-rates', [ShippingRateController::class, 'store'])
        ->name('admin.shipping-rates.store');
    
    Route::get('/admin/shipping-rates/{shippingRate}/edit', [ShippingRateController::class, 'edit'])
        ->name('admin.shipping-rates.edit');
    
    Route::put('/admin/shipping-rates/{shippingRate}', [ShippingRateController::class, 'update'])
        ->name('admin.shipping-rates.update');
    
    Route::delete('/admin/shipping-rates/{shippingRate}', [ShippingRateController::class, 'destroy'])
        ->name('admin.shipping-rates.destroy');

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])
        ->name('admin.orders.index');
    
    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])
        ->name('admin.orders.show');

    Route::put('/admin/orders/{order}', [AdminOrderController::class, 'update'])
        ->name('admin.orders.update');
        
});


/*
|--------------------------------------------------------------------------
| Customer
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');


    // Orders
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::put('/orders/{order}/complete', [OrderController::class, 'complete'])
        ->name('orders.complete');


    // Payment
    Route::get('/orders/{order}/payment', [PaymentController::class, 'show'])
        ->name('payments.show');

    Route::post('/orders/{order}/payment', [PaymentController::class, 'store'])
        ->name('payments.store');

    Route::put('/orders/{order}/payment-method', [PaymentController::class, 'updateMethod'])
    ->name('payments.method.update');
});


/*
|--------------------------------------------------------------------------
| Guest / Public
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show');


/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add/{product}', [CartController::class, 'add'])
    ->name('cart.add');

Route::put('/cart/update/{product}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])
    ->name('cart.remove');

