<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

// https://github.com/laravel/breeze/blob/2.x/stubs/default/app/Http/Controllers/Auth/AuthenticatedSessionController.php
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        Log::info("Authenticating " . $request->input("email"));

        $request->authenticate();

        Log::info("Login " . $request->input("email"));

        if (Auth::user()->cartItems()->with('product')->get()->count() == 0) {
            // Migrate cart from session to database
            Log::info("Migrating session cart " . $request->input("email"));

            $productIds = $request->session()->get('cart.productIds', []);
            $quantities = array_count_values($productIds);
            $products = Product::whereIn('id', array_keys($quantities))->get()->all();

            foreach ($products as $product) {
                $cartItem = new CartItem();
                $cartItem->user_id = Auth::user()->id;
                $cartItem->product_id = $product->id;
                $cartItem->quantity = $quantities[$product->id];
                $cartItem->save();
            }
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Log::info("Logout " . Auth::user()?->email);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");
    }
}
