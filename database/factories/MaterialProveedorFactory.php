<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialProveedor>
 */
class MaterialProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'proveedor_id' => random_int(5, 9),
            'material_id' => random_int(7, 16),
            'precio_actual' => random_int(1, 1000),
            'precio_actualizado' => random_int(1, 1000)
        ];
    }
}
