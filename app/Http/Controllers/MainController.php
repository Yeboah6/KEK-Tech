<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $cartCount = 0;
        if (!empty($data)) {
            $cartCount = Cart::where('customer_id', $data->id)->count();
        }

        $products = Products::all();
        return view('pages.index', compact('products', 'data', 'cartCount'));
    }

    public function products() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $cartCount = 0;
        if (!empty($data)) {
            $cartCount = Cart::where('customer_id', $data->id)->count();
        }

        $products = Products::all();
        $categories = Category::all();
        return view('pages.products', compact('products', 'categories', 'data', 'cartCount'));
    }

    public function viewProduct($id) {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $cartCount = 0;
        if (!empty($data)) {
            $cartCount = Cart::where('customer_id', $data->id)->count();
        }

        $product = Products::findOrFail($id);
        return view('pages.view-product', compact('data', 'product', 'cartCount'));
    }

    public function singleProduct($category) {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

    // Get all products that belong to this category
    $categoryData = Products::where('category', $category)->get();
    
    // Check if category exists
    if ($categoryData->isEmpty()) {
        abort(404, 'Category not found');
    }

    $cartCount = 0;
    if (!empty($data)) {
        $cartCount = Cart::where('customer_id', $data->id)->count();
    }
    
    return view('pages.single-product', compact('categoryData', 'data', 'cartCount'));
    }

    // Adds Product to Cart Function
    public function addToCart(Request $request) {
        $validateData = $request -> validate([
            'customer_id' => 'required',
            'product_id' => 'required',
            'cart_quantity' => 'required'
        ]); 

        $addToCart = new Cart();

        $addToCart -> fill([
            'customer_id' => $validateData['customer_id'],
            'product_id' => $validateData['product_id'],
            'cart_quantity' => $validateData['cart_quantity']
        ]);

        $addToCart -> save();
        return redirect() -> back() -> with('success', 'Added to Cart');
    }

    // Display Cart Page Function
    public function cart() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $cartCount = 0;
        if (!empty($data)) {
            $cartCount = Cart::where('customer_id', $data->id)->count();
        }

        $joinedCart = DB::table('carts')
            -> leftJoin('products', 'carts.product_id', '=', 'products.id')
            -> leftJoin('customers', 'carts.customer_id', '=', 'customers.id')
            ->select(
                'carts.id as cart_id',           // Cart table ID for deletion
                'carts.product_id',
                'carts.customer_id',
                'carts.cart_quantity',
                'carts.created_at as cart_created_at',
                'products.id as product_id',     // Product table ID
                'products.product_name',
                'products.price',
                'products.product_image',
                'customers.id as customer_id',   // Customer table ID
                'customers.name as customer_name',
                'customers.email'
            )
            -> get();
        
            
         // Calculate total price
        $totalPrice = $joinedCart->sum(function($item) {
            return $item->price * $item->cart_quantity;
        });

            // Get cart IDs for the logged-in customer only
        $customerCartIds = DB::table('carts')
            ->select('id')
            ->where('customer_id', $data->id)
            ->pluck('id')
            ->toArray();
    // }
        // foreach ($customerCartIds as $customerCartId) {
            // dd($customerCartIds);
        // }
        

        return view('pages.cart', compact('data', 'cartCount', 'joinedCart', 'totalPrice', 'customerCartIds'));

    }

    public function checkout() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $cartCount = 0;
        if (!empty($data)) {
            $cartCount = Cart::where('customer_id', $data->id)->count();
        }

        $joinedCart = DB::table('carts')
            -> leftJoin('products', 'carts.product_id', '=', 'products.id')
            -> leftJoin('customers', 'carts.customer_id', '=', 'customers.id')
            -> leftJoin('orders', 'carts.customer_id', 'orders.customer_id')
            ->select(
                'carts.id as cart_id',           // Cart table ID for deletion
                'carts.product_id',
                'carts.customer_id',
                'carts.cart_quantity',
                'carts.created_at as cart_created_at',
                'products.id as product_id',     // Product table ID
                'products.product_name',
                'products.price',
                'products.product_image',
                'customers.id as customer_id',   // Customer table ID
                'customers.name as customer_name',
                'customers.email',
                'orders.id as order_id'
            )
            -> get();
        
            
         // Calculate total price
        $total = $joinedCart->sum(function($item) {
            return $item->price * $item->cart_quantity;
        });

        $address = DB::table('delivery_addresses')
            -> leftJoin('customers', 'delivery_addresses.customer_id', '=', 'customers.id')
            -> select('delivery_addresses.id as address_id')
            -> get();


        return view('pages.checkout', compact('data', 'address', 'cartCount', 'total', 'joinedCart'));
    }

    public function saveCheckout(Request $request) {
        $validateData = $request -> validate([
            'customer_id' => 'required',
            'total' => 'required',
            'cart_id' => 'required'
        ]);

        $orderId = "ID" .uniqid();

        $order = new Order();

        $order -> fill([
            'order_id' => $orderId,
            'customer_id' => $validateData['customer_id'],
            'total' => $validateData['total'],
            'cart_id' => $validateData['cart_id'],
        ]);

        $order -> save();
        return redirect('/checkout');
    }

    // 
    public function saveAddressCheckout(Request $request) {
        $validateData = $request->validate([
            'address_id' => 'required',
            'order_id' => 'required', // Add this if you're passing order ID
        ]);

        Order::where('id', $validateData['order_id'])
             ->update(['address_id' => $validateData['address_id']]);

        return redirect('/checkout');
    }



    // Add Delivery Address Function

    public function postDeliveryAddress(Request $request) {
        $validateData = $request->validate([
            'customer_id' => 'required',
            'country' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_name' => 'nullable|string',
            'address_1' => 'required|string',
            'address_2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'email' => 'required|string|email',
            'number' => 'required|string',
        ]);

        $address = new DeliveryAddress();

        $address -> fill([
            'customer_id' => $validateData['customer_id'],
            'country' => $validateData['country'],
            'first_name' => $validateData['first_name'],
            'last_name' => $validateData['last_name'],
            'company_name' => $validateData['company_name'],
            'address_1' => $validateData['address_1'],
            'address_2' => $validateData['address_2'],
            'city' => $validateData['city'],
            'state' => $validateData['state'],
            'zip_code' => $validateData['zip_code'],
            'email' => $validateData['email'],
            'number' => $validateData['number'],
        ]);
    
        $address -> save();
        return redirect() -> back() -> with('succes', 'Address added successfully!');
    }

    // Display Contact Page Function
    public function contact() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $cartCount = 0;
        if (!empty($data)) {
            $cartCount = Cart::where('customer_id', $data->id)->count();
        }
        // $cart = Cart::where('customer_id', $data->id)->get(); // Get only user's cart items

        return view('pages.contact', compact('data', 'cartCount'));
    }


    // Admin
    public function dashboard() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $customers = Customer::all() -> count();
        $products = Products::all() -> count();
        $order = Order::all() -> count();

        return view('Admin.dashboard', compact('data', 'customers', 'products', 'order'));
    }

    // Display Products Page Function
    public function product() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $products = Products::all();
        $categories = Category::all();
        return view('Admin.products', compact('products', 'data', 'categories'));
    }

    // Display Customers Page Function
    public function customer() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $customers = Customer::all();
        return view('Admin.customers',compact('customers', 'data'));
    }

     // Add Products Function
    public function postProducts(Request $request) {
        $validateData = $request->validate([
            'product_name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|string',
            'product_image' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:5048', // 5MB max
            'product_image2' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:5048', // 5MB max
            'product_image3' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:5048', // 5MB max
            'quantity' => 'required|string',
            'description' => 'required|string'
        ]);
    
        // Generate unique product ID
        $product_id = 'PID' . uniqid();
    
        // Create new product instance
        $product = new Products();
        $product->fill([
            'product_id' => $product_id,
            'product_name' => $validateData['product_name'],
            'category' => $validateData['category'],
            'price' => $validateData['price'],
            'quantity' => $validateData['quantity'],
            'description' => $validateData['description']
        ]);
    
        // Handle file upload
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $fileName = 'IM_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/product-images', $fileName, 'public');
            $product->product_image = $fileName; // Save file name to DB
        }
        // Handle file upload
        if ($request->hasFile('product_image2')) {
            $file = $request->file('product_image2');
            $fileName = 'IM2_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/product-images', $fileName, 'public');
            $product->product_image2 = $fileName; // Save file name to DB
        }
        // Handle file upload
        if ($request->hasFile('product_image3')) {
            $file = $request->file('product_image3');
            $fileName = 'IM3_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads/product-images', $fileName, 'public');
            $product->product_image3 = $fileName; // Save file name to DB
        }
    
        // Save product to database
        $product->save();
    
        return redirect('/admin/products')->with('success', 'Product Added Successfully');
    }

    // Display Admin Order Page Function 
    public function order() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        return view('Admin.order', compact('data'));
    }
}
