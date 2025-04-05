<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);

Route::get('/categories/{category}', [ProductController::class, 'category']);

Route::get('/search/{search}', [ProductController::class, 'search']);
