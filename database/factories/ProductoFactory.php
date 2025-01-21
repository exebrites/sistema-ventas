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
            'nombre' => $this->faker->name(),
            'precio' => $this->faker->randomFloat(2),
            // 'slug' => $this->faker->lexify(),
            'descripcion' => $this->faker->lexify(),
            'category_id' => 1,
            'imagen' => $this->faker->imageUrl(640, 480, 'animals', true),
            'alias' => $this->faker->lexify(),
            'visitas' => 0,
            'sku' => $this->faker->unique()->ean13(),
            'codigo_barras' => $this->faker->ean8(),
            'marca' => $this->faker->company(),
            'dimensiones' => $this->faker->randomFloat(1, 2) . ' x ' . $this->faker->randomFloat(1, 2) . ' x ' . $this->faker->randomFloat(1, 2),
            'peso' => $this->faker->randomFloat(1, 2),
            'material' => $this->faker->randomElement(['plástico', 'papel', 'madera']),
            'color' => $this->faker->colorName(),
            'formato' => $this->faker->randomElement(['Tapa dura', 'Tapa blanda', 'Digital']),
            'tinta' => $this->faker->randomElement(['Offset', 'Digital', 'Tipograf a']),
            'gramaje' => $this->faker->randomFloat(1, 2),
            'tamanio' => $this->faker->randomElement(['Peque o', 'Mediano', 'Grande']),
            'autor' => $this->faker->name(),
            'editorial' => $this->faker->company(),
            'numero_paginas' => $this->faker->numberBetween(1, 1000),
            'idioma' => $this->faker->languageCode(),
            'edicion' => $this->faker->numberBetween(1, 10),
            'anio_publicacion' => $this->faker->year(),
            'genero' => $this->faker->randomElement(['Acción', 'Aventura', 'Ciencia ficción', 'Fantasía', 'Misterio', 'Romance', 'Terror'])

        ];
    }
}
