<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;
class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
            'nombre' => 'Pendiente',
            'descripcion' => 'Pendiente',
        ]);
        Estado::create([
            'nombre' => 'Desapachado',
            'descripcion' => 'Desapachado',
        ]);
        Estado::create([
            'nombre' => 'Cancelado',
            'descripcion' => 'Cancelado',
        ]);
    }
}
