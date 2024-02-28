<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ])->assignRole('admin');


        //para ejecutar todos los seeders 
        //php artisan db:seed
        $this->call(ProductoSeeder::class);
        // $this->call(RoleSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
