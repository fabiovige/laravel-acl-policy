<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        $data = [
            'roles' => $roles,
        ];
        return view('roles.index', $data);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'unique:roles,name'],
        ]);
        Role::create($validated);
        return redirect()->route('roles.index')->with('success','Registro adicionado.');
    }

    public function show(string $id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit',compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'unique:roles,name,id'],
        ]);
        $role->update($validated);
        return redirect()->route('roles.index')->with('success','Registro atualizado.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('roles-destroy');

        $role->delete();
        return redirect()->route('roles.index')->with('success','Registro removido.');
    }

    public function givePermission(Request $request, Role $role)
    {
        // revoke permissions role
        $rolePermissions = $role->permissions;
        foreach($rolePermissions as $rolePermission){
            if($role->hasPermissionTo($rolePermission)){
                $role->revokePermissionTo($rolePermission);
            }
        }

        // add new permission role
        if($request->permission){
            foreach($request->permission as $permission){
                if(!$role->hasPermissionTo($permission)){
                    $role->givePermissionTo($permission);
                }
            }
        }
        return redirect()->route('roles.edit', $role->id)->with('success','Registro adicionado.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        $this->authorize('roles-update');

        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return redirect()->route('roles.edit', $role->id)->with('success','Registro removido.');
        }
        return redirect()->route('roles.edit', $role->id)->with('success','Registro não existe.');
    }
}
