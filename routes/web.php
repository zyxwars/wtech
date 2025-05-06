<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\StripQueryParams;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

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

// Product routes

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/category/{name}', [ProductController::class, 'category'])->name('product.category')->middleware(StripQueryParams::class);

Route::get('/search', [ProductController::class, 'search'])->name('product.search')->middleware(StripQueryParams::class);

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show')->middleware(StripQueryParams::class);

// Cart routes

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart', [CartController::class, 'store'])->name('cart.store');

Route::put('/cart/{productId}', [CartController::class, 'update'])->name('cart.update');

Route::delete('/cart/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');

// Order routes

Route::get('/delivery-and-payment', [OrderController::class, 'create'])->name('order.create');

Route::post('/delivery-and-payment', [OrderController::class, 'store'])->name('order.store');

Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');

// Admin routes
Route::middleware(['auth','is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');
    });