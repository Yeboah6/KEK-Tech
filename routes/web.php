<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/products', function () {
    return view('pages.products');
}) -> name('products');

Route::get('/view-products', function () {
    return view('pages.view-product');
}) -> name('view.products');


Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/signup', [AuthController::class, 'postSignup']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin']);

// Admin Route
Route::get('/admin/dashboard', [MainController::class, 'dashboard'])  -> middleware('isAdminLoggedIn');

Route::get('/admin/products', [MainController::class, 'product'])  -> middleware('isAdminLoggedIn');
Route::post('/admin/product', [MainController::class, 'postProducts']) -> name('admin.product');
Route::get('/admin/delete-product/{id}', [MainController::class, 'delete']) -> name('admin.delete-product');


Route::get('/admin/customers', [MainController::class, 'customer'])  -> middleware('isAdminLoggedIn');

Route::get('/admin/orders', [MainController::class, 'order']) -> name('admin.order')  -> middleware('isAdminLoggedIn');

Route::get('/admin/profile', [AuthController::class, 'profile']) -> name('admin.profile')  -> middleware('isAdminLoggedIn');