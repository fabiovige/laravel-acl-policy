@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb d-flex justify-content-between">
        <div class="pull-left">
            <h2>{{ __('User Management') }}</h2>
        </div>
        <div class="pull-right">
            @can('users.create')
                <a class="btn btn-primary" href="{{ route('users.create') }}"> {{ __('New record') }}</a>
            @endcan
        </div>
    </div>
</div>

<x-table :rows="$users" route="users"></x-table>

@endsection
