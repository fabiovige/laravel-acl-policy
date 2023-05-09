<ul class="navbar-nav ms-auto mb-2 mb-lg-0">


    <li class="nav-item">
        <a class="nav-link @if (request()->is('users*')) active @endif" aria-current="page"
            href="{{ route('users.index') }}">Usuários</a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (request()->is('roles*')) active @endif" aria-current="page"
            href="{{ route('roles.index') }}">Papéis</a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (request()->is('permissions*')) active @endif" aria-current="page"
            href="{{ route('permissions.index') }}">Permissões</a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if (request()->is('clients*')) active @endif" aria-current="page"
            href="{{ route('clients.index') }}">Clientes</a>
    </li>


</ul>
