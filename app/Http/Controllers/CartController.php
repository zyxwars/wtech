<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            // Logged in user
            $cartItems = Auth::user()->cartItems()->with('product')->get()->all();
        } else {
            // Session storage fallback for guest user
            $productIds = $request->session()->get('cart.productIds', []);
            $quantities = array_count_values($productIds);
            $products = Product::whereIn('id', array_keys($quantities))->get()->all();

            $cartItems = array_map(function ($product) use ($quantities) {
                return [
                    'product' => $product,
                    'quantity' => $quantities[$product->id],
                ];
            }, $products);
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
     * Add quantity to cart
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'productId' => 'required|exists:products,id',
            'quantity' => 'numeric|integer|min:1'
        ]);
        $productId = $validated['productId'];
        $quantity = $validated['quantity'] ?? 1;

        if (Auth::check()) {
            // Logged in user
            $user = Auth::user();
            $cartItem = $user->cartItems()->where('product_id', $productId)->first();

            if ($cartItem) {
                // Item already in cart
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // Item not in cart yet
                $cartItem = new CartItem();
                $cartItem->user_id = $user->id;
                $cartItem->product_id = $productId;
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        } else {
            // Session storage fallback for guest user
            $productIds = $request->session()->get("cart.productIds", []);
            $newItems = array_fill(0, $quantity, $productId);
            $productIds = array_merge($productIds, $newItems);

            $request->session()->put('cart.productIds', $productIds);
        }


        return redirect()->back()->withSuccess("Product added to cart!");
    }

    /**
     * Edit quantity in cart
     */
    public function update(Request $request, string $productId)
    {
        $validated = $request->validate(['quantity' => 'required|numeric|integer|min:0']);
        $quantity = $validated['quantity'];

        if (Auth::check()) {
            // Logged in user
            $user = Auth::user();
            $cartItem = $user->cartItems()->where('product_id', $productId)->first();

            if (!$cartItem) {
                return redirect()->back();
            }

            if ($quantity == 0) {
                $cartItem->delete();
            } else {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        } else {
            // Session storage fallback for guest user
            $productIds = $request->session()->get("cart.productIds", []);
            $productIds = array_filter($productIds, fn($id) => $id != $productId);

            $newItems = array_fill(0, $quantity, $productId);
            $productIds = array_merge($productIds, $newItems);

            $request->session()->put('cart.productIds', $productIds);
        }


        return redirect()->back();
    }

    /**
     * Remove product from cart
     */
    public function destroy(Request $request, string $productId)
    {
        if (Auth::check()) {
            // Logged in user
            $user = Auth::user();
            $cartItem = $user->cartItems()->where('product_id', $productId)->first();

            if ($cartItem) {
                $cartItem->delete();
            }
        } else {
            // Session storage fallback for guest user
            $productIds = $request->session()->get("cart.productIds", []);
            $productIds = array_filter($productIds, fn($id) => $id != $productId);
            $request->session()->put('cart.productIds', array_values($productIds));
        }

        return redirect()->back();
    }
}
