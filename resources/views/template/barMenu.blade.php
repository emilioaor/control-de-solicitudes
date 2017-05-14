<nav>
    <div class="container-fluid">
        <h2>@yield('h2','Inicio')</h2> |
        <a href="{{ route('index.index') }}" class="btn-primary-page-small" title="Inicio"><span class="glyphicon glyphicon-home"></span> INICIO</a>
        <a href="{{ route('index.register') }}" class="btn-primary-page-small" title="Registro"><span class="glyphicon glyphicon-pencil"></span> REGISTRO</a>
        <a href="{{ route('index.login') }}" class="btn-primary-page-small" title="Login"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a>
        <a href="{{ route('index.galery') }}" class="btn-primary-page-small" title="Galeria"><span class="glyphicon glyphicon-picture"></span> GALERIA</a>
    </div>
</nav>