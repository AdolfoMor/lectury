<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return Inertia::render('Admin/Permissions/Index', compact('permissions'));
    }

    public function create()
    {
        return Inertia::render('Admin/Permissions/Form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create($data);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permiso creado correctamente.');
    }

    public function edit(Permission $permission)
    {
        return Inertia::render('Admin/Permissions/Form', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($data);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permiso actualizado correctamente.');
    }

    public function destroy(Permission $permission)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return redirect()->back()->withErrors(['error' => 'Permiso no encontrado']);
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permiso eliminado correctamente.');
    }
}
