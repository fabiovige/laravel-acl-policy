<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()->hasRole('admin')){
            $users = User::all();
        } else {
            $users = User::where('id','!=',1)->get();
        }
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['user_id'] = auth()->id();

        $user = User::create($input);

        return redirect()->route('users.index')->with('success','Registro criado.');
    }
    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.role',compact('user', 'roles', 'permissions'));
    }
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user->update($input);

        return redirect()->route('users.index')->with('success','Registro atualizado.');
    }

    public function destroy(User $user)
    {
        if($user->hasRole('admin')){
            return redirect()->route('users.index')->with('warning','Você é um administrador.');
        }

        if($user->id === auth()->id()){
            return redirect()->route('users.index')->with('warning','Permissão negada.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success','Usuário removido.');
    }

    public function assignRole(Request $request, User $user)
    {
        $this->authorize('users.roles.edit');

        $roles = $user->roles;
        //dd($roles);
        //remove roles user
        if($roles){
            foreach($roles as $role) {
                if($user->hasRole($role)){
                    $user->removeRole($role);
                }
            }
        }

        //dd($request->role);
        // add roles user
        if($request->role){
            foreach($request->role as $role) {
                if(!$user->hasRole($role)){
                    $user->assignRole($role);
                }
            }
        }

        return redirect()->route('users.show', $user->id)->with('success','Registro adicionado.');
    }

    public function givePermission(Request $request, User $user)
    {
        $this->authorize('users.permissions.edit');

        //dd($user->permissions);
        if($user->permissions){
            foreach($user->permissions as $permission){
                if($user->hasPermissionTo($permission)){
                    $user->revokePermissionTo($permission);
                }
            }
        }

        //dd($request->permissions);
        if($request->permissions){
            foreach($request->permissions as $permission){
                $user->givePermissionTo($permission);
            }
        }

        return redirect()->route('users.show', $user->id)->with('success','Registro adicionado.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        $this->authorize('permissions-update');

        if($user->hasPermissionTo($permission)){
            $user->revokePermissionTo($permission);
            return redirect()->route('users.show', $user->id)->with('success','Registro removido.');
        }
        return redirect()->route('users.show', $user->id)->with('warning','Registro não existe.');
    }
}
