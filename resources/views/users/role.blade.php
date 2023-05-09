@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Gerenciamento de acesso</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Voltar</a>
        </div>
    </div>
</div>
<div class="row py-3">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-body">
            <h4>Dados do usuário</h4>
            <strong>Name:</strong> {{ $user->name }} <br>
            <strong>E-mail:</strong> {{ $user->email }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mt-3">
                    <h4>Papéis</h4>
                    @if ($user->roles)
                        @foreach ($user->roles as $user_role)
                            <div class="col-2">
                                <form method="POST"
                                    action="{{ route('users.roles.remove', [$user->id, $user_role->id]) }}"
                                    onsubmit="return confirm('Deseja realmente excluir?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm btn-secondary">{{ $user_role->name }}</button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>

                <form action="{{ route('users.roles', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="py-3">
                        <select class="form-select" aria-label="select" name="role">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row py-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="row mt-3">
                    <h4>Permissões</h4>

                    @if ($user->permissions)
                        @foreach ($user->permissions as $user_permission)
                        <div class="col-2">
                            <form method="POST" action="{{route('users.permissions.revoke', [$user->id, $user_permission->id])}}" onsubmit="return confirm('Deseja realmente excluir?')">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-secondary">{{ $user_permission->name }}</button>
                            </form>
                        </div>
                        @endforeach
                    @endif
                </div>

                <form action="{{ route('users.permissions', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="py-3">
                        <select class="form-select" aria-label="select" name="permission">
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @error('permission')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div clas="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
