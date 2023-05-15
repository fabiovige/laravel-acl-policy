@extends('layouts.app')
@section('content')

<x-back title="Gerenciamento de acesso" route="users"></x-back>

<div class="row py-3">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-body">
                <h4>Dados do usuário</h4>
                <strong>Name:</strong> {{ $user->name }} <br>
                <strong>E-mail:</strong> {{ $user->email }} <br>
                @if($user->roles->count() > 0)
                <strong>Papéis:</strong><br>
                <ul>
                    @foreach ( $user->roles as $role )
                        <li >
                            {{ $role->name }}
                            <ul>
                                @foreach ( $role->permissions as $permission )
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
                @endif

                @if($user->permissions->count() > 0)
                    <strong>Permissões:</strong><br>
                    <ul>
                        @foreach ( $user->permissions as $permission )
                            <li >
                                {{ $permission->name }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

@can('users.roles.edit')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h4>{{ __('Roles') }}</h4>

                    <form action="{{ route('users.roles', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="py-3">

                            <x-checkbox-access name="role" :rows="$roles" :contains="$user->roles"></x-checkbox-access>

                            <div class="d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-success">{{ __('Save Role') }}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endcan

@can('users.permissions.edit')
    <div class="row py-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h4>{{ __('Permissions') }}</h4>

                    <form action="{{ route('users.permissions', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="py-3">

                            <x-checkbox-access name="permissions" :rows="$permissions" :contains="$user->permissions"></x-checkbox-access>

                            <div class="d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-success">{{ __('Save Permission') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endcan

@endsection
