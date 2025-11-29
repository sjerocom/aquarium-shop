<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(string $type)
    {
        // Validate type
        if (!in_array($type, ['plant', 'shrimp', 'crab'])) {
            abort(404);
        }

        $categories = Category::where('type', $type)
            ->where('is_active', true)
            ->withCount('products')
            ->get();

        $typeNames = [
            'plant' => 'Pflanzen',
            'shrimp' => 'Garnelen',
            'crab' => 'Krebse',
        ];

        return view('categories.index', [
            'categories' => $categories,
            'type' => $type,
            'typeName' => $typeNames[$type],
        ]);
    }

    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = $category->products()
            ->where('is_active', true)
            ->with(['category', 'primaryImage', 'attributes'])
            ->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }
}
