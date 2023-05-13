@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb d-flex justify-content-between">
        <div class="pull-left">
            <h2>{{ __('Permission Management') }}</h2>
        </div>
        <div class="pull-right">
            @can('permissions.create')
                <a class="btn btn-primary" href="{{ route('permissions.create') }}"> {{ __('New record') }}</a>
            @endcan
        </div>
    </div>
</div>

<x-table :rows="$permissions" route="permissions" ></x-table>

@endsection
