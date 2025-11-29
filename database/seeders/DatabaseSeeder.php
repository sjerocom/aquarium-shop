<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Image mapping for products
        $productImages = [
            'anubias-barteri' => ['anubias-1.jpg', 'anubias-2.jpg'],
            'javafarn' => ['javafern-1.jpg', 'javafern-2.jpg'],
            'cryptocoryne-wendtii' => ['cryptocoryne-1.jpg'],
            'vallisneria-spiralis' => ['vallisneria-1.jpg'],
            'wasserpest' => ['javafern-1.jpg'], // Reuse similar plant image
            'red-fire-garnele' => ['red-cherry-1.jpg', 'red-cherry-2.jpg'],
            'blue-dream-garnele' => ['blue-dream-1.jpg'],
            'amano-garnele' => ['orange-sakura-1.jpg'],
            'crystal-red-garnele' => ['red-cherry-1.jpg'],
            'cpo-zwergkrebs' => ['cpo-1.jpg', 'cpo-2.jpg'],
            'blauer-floridakrebs' => ['blue-dream-1.jpg'], // Reuse blue themed image
            'marmor-krebs' => ['marbled-1.jpg', 'marbled-2.jpg'],
        ];
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@aquarium-shop.local',
            'password' => bcrypt('Admin123!'),
            'is_admin' => true,
        ]);

        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Plant Categories
        $plantCategories = [
            ['name' => 'Vordergrundpflanzen', 'type' => 'plant', 'description' => 'Kleine Pflanzen für den Vordergrund des Aquariums'],
            ['name' => 'Mittelgrundpflanzen', 'type' => 'plant', 'description' => 'Mittelgroße Pflanzen für die Mitte des Aquariums'],
            ['name' => 'Aufsitzerpflanzen', 'type' => 'plant', 'description' => 'Pflanzen die auf Wurzeln und Steinen wachsen'],
        ];

        // Shrimp Categories
        $shrimpCategories = [
            ['name' => 'Zwerggarnelen', 'type' => 'shrimp', 'description' => 'Kleine Süßwassergarnelen für das Aquarium'],
            ['name' => 'Großarmgarnelen', 'type' => 'shrimp', 'description' => 'Größere Garnelenarten'],
        ];

        // Crab Categories
        $crabCategories = [
            ['name' => 'Zwergkrebse', 'type' => 'crab', 'description' => 'Kleine Krebse für das Aquarium'],
            ['name' => 'Flusskrebse', 'type' => 'crab', 'description' => 'Größere Flusskrebse'],
        ];

        // Plant products data
        $plantProducts = [
            ['name' => 'Anubias Barteri', 'latin' => 'Anubias barteri', 'price' => 8.99],
            ['name' => 'Javafarn', 'latin' => 'Microsorum pteropus', 'price' => 7.49],
            ['name' => 'Cryptocoryne Wendtii', 'latin' => 'Cryptocoryne wendtii', 'price' => 5.99],
            ['name' => 'Vallisneria Spiralis', 'latin' => 'Vallisneria spiralis', 'price' => 4.99],
            ['name' => 'Wasserpest', 'latin' => 'Egeria densa', 'price' => 3.99],
        ];

        // Shrimp products data
        $shrimpProducts = [
            ['name' => 'Red Fire Garnele', 'latin' => 'Neocaridina davidi', 'price' => 2.99],
            ['name' => 'Blue Dream Garnele', 'latin' => 'Neocaridina davidi', 'price' => 3.49],
            ['name' => 'Amano Garnele', 'latin' => 'Caridina multidentata', 'price' => 4.99],
            ['name' => 'Crystal Red Garnele', 'latin' => 'Caridina logemanni', 'price' => 12.99],
        ];

        // Crab products data
        $crabProducts = [
            ['name' => 'CPO Zwergkrebs', 'latin' => 'Cambarellus patzcuarensis', 'price' => 9.99],
            ['name' => 'Blauer Floridakrebs', 'latin' => 'Procambarus alleni', 'price' => 14.99],
            ['name' => 'Marmor Krebs', 'latin' => 'Procambarus fallax', 'price' => 11.99],
        ];

        // Create plant categories and products
        $plantProductOffset = 0;
        foreach ($plantCategories as $index => $catData) {
            $category = Category::create([
                'name' => $catData['name'],
                'type' => $catData['type'],
                'description' => $catData['description'],
                'is_active' => true,
            ]);

            // Create 1-2 products per category
            $count = min(2, count($plantProducts) - $plantProductOffset);
            $productsToCreate = array_slice($plantProducts, $plantProductOffset, $count);
            $plantProductOffset += $count;

            foreach ($productsToCreate as $productData) {
                $product = Product::create([
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                    'latin_name' => $productData['latin'],
                    'description' => 'Schöne Aquarienpflanze. Pflegeleicht und ideal für Anfänger. Benötigt wenig Licht und CO2.',
                    'price' => $productData['price'],
                    'stock' => rand(10, 50),
                    'is_active' => true,
                    'requires_special_shipping' => false,
                ]);

                // Add plant-specific attributes
                $plantAttrs = [
                    ['key' => 'light_requirement', 'value' => fake()->randomElement(['niedrig', 'mittel', 'hoch'])],
                    ['key' => 'growth_height', 'value' => fake()->numberBetween(5, 50) . ' cm'],
                    ['key' => 'growth_speed', 'value' => fake()->randomElement(['langsam', 'mittel', 'schnell'])],
                    ['key' => 'co2_required', 'value' => fake()->randomElement(['ja', 'nein'])],
                    ['key' => 'difficulty', 'value' => fake()->randomElement(['anfänger', 'fortgeschritten'])],
                ];

                foreach ($plantAttrs as $attr) {
                    ProductAttribute::create([
                        'product_id' => $product->id,
                        'key' => $attr['key'],
                        'value' => $attr['value'],
                    ]);
                }

                // Add images from mapping
                $images = $productImages[$product->slug] ?? [];
                foreach ($images as $i => $imagePath) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => 'products/' . $imagePath,
                        'is_primary' => $i === 0,
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        // Create shrimp categories and products
        $shrimpProductOffset = 0;
        foreach ($shrimpCategories as $catData) {
            $category = Category::create([
                'name' => $catData['name'],
                'type' => $catData['type'],
                'description' => $catData['description'],
                'is_active' => true,
            ]);

            // Create 2 products per category
            $count = min(2, count($shrimpProducts) - $shrimpProductOffset);
            $productsToCreate = array_slice($shrimpProducts, $shrimpProductOffset, $count);
            $shrimpProductOffset += $count;

            foreach ($productsToCreate as $productData) {
                $product = Product::create([
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                    'latin_name' => $productData['latin'],
                    'description' => 'Wunderschöne Zwerggarnele. Pflegeleicht und friedlich. Ideal für Gesellschaftsbecken.',
                    'price' => $productData['price'],
                    'stock' => rand(20, 100),
                    'is_active' => true,
                    'requires_special_shipping' => true,
                ]);

                // Add shrimp-specific attributes
                $shrimpAttrs = [
                    ['key' => 'temperature_min', 'value' => fake()->numberBetween(18, 22) . ' °C'],
                    ['key' => 'temperature_max', 'value' => fake()->numberBetween(24, 28) . ' °C'],
                    ['key' => 'ph_min', 'value' => (string) fake()->randomFloat(1, 6.0, 7.0)],
                    ['key' => 'ph_max', 'value' => (string) fake()->randomFloat(1, 7.5, 8.5)],
                    ['key' => 'max_size', 'value' => fake()->numberBetween(2, 4) . ' cm'],
                    ['key' => 'difficulty', 'value' => fake()->randomElement(['anfänger', 'fortgeschritten'])],
                ];

                foreach ($shrimpAttrs as $attr) {
                    ProductAttribute::create([
                        'product_id' => $product->id,
                        'key' => $attr['key'],
                        'value' => $attr['value'],
                    ]);
                }

                // Add images from mapping
                $images = $productImages[$product->slug] ?? [];
                foreach ($images as $i => $imagePath) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => 'products/' . $imagePath,
                        'is_primary' => $i === 0,
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        // Create crab categories and products
        $crabProductOffset = 0;
        foreach ($crabCategories as $catData) {
            $category = Category::create([
                'name' => $catData['name'],
                'type' => $catData['type'],
                'description' => $catData['description'],
                'is_active' => true,
            ]);

            // Create 1-2 products per category
            $count = min(2, count($crabProducts) - $crabProductOffset);
            if ($count > 0) {
                $productsToCreate = array_slice($crabProducts, $crabProductOffset, $count);
                $crabProductOffset += $count;
            } else {
                $productsToCreate = [];
            }

            foreach ($productsToCreate as $productData) {
                $product = Product::create([
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                    'latin_name' => $productData['latin'],
                    'description' => 'Interessanter Aquarienkrebs. Benötigt Versteckmöglichkeiten und separate Haltung.',
                    'price' => $productData['price'],
                    'stock' => rand(5, 20),
                    'is_active' => true,
                    'requires_special_shipping' => true,
                ]);

                // Add crab-specific attributes
                $crabAttrs = [
                    ['key' => 'temperature_min', 'value' => fake()->numberBetween(18, 22) . ' °C'],
                    ['key' => 'temperature_max', 'value' => fake()->numberBetween(24, 28) . ' °C'],
                    ['key' => 'ph_min', 'value' => (string) fake()->randomFloat(1, 6.5, 7.0)],
                    ['key' => 'ph_max', 'value' => (string) fake()->randomFloat(1, 7.5, 8.0)],
                    ['key' => 'max_size', 'value' => fake()->numberBetween(4, 12) . ' cm'],
                    ['key' => 'difficulty', 'value' => fake()->randomElement(['fortgeschritten', 'experte'])],
                    ['key' => 'socialization', 'value' => fake()->randomElement(['Einzelhaltung', 'Artenbecken'])],
                ];

                foreach ($crabAttrs as $attr) {
                    ProductAttribute::create([
                        'product_id' => $product->id,
                        'key' => $attr['key'],
                        'value' => $attr['value'],
                    ]);
                }

                // Add images from mapping
                $images = $productImages[$product->slug] ?? [];
                foreach ($images as $i => $imagePath) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => 'products/' . $imagePath,
                        'is_primary' => $i === 0,
                        'sort_order' => $i,
                    ]);
                }
            }
        }
    }
}
