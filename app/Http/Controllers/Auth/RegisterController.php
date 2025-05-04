<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

// https://github.com/laravel/breeze/blob/2.x/stubs/default/app/Http/Controllers/Auth/RegisteredUserController.php
class RegisterController extends Controller
{
    /**
     * Show the form for registration.
     */
    public function create()
    {
        return view('register');
    }


    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        Log::info("Registering " . $request->input("email"));

        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Log::info("Registered " . $request->input("email"));

        // Migrate cart from session to database
        Log::info("Migrating session cart " . $request->input("email"));

        $productIds = $request->session()->get('cart.productIds', []);
        $quantities = array_count_values($productIds);
        $products = Product::whereIn('id', array_keys($quantities))->get()->all();

        foreach ($products as $product) {
            $cartItem = new CartItem();
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = $quantities[$product->id];
            $cartItem->save();
        }

        Auth::login($user);

        return redirect(route("home"));
    }
}
