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
        $this->authorize('users.index');

        if(auth()->id() === User::ADMIN) {
             $users = User::all();
        } else if(auth()->user()->can('users.edit.all')) {
            $users = User::where('user_id', auth()->user()->user_id)->get();
        }else {
            $users = User::where('user_id', auth()->id())->get();
        }
        return view('users.index', compact('users'));
    }


    public function obterIdsFilhos($usuarios)
    {
        $idsFilhos = [];
        foreach ($usuarios as $usuario) {
            $idsFilhos[] = $usuario->id;
            $filhos = User::where('user_id', $usuario->id)->get();
            $idsFilhos = array_merge($idsFilhos, $this->obterIdsFilhos($filhos));
        }
        return $idsFilhos;
    }


    public function create()
    {
        $this->authorize('users.create');

        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->authorize('users.create');

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
        $this->authorize('users.show');

        $roles = auth()->id() === User::ADMIN ? Role::all() : auth()->user()->roles;
        $permissions = auth()->id() === User::ADMIN ? Permission::all() : auth()->user()->getAllPermissions();

        return view('users.role',compact('user', 'roles', 'permissions'));
    }
    public function edit(User $user)
    {
        $this->authorize('users.edit');

        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('users.edit');

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
        $this->authorize('users.destroy');

        if($user->hasRole('admin')){
            return redirect()->route('users.index')->with('warning','Você é um administrador.');
        }

        if($user->id === auth()->id()){
            return redirect()->route('users.index')->with('warning','Informe seu administrador para que realize esta operação.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success','Usuário removido.');
    }

    public function assignRole(Request $request, User $user)
    {
        $this->authorize('users.roles.edit');

        $roles = $user->roles;
        //dd($roles);
        if($roles){
            foreach($roles as $role) {
                if($user->hasRole($role)){
                    $user->removeRole($role);
                }
            }
        }

        //dd($request->role);
        $message['success'] = "Papél atualizado.";
        if($request->role){
            foreach($request->role as $role) {
                if(!$user->hasRole($role)){
                    $user->assignRole($role);
                } else {
                    $message['warning'] = "Papél $role já está atribuída.";
                }
            }
        }

        return redirect()->route('users.show', $user->id)->with($message);
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
        $message['success'] = "Permissão atualizado.";
        if($request->permissions){
            foreach($request->permissions as $permission){
                if(!$user->hasPermissionTo($permission)){
                    $user->givePermissionTo($permission);
                } else {
                    $message['warning'] = "Permissão $permission já está atribuída.";
                }
            }
        }

        return redirect()->route('users.show', $user->id)->with($message);
    }

}
