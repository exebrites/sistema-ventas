<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //     $role1= Role::create(['name'=>'admin']);
        //     $role2= Role::create(['name'=>'cliente']);

        // Permission::create(['name'=>'admin.home'])->syncRoles($role1);

        // Permission::create(['name'=>'admin.productos.index'])->syncRoles($role1);
        // Permission::create(['name'=>'admin.productos.create'])->syncRoles($role1);
        // Permission::create(['name'=>'admin.productos.edit'])->syncRoles($role1);
        // Permission::create(['name'=>'admin.productos.destroy'])->syncRoles($role1);


        $role1=User::where('tipo_usuario','cliente')->get();
        $role1= Role::create(['name'=>'admin']);

    }
}
