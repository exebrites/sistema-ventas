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
        $permission1 = Permission::create(['name' => 'gestionar-imprenta']);
        // $permission2 = Permission::create(['name' => 'gestionar-sistema']);
        $role = Role::create(['name' => 'admin']);

        $role->givePermissionTo($permission1);
        // $role->givePermissionTo($permission2);

        $user = User::create([
            'name' => 'exe',
            'email' => 'exe@gmail.com',
            'password' => Hash::make('123123123'),
        ]);
        $user->assignRole($role);
    }
}
