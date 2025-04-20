<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMethod;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
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
        if (count($cartItems) == 0) return redirect()->back();

        return view(
            "delivery-and-payment",
            [
                'breadcrumbs' => [
                    ['name' => 'Home', 'url' => route("home")],
                    ['name' => 'Cart', 'url' => route("cart.index")],
                    ['name' => 'Delivery and Payment']
                ],
                'deliveryMethods' => DeliveryMethod::all(),
                'paymentMethods' => PaymentMethod::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
            'postal_code' => 'required|string',
            'delivery_method' => 'required|exists:delivery_methods,name',
            'payment_method' => 'required|exists:payment_methods,name',
        ]);

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

        $order = new Order();
        $order->first_name = $validated['first_name'];
        $order->last_name = $validated['last_name'];
        $order->email = $validated['email'];
        $order->phone_number = $validated['phone_number'];
        $order->country  = $validated['country'];
        $order->city = $validated['city'];
        $order->street = $validated['street'];
        $order->postal_code = $validated['postal_code'];

        $order->total = array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['product']->price);
        }, 0);

        $order->delivery_method_id = DeliveryMethod::where('name', $validated['delivery_method'])->value('id');
        $order->payment_method_id  = PaymentMethod::where('name', $validated['payment_method'])->value('id');
        $order->user_id  = Auth::check() ? Auth::user()->id : null;
        $order->session_id  = session()->getId();

        $order->save();

        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->quantity = $cartItem['quantity'];
            $orderItem->price = $cartItem['product']->price;
            $orderItem->product_id = $cartItem['product']->id;
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        return redirect(route("order.show", $order->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $order = Order::where('id', $id)->with(['orderItems.product.author', 'orderItems.product.primaryImage', 'deliveryMethod', 'paymentMethod'])->first();

        if (!$order) {
            abort(404);
        }

        if ((Auth::check() && Auth::user()->id != $order->user_id)) abort(401);

        if (session()->getId() != $order->session_id) abort(401);

        return view("order-submitted", [
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => route("home")],
                ['name' => 'Order Submitted'],
            ],
            'order' => $order,
        ]);
    }
}
