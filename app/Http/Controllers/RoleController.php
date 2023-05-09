<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
    }

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
        return redirect()->route('roles.index')->with('success','Registro criado com sucesso.');
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
        return redirect()->route('roles.index')->with('success','Registro atualizado com sucesso.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success','Registro excluído com sucesso.');
    }

    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permissão já esta adicionado ao papel.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permissão adicionado ao papel com sucesso.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permissão removido do papel.');
        }
        return back()->with('message', 'Permissão não existe.');
    }
}
