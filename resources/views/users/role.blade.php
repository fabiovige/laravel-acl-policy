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
                <strong>Permissões:</strong><br>
                <ul>
                    @foreach ( $user->permissions as $permission )
                        <li >
                            {{ $permission->name }}
                        </li>
                    @endforeach
                </ul>
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
                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $role->name }}"
                                        name="role[]"
                                        @if ($user->roles->contains($role)) checked @endif
                                        >
                                    <label class="form-check-label" for="role">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach

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
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $permission->name }}"
                                        name="permissions[]" @if ($user->permissions->contains($permission)) checked @endif>
                                    <label class="form-check-label" >
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach

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
