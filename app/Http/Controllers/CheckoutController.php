<?php

namespace App\Http\Controllers;

use App\Models\DeliveryAddress;
use App\Models\OrderAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $joinedCart = Cart::where('customer_id', $userId)
            ->with('product')
            ->get();
            
        $total = $joinedCart->sum(function($item) {
            return $item->product->price * $item->cart_quantity;
        });
        
        $addresses = DeliveryAddress::where('customer_id', $userId)->latest()->get();

        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $orderId = Order::where('customer_id', $userId)
            ->latest()
            ->value('id');
        
        return view('pages.checkout', compact('joinedCart', 'total', 'addresses', 'orderId', 'cartNo'));
    }

        public function saveToOrder(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::where('customer_id', $userId)->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return back()->with('fail', 'Your cart is empty');
        }
        
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->cart_quantity;
        });
        
        // Create order
        $order = Order::create([
            'customer_id' => $userId,
            'order_number' => 'ORD-' . Str::upper(Str::random(5)),
            'total_amount' => $total,
            'status' => 'pending'
        ]);
        
        // Add order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->cart_quantity,
                'price' => $item->product->price
            ]);
        }
        
        return redirect()->route('checkout')->with('orderId', $order->id);
    }

    public function saveAddressToOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:delivery_addresses,id',
            'order_id' => 'required|exists:orders,id'
        ]);
        
        $address = DeliveryAddress::findOrFail($request->address_id);
        $order = Order::findOrFail($request->order_id);
        
        // Check if the address and order belong to the authenticated user
        if ($address->customer_id != Auth::id() || $order->customer_id != Auth::id()) {
            return back()->with('fail', 'Unauthorized action');
        }
        
        // Create order address snapshot
        OrderAddress::create([
            'order_id' => $order->id,
            'first_name' => $address->first_name,
            'last_name' => $address->last_name,
            'company_name' => $address->company_name,
            'country' => $address->country,
            'address_1' => $address->address_1,
            'address_2' => $address->address_2,
            'city' => $address->city,
            'state' => $address->state,
            'zip_code' => $address->zip_code,
            'email' => $address->email,
            'phone' => $address->phone
        ]);
        
        // Clear the cart
        Cart::where('customer_id', Auth::id())->delete();
        
        return redirect()->route('order.complete', $order->id);
    }

    public function addDeliveryAddress(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20'
        ]);
        
        $address = DeliveryAddress::create([
            'customer_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'country' => $request->country,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        
        return back()->with('success', 'Address added successfully');
    }

    public function orderComplete($orderId)
    {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $order = Order::where('id', $orderId)
            ->where('customer_id', Auth::id())
            ->with('items.product')
            ->firstOrFail();
            
        return view('pages.order-complete', compact('order', 'cartNo'));
    }

    public function viewOrders()
    {
        $userId = Auth::id();
        $orders = Order::where('customer_id', $userId)
            ->with('items.product')
            ->latest()
            ->get();

        $cartNo = Cart::where('customer_id', auth()->id())->count();
            
        return view('pages.view-orders', compact('orders', 'cartNo'));
    }

    public function viewOrder($id)
    {
        $userId = Auth::id();
        $order = Order::where('id', $id)
            ->where('customer_id', $userId)
            ->with(['items.product', 'address'])
            ->firstOrFail();

        $cartNo = Cart::where('customer_id', auth()->id())->count();
        
        return view('pages.single-order', compact('order', 'cartNo'));
    }
}
