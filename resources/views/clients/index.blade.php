@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb d-flex justify-content-between">
        <div class="pull-left">
            <h2>{{ __('Client Management') }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clients.create') }}"> Novo registro</a>
        </div>
    </div>
</div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

@endsection
