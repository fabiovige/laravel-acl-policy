@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 py-3 ">
            <h2>Edição de Papéis</h2>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $role->name ?? old('name') }}" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a class="btn btn-outline-info" href="{{ route('roles.index') }}"> Cancelar</a>
                        </div>

                    </form>
                    <hr>
                    <div class="row mt-3">
                        <h4>Permissões:</h4>

                        @if ($role->permissions)
                            @foreach ($role->permissions as $role_permission)
                            <div class="col-2">
                                <form method="POST" action="{{route('roles.permissions.revoke', [$role->id, $role_permission->id])}}" onsubmit="return confirm('Deseja realmente excluir?')">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-sm btn-secondary">{{ $role_permission->name }}</button>
                                </form>
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <form action="{{ route('roles.permissions', $role->id) }}" method="POST">
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

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Adicionar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
