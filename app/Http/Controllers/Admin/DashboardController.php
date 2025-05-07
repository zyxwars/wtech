<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::with(['author', 'category', 'language', 'primaryImage'])->paginate(10);
        //dd($products);
        return view('admin.dashboard', compact('products'));
    }
}
