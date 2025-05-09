<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductImage;

class ImageController extends Controller
{
    public function destroy(Request $request, string $imageId)
    {   
        //dd('here');
        $productId = $request->input('product_id');
        
        // Check if the image belongs to the product
        $deleteImage = ProductImage::where('id', $imageId)
            ->where('product_id', $productId)
            ->first();
        
        if (!$deleteImage) {
            return redirect()->back()->with('error', 'Image not found or does not belong to the product.');
        }
        
        // Delete the image from db
        $deleteImage->delete();
        //dd($deleteImage);
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    public function upload(Request $request, Product $product)
    {
        // Validate the request
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        

        // Handle each uploaded image
        if ($request->hasFile('images')) {
            
            foreach ($request->file('images') as $image) {
                //dd($product->id);
                $path = $image->store('product-images', 'public'); // Save the file to storage
                //dd($path);
                ProductImage::create([
                    'uri' => '/storage/' . $path, // Save the file path
                    'is_primary' => false, // Mark as secondary image
                    'product_id' => $product->id, // Associate with the product
                ]);
                
            }
        }

        //dd('end');
        return redirect()->back()->withSuccess("Images added!");
    }
    
}
