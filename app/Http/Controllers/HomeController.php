<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get()
            ->groupBy('type');

        $featuredProducts = Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->with(['category', 'primaryImage'])
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('categories', 'featuredProducts'));
    }
}
