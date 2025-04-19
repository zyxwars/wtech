<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            "delivery-and-payment",
            ['breadcrumbs' => [
                ['name' => 'Home', 'url' => route("home")],
                ['name' => 'Cart', 'url' => route("cart.index")],
                ['name' => 'Delivery and Payment']
            ],]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("order-submitted", [
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => route("home")],
                ['name' => 'Order Submitted'],
            ],
        ]);
    }
}
