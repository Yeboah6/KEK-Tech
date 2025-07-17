<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DeliveryAddress;
use App\Models\Cart;

class ProfileController extends Controller
{
    // Show user profile
    public function index()
    {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $user = Auth::user();
        $address = DeliveryAddress::where('customer_id', $user->id)->first();
        
        return view('auth.account', [
            'data' => $user,
            'address' => $address,
            'cartNo' => $cartNo
        ]);
    }

    // Update user profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }

        // Update user address
    public function updateAddress(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $address = DeliveryAddress::updateOrCreate(
            ['customer_id' => $user->id],
            [
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
                'phone' => $request->phone,
            ]
        );

        return back()->with('success', 'Address updated successfully!');
    }

    // Admin profile view
    public function adminProfile()
    {
        $cartNo = Cart::where('customer_id', auth()->id())->count();
        $user = Auth::user();
        $address = DeliveryAddress::where('customer_id', $user->id)->first();
        return view('auth.profile', [
            'data' => $user,
            'address' => $address,
            'cartNo' => $cartNo
        ]);
    }

    // Update admin profile
    public function updateAdminProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return back()->with('success', 'Profile updated successfully!');
    }
}
