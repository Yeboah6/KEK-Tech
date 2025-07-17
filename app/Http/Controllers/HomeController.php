<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Cart;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $products = Products::where('is_featured', true)->take(8)->get();
        return view('pages.index', compact('products', 'cartNo'));
    }
}
