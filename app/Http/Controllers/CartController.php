<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index(Request $request)
    {
        Log::info($request->session()->get('cart.products'));

        return view("cart", [
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => route("home")],
                ['name' => 'Cart']
            ],
            // TODO: real products in cart
            'products' => [],
            'total' => 123.89
        ]);
    }

    /**
     * Add product to cart
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['productId' => 'required|exists:products,id']);
        $request->session()->push('cart.products', $validated['productId']);

        return redirect()->back();
    }

    /**
     * Edit quantity in cart
     */
    public function update(Request $request, string $productId)
    {
        $validated = $request->validate(['quantity' => 'required|numeric|integer|min:0']);
        $products = array_filter($request->session()->get("cart.products", []), $productId);

        if ($validated['quantity'] == 0)
            return redirect()->back();

        $products = array_merge($products, array_fill(0, 3, $productId));
        $request->session()->put('cart.products', $products);

        return redirect()->back();
    }

    /**
     * Remove product from cart
     */
    public function destroy(Request $request, string $productId)
    {
        $products = array_filter($request->session()->get("cart.products", []), $productId);
        $request->session()->put('cart.products', $products);

        return redirect()->back();
    }
}
