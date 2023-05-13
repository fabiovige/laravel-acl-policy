<ul class="navbar-nav ms-auto mb-2 mb-lg-0">

    @can('users.index')
    <li class="nav-item">
        <a class="nav-link @if (request()->is('users*')) active @endif" aria-current="page"
            href="{{ route('users.index') }}">Usuários</a>
    </li>
    @endcan

    @can('roles.index')
    <li class="nav-item">
        <a class="nav-link @if (request()->is('roles*')) active @endif" aria-current="page"
            href="{{ route('roles.index') }}">Papéis</a>
    </li>
    @endcan

    @can('permissions.index')
    <li class="nav-item">
        <a class="nav-link @if (request()->is('permissions*')) active @endif" aria-current="page"
            href="{{ route('permissions.index') }}">Permissões</a>
    </li>
    @endcan

    @can('clients.index')
    <li class="nav-item">
        <a class="nav-link @if (request()->is('clients*')) active @endif" aria-current="page"
            href="{{ route('clients.index') }}">Clientes</a>
    </li>
    @endcan

</ul>
