<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeFactory extends Factory
{
    protected $model = ProductAttribute::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'key' => 'attribute_key',
            'value' => 'attribute_value',
        ];
    }

    public function forPlant(): static
    {
        return $this->state(function (array $attributes) {
            $plantAttributes = [
                ['key' => 'light_requirement', 'value' => $this->faker->randomElement(['niedrig', 'mittel', 'hoch'])],
                ['key' => 'growth_height', 'value' => $this->faker->numberBetween(5, 50) . ' cm'],
                ['key' => 'growth_speed', 'value' => $this->faker->randomElement(['langsam', 'mittel', 'schnell'])],
                ['key' => 'co2_required', 'value' => $this->faker->randomElement(['ja', 'nein'])],
                ['key' => 'difficulty', 'value' => $this->faker->randomElement(['anfänger', 'fortgeschritten', 'experte'])],
            ];

            $attr = $this->faker->randomElement($plantAttributes);
            return $attr;
        });
    }

    public function forAnimal(): static
    {
        return $this->state(function (array $attributes) {
            $animalAttributes = [
                ['key' => 'temperature_min', 'value' => $this->faker->numberBetween(18, 22) . ' °C'],
                ['key' => 'temperature_max', 'value' => $this->faker->numberBetween(24, 28) . ' °C'],
                ['key' => 'ph_min', 'value' => $this->faker->randomFloat(1, 6.0, 7.0)],
                ['key' => 'ph_max', 'value' => $this->faker->randomFloat(1, 7.5, 8.5)],
                ['key' => 'gh_min', 'value' => $this->faker->numberBetween(5, 10)],
                ['key' => 'gh_max', 'value' => $this->faker->numberBetween(15, 20)],
                ['key' => 'max_size', 'value' => $this->faker->numberBetween(2, 8) . ' cm'],
                ['key' => 'difficulty', 'value' => $this->faker->randomElement(['anfänger', 'fortgeschritten', 'experte'])],
                ['key' => 'socialization', 'value' => $this->faker->randomElement(['Einzelhaltung', 'Gruppe', 'Artenbecken'])],
            ];

            $attr = $this->faker->randomElement($animalAttributes);
            return $attr;
        });
    }
}
