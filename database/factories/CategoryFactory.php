<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $types = ['plant', 'shrimp', 'crab'];
        $type = $this->faker->randomElement($types);

        $names = [
            'plant' => ['Vordergrundpflanzen', 'Mittelgrundpflanzen', 'Hintergrundpflanzen', 'Aufsitzerpflanzen', 'Schwimmpflanzen'],
            'shrimp' => ['Zwerggarnelen', 'Fächergarnelen', 'Großarmgarnelen', 'Süßwassergarnelen'],
            'crab' => ['Zwergkrebse', 'Flusskrebse', 'Krabben'],
        ];

        $name = $this->faker->randomElement($names[$type]);

        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'type' => $type,
            'description' => $this->faker->paragraph(),
            'image' => null,
            'is_active' => true,
        ];
    }
}
