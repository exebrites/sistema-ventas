<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetallePedido>
 */
class DetallePedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pedido_id' => $this->faker->numberBetween(10, 65),
            'producto_id' => $this->faker->numberBetween(30, 122),
            'cantidad' => $this->faker->numberBetween(1, 10),
            'subtotal' => $this->faker->randomFloat(2, 10, 100),
            'produccion' => $this->faker->boolean,
        ];
    }
}
