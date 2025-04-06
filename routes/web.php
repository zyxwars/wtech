<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/categories/{categoryName}', [ProductController::class, 'category']);

Route::get('/search/{search}', [ProductController::class, 'search']);
