@extends('template/generic')

@section('title','Registro de usuario')

@section('h2','Registro')

@section('content')
	<header>
		<h4>Registro</h4>
	</header>
	<hr>

	<form method="post" action="{{ route('auth.register') }}">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-6 form-group">

				<div class="col-md-2">
					<label for="user">Usuario</label>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name="user" value="" placeholder="Usuario" required />
				</div>

			</div>

			<div class="col-md-6 form-group">

				<div class="col-md-2">
					<label for="firtsnames">Nombres</label>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name="firstnames" value="" placeholder="Nombres" required />
				</div>

			</div>
		</div>

		<div class="row">

			<div class="col-md-6 form-group">

				<div class="col-md-2">
					<label for="lastnames">Apellidos</label>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name="lastnames" value="" placeholder="Apellidos" required />
				</div>

			</div>

			<div class="col-md-6 form-group">

				<div class="col-md-2">
					<label for="email">Email</label>
				</div>
				<div class="col-md-10">
					<input type="email" class="form-control" name="email" placeholder="Email" required />
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-md-6 form-group">

				<div class="col-md-2">
					<label for="phone">Celular</label>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name="phone" placeholder="Celular" required />
				</div>

			</div>

			<div class="col-md-6 form-group">

				<div class="col-md-2">
					<label for="">Contraseña</label>
				</div>
				<div class="col-md-10">
					<input type="password" class="form-control" name="password[]" placeholder="Contraseña" required />
				</div>

			</div>
		</div>
		<div class="row">

			<div class="col-md-6 form-group">

				<div class="col-md-2">
					<label for="">Repetir contraseña</label>
				</div>
				<div class="col-md-10">
					<input type="password" class="form-control" name="password[]" placeholder="Repetir Contraseña" required />
				</div>

			</div>

			<div class="form-group col-md-6">

				<div class="col-md-2">
					<label for="country">Pais</label>
				</div>

				<div class="col-md-10">
					<select name="country" class="form-control">
						<option>Venezuela</option>
					</select>
				</div>

			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">

				<div class="col-md-2">
					<label for="state">Estado</label>
				</div>

				<div class="col-md-10">
					<select name="state" class="form-control">
						<option>Carabobo</option>
					</select>
				</div>

			</div>

			<div class="form-group col-md-6 text-center">

				<button class="btn-primary-page-small">Registrar usuario</button>

			</div>

		</div>
	</form>
@endsection

@section('js')
	<script src="{{ asset('js/jquery.mask.js') }}"></script>
@endsection