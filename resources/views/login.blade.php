@extends('template.generic')

@section('title','Login')

@section('h2','Login')

@section('content')
	<header>
		<h4>Login</h4>
	</header>
	<hr>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form action="{{ route('auth.login') }}" method="post">
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
						<label for="password">Contraseña</label>
					</div>
					<div class="col-md-10">
						<input type="password" name="password" class="form-control" placeholder="Contraseña">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<p class="text-center"><a href="{{ route('index.register') }}">¿No tienes cuenta? Registrate aqui</a></p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<p class="text-center"><a href="{{ route('index.passwordreset') }}">Olvide mi contraseña</a></p>
					</div>
				</div>

				<div class="row">
					<div class="text-center col-md-12"><button class="btn-primary-page-small">Login</button></div>
				</div>
			</form>
		</div>
	</div>
@endsection