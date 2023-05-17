<ul class="navbar-nav ms-auto mb-2 mb-lg-0">

    @can('users.index')
    <li class="nav-item">
        <a class="nav-link @if (request()->is('users*')) active @endif" aria-current="page"
            href="{{ route('users.index') }}"> {{ __('Users') }} </a>
    </li>
    @endcan

    @can('roles.index')
    <li class="nav-item">
        <a class="nav-link @if (request()->is('roles*')) active @endif" aria-current="page"
            href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
    </li>
    @endcan

    @can('clients.index')
    <li class="nav-item">
        <a class="nav-link @if (request()->is('clients*')) active @endif" aria-current="page"
            href="{{ route('clients.index') }}">{{ __('Clients') }}</a>
    </li>
    @endcan

</ul>
