<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $products = [
            'plant' => [
                ['name' => 'Anubias Barteri', 'latin' => 'Anubias barteri'],
                ['name' => 'Javafarn', 'latin' => 'Microsorum pteropus'],
                ['name' => 'Cryptocoryne Wendtii', 'latin' => 'Cryptocoryne wendtii'],
                ['name' => 'Vallisneria Spiralis', 'latin' => 'Vallisneria spiralis'],
                ['name' => 'Wasserpest', 'latin' => 'Egeria densa'],
            ],
            'shrimp' => [
                ['name' => 'Red Fire Garnele', 'latin' => 'Neocaridina davidi'],
                ['name' => 'Blue Dream Garnele', 'latin' => 'Neocaridina davidi'],
                ['name' => 'Amano Garnele', 'latin' => 'Caridina multidentata'],
                ['name' => 'Crystal Red Garnele', 'latin' => 'Caridina logemanni'],
            ],
            'crab' => [
                ['name' => 'CPO Zwergkrebs', 'latin' => 'Cambarellus patzcuarensis'],
                ['name' => 'Blauer Floridakrebs', 'latin' => 'Procambarus alleni'],
                ['name' => 'Marmor Krebs', 'latin' => 'Procambarus fallax'],
            ],
        ];

        $category = Category::inRandomOrder()->first();
        $categoryProducts = $products[$category->type] ?? [];
        $product = $this->faker->randomElement($categoryProducts);

        return [
            'category_id' => $category->id,
            'name' => $product['name'],
            'slug' => \Illuminate\Support\Str::slug($product['name']),
            'latin_name' => $product['latin'] ?? null,
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 3.99, 49.99),
            'stock' => $this->faker->numberBetween(0, 50),
            'is_active' => true,
            'requires_special_shipping' => in_array($category->type, ['shrimp', 'crab']),
        ];
    }
}
