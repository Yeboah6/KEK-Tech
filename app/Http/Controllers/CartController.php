<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $userId = Auth::id();
        $joinedCart = Cart::where('customer_id', $userId)
            ->with('product')
            ->get();
            
        $totalPrice = $joinedCart->sum(function($item) {
            return $item->product->price * $item->cart_quantity;
        });
        
        $customerCartIds = $joinedCart->pluck('id')->toArray();
        
        return view('pages.cart', compact('joinedCart', 'totalPrice', 'customerCartIds', 'cartNo'));
    }

        public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'cart_quantity' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;
        
        // Check if product already in cart
        $existingCart = Cart::where('customer_id', $userId)
            ->where('product_id', $productId)
            ->first();
            
        if ($existingCart) {
            $existingCart->update([
                'cart_quantity' => $existingCart->cart_quantity + $request->cart_quantity
            ]);
        } else {
            Cart::create([
                'customer_id' => $userId,
                'product_id' => $productId,
                'cart_quantity' => $request->cart_quantity
            ]);
        }
        
        return back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        
        // Check if the cart item belongs to the authenticated user
        if ($cartItem->customer_id != Auth::id()) {
            return back()->with('fail', 'Unauthorized action');
        }
        
        $cartItem->delete();
        
        return back()->with('success', 'Item removed from cart successfully');
    }
}
