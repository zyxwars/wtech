<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    public function category(string $categoryName)
    {
        $category = Category::where('url_name', strtolower($categoryName))->firstOrFail();

        return view(
            'category',
            [
                'products' => $category->products()->paginate(15),
                'category' => $category,
                'breadcrumbs' => [
                    ['name' => 'Home', 'url' => '/'],
                    ['name' => ucfirst($category->name)]
                ]
            ]
        );
    }

    public function search(string $search)
    {
        return view(
            'search',
            [
                'products' => Product::where('title', 'like', "%{$search}%")->paginate(15),
                'search' => $search,
                'breadcrumbs' => [
                    ['name' => 'Home', 'url' => '/'],
                    ['name' => 'Search results']
                ],
            ],
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
