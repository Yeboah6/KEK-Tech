<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

Route::get('/', [MainController::class, 'index']);
Route::get('/products', [MainController::class, 'products']) -> name('products');
Route::get('/view-product/{id}', [MainController::class, 'viewProduct']);
Route::get('/single-product/{category}', [MainController::class, 'singleProduct']);
Route::get('/cart', [MainController::class, 'cart'])-> middleware('isLoggedIn');
Route::post('/add-to-cart', [MainController::class, 'addToCart']) -> name('add.to.cart');
Route::get('/checkout', [MainController::class, 'checkout']) -> middleware('isLoggedIn');
Route::post('/save/to/checkout', [MainController::class, 'saveCheckout']) -> name('save.to.order');
Route::post('/save/address/to/checkout', [MainController::class, 'saveAddressCheckout']) -> name('save.address.to.order');
Route::post('/delivery-address', [MainController::class, 'postDeliveryAddress']) -> name('add.address');
Route::get('/contact', [MainController::class, 'contact']) -> middleware('isLoggedIn');


Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/signup', [AuthController::class, 'postSignup']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin']);

Route::get('/account', [AuthController::class, 'account']) -> name('account') -> middleware('isLoggedIn');

Route::get('/logout', [AuthController::class, 'logout']) -> middleware('isLoggedIn');

// Admin Route
Route::get('/admin/dashboard', [MainController::class, 'dashboard'])  -> middleware('isAdminLoggedIn');

Route::get('/admin/products', [MainController::class, 'product'])  -> middleware('isAdminLoggedIn');
Route::post('/admin/product', [MainController::class, 'postProducts']) -> name('admin.product');
Route::get('/admin/delete-product/{id}', [MainController::class, 'delete']) -> name('admin.delete-product');


Route::get('/admin/customers', [MainController::class, 'customer'])  -> middleware('isAdminLoggedIn');

Route::get('/admin/orders', [MainController::class, 'order']) -> name('admin.order')  -> middleware('isAdminLoggedIn');

Route::get('/admin/profile', [AuthController::class, 'profile']) -> name('admin.profile')  -> middleware('isAdminLoggedIn');