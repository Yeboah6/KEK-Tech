<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Str;

class MainController extends Controller
{
    // Admin
    public function dashboard() {

        $customers = User::where('is_admin', '!=', 1)->count();
        $products = Products::all() -> count();
        $order = Order::all() -> count();

        $orders = Order::with(['customer', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('Admin.dashboard', compact('customers', 'products', 'order', 'orders'));
    }

    // Display Products Page Function
    public function product() {
        $products = Products::all();
        $categories = Category::all();
        return view('Admin.products', compact('products', 'categories'));
    }

    // Display Customers Page Function
    public function customer() {
        $customers = User::where('is_admin', '!=', 1)->get();
        return view('Admin.customers',compact('customers'));
    }

    // Delete Customer Function
    public function deleteCustomer($id) {
        $customer = User::findOrFail($id);
        $customer->delete();
        return redirect('/admin/customers')->with('success', 'Customer Deleted Successfully');
    }

     // Add Products Function
    public function postProducts(Request $request) {
        $validateData = $request->validate([
            'product_name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|string',
            'product_image' => 'required|file|mimes:jpeg,png,jpg,svg|max:5048', // 5MB max
            'product_image2' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:5048', // 5MB max
            'product_image3' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:5048', // 5MB max
            'stock_quantity' => 'required|string',
            'description' => 'required|string'
        ]);
    
        // Generate unique product ID
        $product_id = 'PID' . Str::upper(Str::random(5));
    
        // Create new product instance
        $product = new Products();
        $product->fill([
            'product_id' => $product_id,
            'product_name' => $validateData['product_name'],
            'category' => $validateData['category'],
            'price' => $validateData['price'],
            'stock_quantity' => $validateData['stock_quantity'],
            'description' => $validateData['description'],
            'is_featured' => 1,
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

    public function editProducts($id) {
        $product = Products::findOrFail($id);
        $categories = Category::all();
        return view('Admin.edit-product', compact('product', 'categories'));
    }

    public function postEditProducts(Request $request, $id) {
        $validateData = $request->validate([
            'id' => 'required|string',
            'product_name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|string',
            'product_image' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:5048', // 5MB max
            'product_image2' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:5048', // 5MB max
            'product_image3' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:5048', // 5MB max
            'stock_quantity' => 'required|string',
            'description' => 'required|string'
        ]);

        $product = Products::findOrFail($id);
        $product->fill([
            'id' => $validateData['id'],
            'product_name' => $validateData['product_name'],
            'category' => $validateData['category'],
            'price' => $validateData['price'],
            'stock_quantity' => $validateData['stock_quantity'],
            'description' => $validateData['description'],
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
        $product->update();   
        return redirect('/admin/products')->with('success', 'Product Updated Successfully');
    }

    // Delete Product Function
    public function delete($id) {
        $product = Products::findOrFail($id);
        $product->delete();
        return redirect('/admin/products')->with('success', 'Product Deleted Successfully');
    }

    // Display Admin Order Page Function 
    public function order() {
    // Get orders with non-null addresses first
        $orders = Order::whereHas('address')
            ->with(['customer', 'items.product', 'address'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('Admin.order', compact('orders'));
    }

    // Edit Order Function
    public function editOrder($id) {    
        $order = Order::with(['customer', 'items.product', 'address'])->findOrFail($id);
        return view('Admin.edit-order', compact('order'));
    }

    // Post Edit Order Function
    public function postEditOrder(Request $request, $id) {
        $validateData = $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $validateData['status'];
        $order->update();
        return redirect('/admin/orders')->with('success', 'Order Updated Successfully');
    }

    public function contact() {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        return view('pages.contact', compact('cartNo'));
    }
}
