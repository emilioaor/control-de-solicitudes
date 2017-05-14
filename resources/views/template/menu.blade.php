<nav>
    <div class="container">
        @if(!Auth::check())
            <div class="col-md-2 text-center">
                <a href="{{ route('index.index') }}">INICIO</a>
            </div>
        @else
            @if(Auth::user()->level === 'ADMIN')
                <div class="col-md-2 text-center">
                    <a href="{{ route('admin.index') }}">ZONA</a>
                </div>
            @else
                <div class="col-md-2 text-center">
                    <a href="{{ route('zone.index') }}">ZONA</a>
                </div>
            @endif
        @endif
        @if(!Auth::check())
            <div class="col-md-2 text-center">
                <a href="{{ route('index.register') }}">REGISTRO</a>
            </div>
            <div class="col-md-2 text-center">
                <a href="{{ route('index.login') }}">LOGIN</a>
            </div>
        @endif
        <div class="col-md-2 text-center">
            <a href="{{ route('index.galery') }}">GALERIA</a>
        </div>
        @if(Auth::check())
            <div class="col-md-2 text-center">
                <a href="{{ route('auth.logout') }}" onclick="return confirm('¿Deseas Salir?')">SALIR</a>
            </div>
        @endif
    </div>
</nav>