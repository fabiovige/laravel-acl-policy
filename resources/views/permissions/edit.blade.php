@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 py-3 ">
            <h2>Edição de Permissões</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $permission->name ?? old('name') }}" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a class="btn btn-outline-info" href="{{ route('permissions.index') }}"> Cancelar</a>
                        </div>
                    </form>

                    <hr>
                    <div class="row mt-3">
                        <h4>Papéis:</h4>

                        @if ($permission->roles)
                            @foreach ($permission->roles as $permission_role)
                                <div class="col-2">
                                    <form method="POST"
                                        action="{{ route('permissions.roles.remove', [$permission->id, $permission_role->id]) }}"
                                        onsubmit="return confirm('Deseja realmente excluir?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-secondary">{{ $permission_role->name }}</button>
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <form action="{{ route('permissions.roles', $permission->id) }}" method="POST">
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
@endsection
