<div class="row py-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50px">#</th>
                                <th scope="col">Nome</th>

                                @if($route == 'users')
                                    <th scope="col">{{ __('Blocked') }}</th>
                                    <th scope="col">{{ __('Roles') }}</th>
                                    <th scope="col">{{ __('Permissions') }}</th>
                                @endif

                                @if($route == 'roles')
                                    <th scope="col">{{ __('Permissions') }}</th>
                                @endif

                                @if($route == 'permissions')
                                    <th scope="col">{{ __('Roles') }}</th>
                                @endif

                                <th scope="col" style="width: 100px"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($rows->count() > 0)
                                @foreach ($rows as $row)
                                    <tr>
                                        <th scope="row" style="white-space: nowrap">{{ $row->id }}</th>
                                        <td>{{ $row->name }}</td>

                                        @if($route == 'users')
                                            <td>{{ $row->is_blocked }}</td>
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
                                            </td>
                                            <td>
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
                                        @endif

                                        @if($route == 'roles')
                                            <td>
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
                                        @endif

                                        @if($route == 'permissions')
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
                                            </td>
                                        @endif

                                        <td class="" style="white-space: nowrap;">

                                            @if($route=='users')
                                                @if( auth()->user()->can("$route.roles.edit") && auth()->id() !== $row->id ||  auth()->user()->isAdmin() )
                                                    <a href="{{route($route.'.show', $row->id)}}" class="btn btn-dark ">{{ __('Access') }}</a>
                                                @endif
                                            @endif

                                            @if( auth()->user()->can("$route.edit") || auth()->user()->isAdmin() )
                                                <a href="{{route($route.'.edit', $row->id)}}" class="btn btn-primary ">{{ __('Edit') }}</a>
                                            @endif

                                            @if( auth()->user()->can("$route.destroy") && auth()->id() !== $row->id || auth()->user()->isAdmin() )
                                                <a class="btn btn-danger " href="#" onclick="event.preventDefault(); document.getElementById('remove-form-{{$row->id}}').submit();">
                                                {{ __('Remove') }}
                                                </a>

                                                <form id="remove-form-{{$row->id}}" action="{{route($route.'.destroy', $row->id)}}" method="POST" class="d-none">
                                                    @csrf
                                                    @method("DELETE")
                                                </form>

                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table-warning">
                                    <td colspan="6">{{ __('Not found record') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
