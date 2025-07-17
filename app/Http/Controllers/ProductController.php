<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $products = Products::with('category')->latest()->paginate(12);
        $categories = Category::all();
        
        return view('pages.products', compact('products', 'categories', 'cartNo'));
    }

    public function show($id)
    {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $product = Products::findOrFail($id);
        return view('pages.view-product', compact('product', 'cartNo'));
    }

    public function categoryProducts($category)
    {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $categoryData = Products::where('category', $category)
            ->get();
            
        return view('pages.single-product', compact('categoryData', 'cartNo'));
    }

    public function featuredProducts()
    {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $products = Products::where('is_featured', true)->take(8)->get();
        return view('pages.index', compact('products', 'cartNo'));
    }
}
