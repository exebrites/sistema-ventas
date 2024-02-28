<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entrega>
 */
class EntregaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pedido_id' => $this->faker->unique()->numberBetween(10, 65),
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'recepcion' => $this->faker->boolean,
            'nota' => $this->faker->sentence,
            'local' => $this->faker->boolean,
        ];
    }
}
