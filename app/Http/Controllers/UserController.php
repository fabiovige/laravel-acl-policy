<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //$this->authorize('viewAny', User::class);
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $roles = User::getRoles();

        return view('users.create',compact('roles' ));
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'role' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['user_id'] = auth()->id();

        $user = User::create($input);
        $user->assignRole($request->input('role'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    public function show(User $user)
    {
        //$this->authorize('any', User::class);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.role',compact('user', 'roles', 'permissions'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = User::getRoles();

        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole', ));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'same:confirm-password',
            'role' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->input('role'));

        //DB::table('client_user')->whereIn('client_id',$request->input('clients'))->delete();
        //$user->clients()->sync($request->input('clients'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    public function destroy(User $user)
    {
        //$this->authorize('update', $user);
        if($user->hasRole('admin')){
            return redirect()->route('users.index')->with('warning','Você é um administrador.');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success','Usuário removido.');
    }

    public function assignRole(Request $request, User $user)
    {
        if($user->hasRole($request->role)){
            return redirect()->route('users.show', $user->id)->with('warning','Registro já está adicionado.');
        }
        $user->assignRole($request->role);
        return redirect()->route('users.show', $user->id)->with('success','Registro adicionado.');
    }

    public function removeRole(User $user, Role $role)
    {
        if($user->hasRole($role)){
            $user->removeRole($role);
            return redirect()->route('users.show', $user->id)->with('success','Registro removido.');
        }
        return redirect()->route('users.show', $user->id)->with('warning','Registro não existe.');
    }

    public function givePermission(Request $request, User $user)
    {
        if($user->hasPermissionTo($request->permission)){
            return redirect()->route('users.show', $user->id)->with('warning','Registro já está adicionado.');
        }
        $user->givePermissionTo($request->permission);
        return redirect()->route('users.show', $user->id)->with('success','Registro adicionado.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if($user->hasPermissionTo($permission)){
            $user->revokePermissionTo($permission);
            return redirect()->route('users.show', $user->id)->with('success','Registro removido.');
        }
        return redirect()->route('users.show', $user->id)->with('warning','Registro não existe.');
    }
}
