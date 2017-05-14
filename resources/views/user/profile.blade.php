@extends('template/generic')

@section('title','Perfil')

@section('h2','Perfil')

@section('content')
	<table class="table table-responsive table-striped">
		<thead>
			<tr>
				<th width="50%">Usuario</th>
				<th width="50%">Nombres</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ Auth::user()->user }}</td>
				<td>{{ Auth::user()->firstnames }}</td>
			</tr>
		</tbody>
		<thead>
			<tr>
				<th>Apellidos</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ Auth::user()->lastnames }}</td>
				<td>{{ Auth::user()->email }}</td>
			</tr>
		</tbody>
		<thead>
			<tr>
				<th>Celular</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ Auth::user()->phone }}</td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<form action="{{ route('zone.profile.updatepassword') }}" method="post">
		{{ csrf_field() }}
		<table class="table table-responsive table-striped">
			<thead>
			<tr>
				<th colspan="5">Cambio de contraseña</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td width="25%">Contraseña</td>
				<td width="25%"><input type="password" name="password[]" class="form-control" placeholder="Contraseña" required></td>
				<td width="25%">Repetir contraseña</td>
				<td width="25%"><input type="password" name="password[]" class="form-control" placeholder="Repetir contraseña" required></td>
				<td>
					<button class="btn-primary-page-small" title="Actualizar"><span class="glyphicon glyphicon-refresh"></span></button>
				</td>
			</tr>
			</tbody>
		</table>
	</form>
@endsection

@section('js')
	<script src="{{ asset('js/jquery.mask.js') }}"></script>
@endsection