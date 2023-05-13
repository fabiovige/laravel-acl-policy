<div class="row py-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px">#</th>
                            <th scope="col">Nome</th>
                                <th scope="col">
                                    @if($route == 'roles')
                                        {{ __('Permissions') }}
                                    @else
                                        {{ __('Roles') }}
                                    @endif
                                </th>
                                <th scope="col" style="width: 100px">Ações</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if ($rows->count() > 0)
                            @foreach ($rows as $row)
                                <tr>
                                    <th scope="row" style="white-space: nowrap">{{ $row->id }}</th>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        @if($row->roles)
                                            <ul>
                                                @foreach ( $row->roles as $role )
                                                    <li>
                                                        {{ $role->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        @if($row->permissions)
                                            <ul>
                                                @foreach ( $row->permissions as $permission )
                                                    <li>
                                                        {{ $permission->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>


                                    <td class="" style="white-space: nowrap;">

                                        @if($route=='users')
                                            @can("$route.show")
                                                <a href="{{route($route.'.show', $row->id)}}" class="btn btn-dark ">{{ __('Roles') }}</a>
                                            @endcan
                                        @endif

                                        @can("$route.edit")
                                            <a href="{{route($route.'.edit', $row->id)}}" class="btn btn-primary ">{{ __('Edit') }}</a>
                                        @endcan

                                        @can("$route.destroy")


                                        <a class="btn btn-danger " href="#"
                                        onclick="event.preventDefault();
                                                      document.getElementById('remove-form').submit();">
                                         {{ __('Remove') }}
                                        </a>

                                        <form id="remove-form" action="{{route($route.'.destroy', $row->id)}}" method="POST" class="d-none">
                                            @csrf
                                            @method("DELETE")
                                        </form>

                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="table-warning">
                                <td colspan="3">Nenhum registro encontrado!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
