<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::all(); // Get all categories
        $languages = \App\Models\Language::all(); // Get all languages
        return view('admin.create', compact('categories', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255', 
            'author_id' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'release_year' => 'nullable|integer|min:0',
            'price' => 'nullable|integer|min:0',
            'language_id' => 'nullable|exists:languages,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        //dd($validated);
        
        // Handle author
        if(!empty($validated['author_id'])) {
            $authorName = $validated['author_id'];
            // Check if the author already exists
            $author = \App\Models\Author::where('name', $authorName)->first();

            if (!$author) {
                // Create a new author if target author doesn't exist
                $author = \App\Models\Author::create(['name' => $authorName]);
                //dd('new author ' . $author->name);
            }
            
            // Assign the author to the product
            //dd($author);
            $validated['author_id'] = $author->id; 
        }    

        $product = Product::create($validated);

        $primaryFlag = true;
        // Handle each uploaded image
        if ($request->hasFile('images')) {
            //dd('if');
            foreach ($request->file('images') as $image) {
                //dd($product->id);
                $path = $image->store('product-images', 'public'); // Save the file to storage
                //dd($path);
                ProductImage::create([
                    'uri' => '/storage/' . $path, // Save the file path
                    'is_primary' => $primaryFlag, // Mark as secondary image
                    'product_id' => $product->id, // Associate with the product
                ]);
                $primaryFlag = false;
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
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
        $product->load('author', 'category', 'language');
        $categories = Category::all(); // Get all categories
        $languages = \App\Models\Language::all(); // Get all languages
        return view('admin.edit', compact('product', 'categories', 'languages'));
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
            'price' => 'nullable|integer|min:0',
            'language_id' => 'nullable|exists:languages,id'
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
        //dd($product);
        if($product->primaryImage){
            //delete the primary image from storage
            if(\Illuminate\Support\Facades\Storage::exists(str_replace('/storage/', '', $product->primaryImage->uri))){
                \Illuminate\Support\Facades\Storage::delete(str_replace('/storage/', '', $product->primaryImage->uri));
                dd('if');
            }
            // delete the primary image from db
            $product->primaryImage->delete();
        }
        foreach($product->secondaryImages as $image){
            //delete the secondary image from storage
            if(\Illuminate\Support\Facades\Storage::exists(str_replace('/storage/', '', $image->uri))){
                \Illuminate\Support\Facades\Storage::delete(str_replace('/storage/', '', $image->uri));
            }
            // delete the secondary image from db
            $image->delete();
        }

        //delete the product
        $product->delete();
        return redirect()->route('admin.dashboard');
    }
}
