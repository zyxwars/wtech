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
        $products = $products->where('price', '>=', $request->input('price_start') * 100);
    }
    if ($request->input('price_end')) {
        $products = $products->where('price', '<=', $request->input('price_end') * 100);
    }
    if ($request->input('authorId')) {
        $products = $products->where('author_id', $request->input('authorId'));
    }
    if ($request->input('languageId')) {
        $products = $products->where('language_id', $request->input('languageId'));
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
                    'image_url' => "/banner.png",
                    // TODO: route to product
                    'content_url' => route('product.show', 1),
                ],
                'categories' => Category::all(),
                'featuredRows' => [
                    // TODO: use select products
                    ['title' => 'New Arrivals', 'products' => Product::with(['author', 'category', 'language', 'primaryImage'])->orderBy('created_at', 'desc')->take(10)->get()],
                    ['title' => 'Best sellers', 'products' => Product::with(['author', 'category', 'language', 'primaryImage'])->take(10)->get()],
                    ['title' => 'Try some indie', 'products' => Product::with(['author', 'category', 'language', 'primaryImage'])->where('category_id', 6)->take(10)->get()]
                ]
            ]
        );
    }

    public function category(Request $request, string $name)
    {
        $category = Category::where('name', $name)->firstOrFail();
        $products = $category->products()->with(['author', 'category', 'language', 'primaryImage']);

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
        $products = Product::where('title', 'like', "%{$search}%")->with(['author', 'category', 'language', 'primaryImage']);

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
        $product = Product::with(['author', 'category', 'language', 'primaryImage', 'secondaryImages'])->find($id);
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
        //dd($product->primaryImage);
        $product->load('author', 'category');
        $categories = Category::all(); // Get all categories
        return view('admin.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //dd($product);
        $validated = $request->validate([
            'title' => 'nullable|string|max:255', 
            'author_id' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'release_year' => 'nullable|integer|min:0',
            'price' => 'nullable|integer|min:0'
        ]);
        //dd($validated);
        
        // Handle author update
        if(!empty($validated['author_id'])) {
            $authorName = $validated['author_id'];
            // Check if the author already exists
            $author = \App\Models\Author::where('name', $authorName)->first();

            if (!$author) {
                // Create a new author if target author doesn't exist
                $author = \App\Models\Author::create(['name' => $authorName]);
            }

            // Assign the author to the product
            //dd($author);
            $validated['author_id'] = $author->id; 
        }    
        // Update only the fields that are filled
        $product->fill(array_filter($validated));
        $product->save();
    

        return redirect()->route('admin.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
