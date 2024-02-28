<?php

namespace Database\Seeders;

use App\Models\Disenio;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiseniosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disenio::factory()->count(50)->create();

    }
}
