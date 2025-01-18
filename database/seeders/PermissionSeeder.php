<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permiso1 = Permission::create(['name' => 'gestionar-imprenta']);
        $permiso2 = Permission::create(['name' => 'gestionar-sistema']);

     
    }
}
