@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Permissões</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('permissions.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>

<x-table :rows="$permissions" route="permissions" ></x-table>

@endsection
