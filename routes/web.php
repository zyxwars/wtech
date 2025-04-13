<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Auth routes

Route::prefix('auth')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Products routes

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/category/{name}', [ProductController::class, 'category'])->name('category');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product');
