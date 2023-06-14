@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb d-flex justify-content-between">
            <div class="pull-left">
                <h2>{{ __('Client Management') }}</h2>
            </div>
            <div class="pull-right">
                @can('clients.create')
                    <a class="btn btn-primary" href="{{ route('clients.create') }}"> {{ __('New record') }}</a>
                @endcan
            </div>
        </div>
    </div>

    <x-table :rows="$clients" route="clients"></x-table>

    {{--    <div class="row py-3">--}}
    {{--        <div class="col-md-12">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-body">--}}
    {{--                    <div class="table-responsive">--}}
    {{--                        <table class="table align-middle table-striped table-hover">--}}
    {{--                            <thead>--}}
    {{--                            <tr>--}}
    {{--                                <th scope="col" style="width: 50px">#</th>--}}
    {{--                                <th scope="col">Cnpj</th>--}}
    {{--                                <th scope="col">Razao Social</th>--}}
    {{--                                <th scope="col">E-mail</th>--}}
    {{--                                <th scope="col" style="width: 100px"></th>--}}
    {{--                            </tr>--}}
    {{--                            </thead>--}}
    {{--                            <tbody>--}}
    {{--                            @if ($clients->count() > 0)--}}
    {{--                                @foreach ($clients as $row)--}}
    {{--                                    <tr>--}}
    {{--                                        <th scope="row" style="white-space: nowrap">{{ $row->id }}</th>--}}
    {{--                                        <td>{{ $row->cnpj }}</td>--}}
    {{--                                        <td>{{ $row->corporate_name }}</td>--}}

    {{--                                        <td>{{ $row->email }}</td>--}}

    {{--                                        <td class="" style="white-space: nowrap;">--}}

    {{--                                            @if( auth()->user()->can("clients.edit") || auth()->user()->isAdmin() )--}}
    {{--                                                <a href="{{route('clients.edit', $row->id)}}"--}}
    {{--                                                   class="btn btn-primary ">{{ __('Edit') }}</a>--}}
    {{--                                            @endif--}}

    {{--                                            @if( auth()->user()->can("clients.destroy") || auth()->user()->isAdmin() )--}}
    {{--                                                <a class="btn btn-danger " href="#"--}}
    {{--                                                   onclick="event.preventDefault(); document.getElementById('remove-form-{{$row->id}}').submit();">--}}
    {{--                                                    {{ __('Remove') }}--}}
    {{--                                                </a>--}}

    {{--                                                <form id="remove-form-{{$row->id}}"--}}
    {{--                                                      action="{{route("clients.destroy", $row->id)}}" method="POST"--}}
    {{--                                                      class="d-none">--}}
    {{--                                                    @csrf--}}
    {{--                                                    @method("DELETE")--}}
    {{--                                                </form>--}}

    {{--                                            @endif--}}

    {{--                                        </td>--}}
    {{--                                    </tr>--}}
    {{--                                @endforeach--}}
    {{--                            @else--}}
    {{--                                <tr class="table-warning">--}}
    {{--                                    <td colspan="6">{{ __('Not found record') }}</td>--}}
    {{--                                </tr>--}}
    {{--                            @endif--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

@endsection
