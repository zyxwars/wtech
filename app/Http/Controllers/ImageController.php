<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;

class ImageController extends Controller
{
    public function destroy(Request $request, string $imageId)
    {   
        dd('here');
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
        dd($deleteImage);
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
