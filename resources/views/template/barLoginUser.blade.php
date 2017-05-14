<nav>
    <div class="container-fluid">
        <h2>@yield('h2')</h2> |
        @if(Auth::user()->level === App\User::LEVEL_ADMIN)
            <a href="{{ route('admin.index') }}" title="Lista de solicitudes" class="btn-primary-page-small "><span class="glyphicon glyphicon-list-alt"></span> LISTA DE SOLICITUDES</a>
            <a href="{{ route('index.services') }}" title="Servicios" class="btn-primary-page-small "><span class="glyphicon glyphicon-wrench"></span> SERVICIOS</a>
        @else
            <a href="{{ route('zone.index') }}" title="Lista de solicitudes" class="btn-primary-page-small "><span class="glyphicon glyphicon-list-alt"></span> LISTA DE SOLICITUDES</a>
            <a href="{{ route('zone.create') }}" title="Generar solicitud" class="btn-primary-page-small "><span class="glyphicon glyphicon-plus-sign"></span>AGREGAR</a>
        @endif
        <a href="{{ Auth::user()->level === App\User::LEVEL_ADMIN ? route('admin.profile') : route('zone.profile') }}" title="Perfil" class="btn-primary-page-small "><span class="glyphicon glyphicon-user"></span>PERFIL</a>
        <a href="{{ route('auth.logout') }}" title="Cerrar sesión" class="btn-primary-page-small " onclick="return confirm('¿Cerrar sesión?')"><span class="glyphicon glyphicon-off"></span>LOGOUT</a>
    </div>
</nav>