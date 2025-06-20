<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\DeliveryAddress;

class AuthController extends Controller
{
   // Display Sign Up Page Function
    public function signup() {
        return view('auth.signup');
    }

    // Stores Sign Up Data Function
    public function postSignup(Request $request) {

        $validateData = $request -> validate([
            'name' => 'required|unique:customers',
            'email' => 'required|email|unique:customers',
            'number' => 'required|string',
            'password' => 'required|min:8|max:12'
        ]);

        $customer = new Customer();

        $customer -> fill([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'number' => $validateData['number'],
            'password' => Hash::make($validateData['password'])
        ]);

       if ($customer -> save()) {
            session(['customer_id' => $customer->id]);
            return redirect('/login');
       } else {
            return redirect()->back()->with('fail', 'Account not Created');
       };
        
    }

    // Display Login Page Function
    public function login() {
        return view('auth.login');
    }

    // Login Function
    public function postLogin(Request $request) {
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:12'
        ]);

        $user = Customer::where('email', '=', $request -> email) -> first();
        $adminLogin = Admin::where('email', '=', $request -> email) -> first();
        if($user) {
            if(Hash::check($request -> password, $user -> password)) {
                $request -> session() -> put('loginId', $user -> id);
                return redirect('/');
            } else {
                return back() -> with('fail', 'Incorrect Credentials!!');
            } 
        } 
        elseif ($adminLogin) {
            if (Hash::check($request -> password, $adminLogin -> password)) {
                $request -> session() -> put('loginId', $adminLogin -> id);
                return redirect('/admin/dashboard');
            } else {
                return back() -> with('fail', 'Incorrect Credentials');
            }
            return back() -> with('fail', 'You do not access to this portal!!');
        }
    }

    // Logout Function
    public function logout() {
        if(Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('/login');
        }
    }

    public function account() {
        $data = [];
        $cartCount = 0;
        $addresses = collect(); // Initialize as empty array
        
        if(Session::has('loginId')) {
            $data = Customer::where('id', '=', Session::get('loginId'))->first();
            
            if ($data) { // Check if customer exists
                $cartCount = Cart::where('customer_id', $data->id)->count();
                $addresses = DeliveryAddress::where('customer_id', $data->id)->get();
                    foreach ($addresses as $address) {
                        if ($address -> customer_id == $data -> id) {
                            {
                                return view('auth.account', compact('data', 'cartCount', 'address'));
                            }
                        }
                    }
                        
            }
        }
        
    
        
    }

    // public function account() {
    //     $data = [];
    //     if(Session::has('loginId')) {
    //         $data = Customer::where('id', '=', Session::get('loginId')) -> first();
    //     }

    //     $cartCount = 0;
    //     if (!empty($data)) {
    //         $cartCount = Cart::where('customer_id', $data->id)->count();
    //     }

    //     $address = DeliveryAddress::where('customer_id', $data -> id) -> get();

    //     return view('auth.account', compact('data', 'cartCount', 'address'));
    // }
}
