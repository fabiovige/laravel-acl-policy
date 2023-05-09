@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Gerenciamento de Papéis</h2>
            @can('role-create')
                <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>

    <x-table :rows="$roles" route="roles"></x-table>

@endsection
