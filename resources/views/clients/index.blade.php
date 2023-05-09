@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gerenciamento de Clientes</h2>
            </div>
            <div class="pull-right">
                @can('client-create')
                <a class="btn btn-success" href="{{ route('clients.create') }}"> Create New Client</a>
                @endcan
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

@endsection
