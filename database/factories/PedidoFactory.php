<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'clientes_id' => $this->faker->numberBetween(8, 57),
            'fecha_inicio' => $this->faker->date,
            'fecha_entrega' => $this->faker->date,
            'estado' => $this->faker->randomElement(['Pendiente', 'En progreso', 'Completado']),
        ];
    }
}
