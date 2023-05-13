@extends('layouts.app')
@section('content')
    <x-back title="Edição de papéis" route="roles"></x-back>

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

                        <form action="{{ route('roles.permissions', $role->id) }}" method="POST">
                            @csrf
                            @method('POST')

                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $permission->name }}"
                                        name="permission[]" @if ($role->permissions->contains($permission)) checked @endif>
                                    <label class="form-check-label" for="permission">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-success">{{ __('Save Permission') }}</button>
                            </div>

                        </form>
                        
                    </div>



                </div>
            </div>
        </div>

    </div>
@endsection
