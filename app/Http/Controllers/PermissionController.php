<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('permissions-list');

        $permissions = Permission::all();
        $data = [
            'permissions' => $permissions
        ];
        return view('permissions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('permissions-create');

        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('permissions-create');

        $validated = $request->validate([
            'name' => ['required', 'min:3', 'unique:permissions,name'],
        ]);
        $role = Permission::create($validated);
        //$role->syncPermissions($request->input('permission'));

        return redirect()->route('permissions.index')->with('success','Registro adicionado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('permissions-show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $this->authorize('permissions-update');

        $roles = Role::all();
        return view('permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('permissions-update');

        $validated = $request->validate([
            'name' => ['required', 'min:3', 'unique:permissions,name'],
        ]);
        $permission->update($validated);
        return redirect()->route('permissions.index')->with('success','Registro atualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('permissions-destroy');

        $permission->delete();
        return redirect()->route('permissions.index')->with('success','Registro removido.');
    }

    public function assignRole(Request $request, Permission $permission)
    {
        // remove role
        foreach($permission->roles as $role) {
            if($permission->hasRole($role)){
                $permission->removeRole($role);
            }
        }

        foreach($request->role as $role) {
            if(!$permission->hasRole($request->role)){
                $permission->assignRole($request->role);
            }
        }
        return redirect()->route('permissions.edit', $permission->id)->with('success','Registro adicionado.');
    }

    public function removeRole(Permission $permission, Role $role)
    {
        $this->authorize('permissions-update');

        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return redirect()->route('permissions.edit', $permission->id)->with('success','Registro removido.');
        }
        return redirect()->route('permissions.edit', $permission->id)->with('warning','Registro não existe.');
    }

}
