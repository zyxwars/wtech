<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

function applyFilters(Request $request, $products)
{
    switch ($request->input('order')) {
        case 'price_asc':
            $products = $products->orderBy("price", "asc");
            break;
        case 'price_desc':
            $products = $products->orderBy("price", "desc");
            break;
    }

    if ($request->input('price_start')) {
        $products = $products->where('price', '>=', $request->input('price_start') / 100);
    }
    if ($request->input('price_end')) {
        $products = $products->where('price', '<=', $request->input('price_end') / 100);
    }
    if ($request->input('author')) {
        $products = $products->where('author', $request->input('author'));
    }
    if ($request->input('language')) {
        $products = $products->where('language', $request->input('language'));
    }
    if ($request->input('release_year_start')) {
        $products = $products->where('release_year', '>=', $request->input('release_year_start'));
    }
    if ($request->input('release_year_end')) {
        $products = $products->where('release_year', '<=', $request->input('release_year_end'));
    }

    return $products;
}


class ProductController extends Controller
{
    public function home()
    {
        return view(
            'home',
            [
                'banner' => [
                    'text' => 'New album just out!',
                    'image_url' => "/placeholder.png",
                    // TODO: route to product
                    'content_url' => '/',
                ],
                'categories' => Category::all(),
                'featuredRows' => [
                    // TODO: use select products
                    ['title' => 'New Arrivals', 'products' => Product::all()->take(10)],
                    ['title' => 'Best sellers', 'products' => Product::all()->take(10)],
                    ['title' => 'Try some indie', 'products' => Product::all()->take(10)]
                ]
            ]
        );
    }

    public function category(Request $request, string $name)
    {
        $category = Category::where('name', $name)->firstOrFail();
        $products = $category->products();

        $products = applyFilters($request, $products);

        return view(
            'category',
            [
                'breadcrumbs' => [
                    ['name' => 'Home', 'url' => route("home")],
                    ['name' => ucfirst($category->name)]
                ],
                'products' => $products->paginate(15)->withQueryString(),
                'category' => $category,
            ]
        );
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('title', 'like', "%{$search}%");

        $products = applyFilters($request, $products);

        return view(
            'search',
            [
                'breadcrumbs' => [
                    ['name' => 'Home', 'url' => route("home")],
                    ['name' => 'Search results']
                ],
                'products' => $products->paginate(15)->withQueryString(),
                'search' => $search,
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
    public function show(string $id)
    {
        $product = Product::with(['author', 'category', 'language', 'images'])->find($id);
        return view(
            'product',
            [
                'breadcrumbs' => [
                    ['name' => 'Home', 'url' => route("home")],
                    ['name' => $product->title]
                ],
                'product' => $product,
                'featuredRow' => ['title' => 'You might also like', 'products' => Product::all()->take(10)],
            ]

        );
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
