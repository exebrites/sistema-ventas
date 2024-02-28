<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2),
            'slug' => $this->faker->lexify(),
            'description' => $this->faker->lexify(),
            'category_id' => 1,
            'image_path' => $this->faker->imageUrl(640, 480, 'animals', true),
            'alias' => $this->faker->lexify(),
            'visitas' => 0

        ];
    }
}
