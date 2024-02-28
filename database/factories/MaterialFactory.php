<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // id integer pk
        // nombre string
        // descripcion string
        // cod_interno string
        // stock string
        // unidad_medida string
        // fecha_adquisicion date
        // fecha_vencimiento date
        // notas string
        return [
            'nombre' => $this->faker->name(),
            'descripcion' => $this->faker->text(),
            'cod_interno' => "xxxx",
            'stock' => random_int(0, 100),
            // 'unidad_medida' => "zzzz",
            'fecha_adquisicion' => $this->faker->date(),
            'fecha_vencimiento' => $this->faker->date(),
            'precio_compra'=>  random_int(0, 100),
            // 'notas' => $this->faker->text()
        ];
    }
}
