@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Clients</h2>
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
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Criado por</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->user_id ?? '' }}</td>
            <td>
                <form action="{{ route('clients.destroy',$client->id) }}" method="POST">

                    @can('client-show')
                        <a class="btn btn-info" href="{{ route('clients.show',$client->id) }}">Show</a>
                    @endcan

                    @can('client-edit')
                        @role('Admin')
                            <a class="btn btn-primary" href="{{ route('clients.edit', $client->id) }}">Edit</a>
                        @else
                            @if( auth()->id() == $client->user_id )
                                <a class="btn btn-primary" href="{{ route('clients.edit', $client->id) }}">Edit</a>
                            @endif
                        @endrole
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('client-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
