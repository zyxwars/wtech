<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // Session storage fallback for guest user
        if (!Auth::check()) {
            $productIds = $request->session()->get('cart.products', []);

            $quantities = array_count_values($productIds);

            $products = Product::whereIn('id', array_keys($quantities))->get()->all();

            $cartItems = array_map(function ($product) use ($quantities) {
                return [
                    'product' => $product,
                    'quantity' => $quantities[$product->id],
                ];
            }, $products);
        } else {
            $cartItems = Auth::user()->cartItems()->with('product')->get()->all();
        }

        return view("cart", [
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => route("home")],
                ['name' => 'Cart']
            ],
            'cartItems' => $cartItems,
            'total' => array_reduce($cartItems, function ($carry, $item) {
                return $carry + ($item['quantity'] * $item['product']->price);
            }, 0)
        ]);
    }

    /**
     * Add product to cart
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['productId' => 'required|exists:products,id']);
        $productId = $validated['productId'];

        // Session storage fallback for guest user
        if (!Auth::check()) {
            $products = $request->session()->get("cart.products", []);
            array_push($products, $validated['productId']);
            $request->session()->put('cart.products', $products);

            return redirect()->back();
        }

        $user = Auth::user();
        $cartItem = $user->cartItems()->where('product_id', $productId)->first();

        // Item already in cart, add another one
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();

            return redirect()->back();
        }

        $cartItem = new CartItem();
        $cartItem->user_id = $user->id;
        $cartItem->product_id = $productId;
        $cartItem->quantity = 1;
        $cartItem->save();

        return redirect()->back();
    }

    /**
     * Edit quantity in cart
     */
    public function update(Request $request, string $productId)
    {
        $validated = $request->validate(['quantity' => 'required|numeric|integer|min:0']);
        $quantity = $validated['quantity'];

        // Session storage fallback for guest user
        if (!Auth::check()) {
            $products = $request->session()->get("cart.products", []);
            $products = array_filter($products, fn($id) => $id != $productId);

            if ($quantity == 0) {
                $request->session()->put('cart.products', $products);

                return redirect()->back();
            }

            $newItems = array_fill(0, $quantity, $productId);
            $products = array_merge($products, $newItems);

            $request->session()->put('cart.products', $products);

            return redirect()->back();
        }

        $user = Auth::user();
        $cartItem = $user->cartItems()->where('product_id', $productId)->first();

        // Item not in cart yet
        if (!$cartItem) {
            if ($quantity == 0) return redirect()->back();

            $cartItem = new CartItem();
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $productId;
            $cartItem->quantity = $quantity;
            $cartItem->save();

            return redirect()->back();
        }

        if ($quantity == 0) {
            $cartItem->delete();
            return redirect()->back();
        }

        $cartItem->quantity = $quantity;
        $cartItem->save();

        return redirect()->back();
    }

    /**
     * Remove product from cart
     */
    public function destroy(Request $request, string $productId)
    {
        // Session storage fallback for guest user
        if (!Auth::check()) {
            $products = $request->session()->get("cart.products", []);
            $products = array_filter($products, fn($id) => $id != $productId);
            $request->session()->put('cart.products', array_values($products));

            return redirect()->back();
        }

        $user = Auth::user();
        $cartItem = $user->cartItems()->where('product_id', $productId)->first();

        if ($cartItem)
            $cartItem->delete();

        return redirect()->back();
    }
}
