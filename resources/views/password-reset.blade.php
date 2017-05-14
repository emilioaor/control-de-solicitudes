@extends('template.generic')

@section('title','Recuperar contraseña')

@section('h2','Recuperar contraseña')

@section('content')
    <header>
        <h4>Recuperar contraseña</h4>
    </header>
    <hr>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="{{ route('index.passwordresetemail') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="user">Usuario</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="user" class="form-control" placeholder="Usuario">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="password">Email</label>
                    </div>
                    <div class="col-md-10">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="text-center"><button class="btn-primary-page-small">Recuperar contraseña</button></div>
            </form>
        </div>
    </div>
@endsection