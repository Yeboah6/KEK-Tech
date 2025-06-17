<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Products;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function dashboard() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $customers = Customer::all() -> count();
        $products = Products::all() -> count();

        return view('Admin.dashboard', compact('data', 'customers', 'products'));
    }

    // Display Products Page Function
    public function product() {
        $data = [];
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId')) -> first();
        }

        $products = Products::all();
        return view('Admin.products', compact('products', 'data'));
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
}
