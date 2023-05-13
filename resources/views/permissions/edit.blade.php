@extends('layouts.app')
@section('content')
    <x-back title="Edição de permissões" route="permissions"></x-back>

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
                        <h4>{{ __('Roles') }}</h4>

                        <form action="{{ route('permissions.roles', $permission->id) }}" method="POST">
                            @csrf
                            @method('POST')

                            <x-checkbox-access name="role" :rows="$roles" :contains="$permission->roles"></x-checkbox-access>

                            <div class="d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-success">{{ __('Save Role') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
