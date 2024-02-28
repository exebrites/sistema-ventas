<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    public function index()
    {
        $permisos = Permission::all();
        return view('permisos.index', compact('permisos'));
    }

    public function create()
    {
        return view('permisos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permisos.index')->with('success', 'Permiso creado exitosamente');
    }

    public function edit(Permission $permiso)
    {
        return view('permisos.edit', compact('permiso'));
    }
    public function show(Permission $permiso)
    {
        return view('permisos.show', compact('permiso'));
    }

    public function update(Request $request, Permission $permiso)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permiso->id,
        ]);

        $permiso->update(['name' => $request->name]);

        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado exitosamente');
    }

    public function destroy(Permission $permiso)
    {
        $permiso->delete();
        return redirect()->route('permisos.index')->with('success', 'Permiso eliminado exitosamente');
    }
}
