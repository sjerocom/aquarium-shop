<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Categories
Route::get('/kategorien/{type}', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/kategorie/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Products
Route::get('/produkt/{slug}', [ProductController::class, 'show'])->name('products.show');

// Cart
Route::get('/warenkorb', [CartController::class, 'index'])->name('cart.index');
Route::post('/warenkorb/add/{slug}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/warenkorb/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/warenkorb/update/{productId}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::delete('/warenkorb/clear', [CartController::class, 'clear'])->name('cart.clear');

// Static Pages
Route::get('/impressum', [PageController::class, 'imprint'])->name('pages.imprint');
Route::get('/datenschutz', [PageController::class, 'privacy'])->name('pages.privacy');
Route::get('/versand', [PageController::class, 'shipping'])->name('pages.shipping');
