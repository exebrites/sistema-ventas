<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre_empresa' => $this->faker->company,
            'nombre_contacto' => $this->faker->name,
            'cuit' => $this->faker->numerify('###########'), // Puedes ajustar esto según el formato real del CUIT
            'telefono' => $this->faker->phoneNumber,
            'correo' => $this->faker->email,
        ];
    }
}
