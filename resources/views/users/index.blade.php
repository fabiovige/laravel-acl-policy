@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamaneto de Usuários</h2>
        </div>
    </div>
</div>

<x-table :rows="$users" route="users"></x-table>

@endsection
