@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb d-flex justify-content-between">
        <div class="pull-left">
            <h2>{{ __('Role Management') }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.create') }}"> {{ __('New record') }}</a>
        </div>
    </div>
</div>

    <x-table :rows="$roles" route="roles"></x-table>

@endsection
