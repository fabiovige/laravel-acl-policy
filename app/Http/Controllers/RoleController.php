<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('roles.index');

        $roles = auth()->id() === User::ADMIN ? Role::all() : auth()->user()->roles;

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('roles.create');

        return view('roles.create');
    }

    public function store(Request $request)
    {
        $this->authorize('roles.create');

        $validated = $request->validate([
            'name' => ['required', 'min:3', 'unique:roles,name'],
        ]);
        $role = Role::create($validated);
        auth()->user()->assignRole($role);

        return redirect()->route('roles.index')->with('success','Registro adicionado.');
    }

    public function show(Role $id)
    {
        $this->authorize('roles.show');

    }

    public function edit(Role $role)
    {
        $this->authorize('roles.edit');

        $permissions = auth()->id() === User::ADMIN ? Permission::all() : auth()->user()->getAllPermissions();

        return view('roles.edit',compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('roles.edit');

        $validated = $request->validate([
            'name' => ['required', 'min:3', 'unique:roles,name,id'],
        ]);
        $role->update($validated);
        return redirect()->route('roles.index')->with('success','Registro atualizado.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('roles.destroy');

        if(in_array($role->name,auth()->user()->roles->pluck('name')->toArray())){
            return redirect()->route('roles.index')->with('warning','Nao é possível remover esse papél porque está em uso na sua sessão!');
        }

        $role->delete();
        return redirect()->route('roles.index')->with('success','Registro removido.');
    }

    public function givePermission(Request $request, Role $role)
    {
        $this->authorize('roles.edit');

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
        $this->authorize('roles.edit');

        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return redirect()->route('roles.edit', $role->id)->with('success','Registro removido.');
        }
        return redirect()->route('roles.edit', $role->id)->with('success','Registro não existe.');
    }
}
