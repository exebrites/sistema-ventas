<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Disenio>
 */
class DisenioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        // ['detallePedido_id','url_imagen','url_disenio', 'disenio_estado','revision'];
        return [
            'detallePedido_id' => $this->faker->numberBetween(10, 57),
            'url_imagen' => $this->faker->imageUrl(),
            'url_disenio' => $this->faker->url,
            'disenio_estado' => $this->faker->boolean,
            'revision' => $this->faker->boolean,
        ];
    }
}
