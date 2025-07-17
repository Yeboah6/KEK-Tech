<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;

// Admin Route
Route::get('/admin/dashboard', [MainController::class, 'dashboard'])  -> middleware('admin');

Route::get('/admin/products', [MainController::class, 'product'])  -> middleware('admin');
Route::post('/admin/product', [MainController::class, 'postProducts']) -> name('admin.product');
Route::get('/admin/product/edit/{id}', [MainController::class, 'editProducts']) -> name('admin.edit.product');
Route::post('/admin/product/edit/{id}', [MainController::class, 'postEditProducts']) -> name('admin.post.edit.product');
Route::get('/admin/delete-product/{id}', [MainController::class, 'delete']) -> name('admin.delete-product');


Route::get('/admin/customers', [MainController::class, 'customer'])  -> middleware('admin');
Route::get('/admin/customers/delete/{id}', [MainController::class, 'deleteCustomer'])  -> middleware('admin');

Route::get('/admin/orders', [MainController::class, 'order']) -> name('admin.order')  -> middleware('admin');
Route::get('/admin/orders/edit/{id}', [MainController::class, 'editOrder']) -> name('admin.edit.order')  -> middleware('admin');
Route::post('/admin/orders/edit/{id}', [MainController::class, 'postEditOrder']) -> name('admin.post.edit.order')  -> middleware('admin');
Route::get('/admin/orders/delete/{id}', [MainController::class, 'deleteOrder']) -> name('admin.post.delete.order')  -> middleware('admin');

Route::get('/admin/profile', [ProfileController::class, 'adminProfile']) -> name('admin.profile')  -> middleware('admin');
Route::post('/admin/profile', [ProfileController::class, 'updateAdminProfile']) -> name('admin.update.profile')  -> middleware('admin');







// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/index', [HomeController::class, 'index'])->name('index');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/view-product/{id}', [ProductController::class, 'show'])->name('view-product');
Route::get('/single-product/{category}', [ProductController::class, 'categoryProducts'])->name('single-product');

// Cart routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove.from.cart');
    
    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/save-to-order', [CheckoutController::class, 'saveToOrder'])->name('save.to.order');
    Route::post('/save-address-to-order', [CheckoutController::class, 'saveAddressToOrder'])->name('save.address.to.order');
    Route::post('/delivery-address', [CheckoutController::class, 'addDeliveryAddress'])->name('delivery.address');
    Route::get('/order-complete/{orderId}', [CheckoutController::class, 'orderComplete'])->name('order.complete');
    Route::get('/view-orders', [CheckoutController::class, 'viewOrders'])->name('view.orders');
    Route::get('/view-orders/{id}', [CheckoutController::class, 'viewOrder'])->name('view.orders');
});

// Contact route
Route::get('/contact', [MainController::class, 'contact'])->name('contact');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');
Route::post('/signup', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Routes (protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [ProfileController::class, 'index'])->name('account');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
    Route::post('/update-address', [ProfileController::class, 'updateAddress'])->name('update.address');
});