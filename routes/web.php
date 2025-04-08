<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/category/{name}', [ProductController::class, 'category'])->name('category');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product');
