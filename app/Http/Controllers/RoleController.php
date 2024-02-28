<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Rol creado con éxito');
    }

    public function edit(Role $role)
    {

        return view('roles.edit', compact('role'));
    }
    public function show(Role $role)
    {

        return view('roles.show', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success',  'Rol actualizado con éxito');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success',  'Rol eliminado con éxito');
    }
    public function editRol($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('roles.edit_rol', compact('role', 'permissions'));
    }
    public function updateRol(Request $request, Role $role)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        //     'permissions' => 'array',
        // ]);
        $id = $request->rol_id;
        $role = Role::find($id);
        // return $role->permissions;

        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('success', 'Permisos removidos del rol exitosamente');
    }
    public function remover(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = $request->input('permissions', []);

        $role->revokePermissionTo($permissions);

        return redirect()->back()->with('success', 'Permisos removidos del rol exitosamente');
    }
}
