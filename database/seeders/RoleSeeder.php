<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $role = Role::create(['name' => 'admin']);
        $p1 = Permission::find(1);
        $p2 = Permission::find(2);

        $role->givePermissionTo($p1);
        $role->givePermissionTo($p2);

    }
}
