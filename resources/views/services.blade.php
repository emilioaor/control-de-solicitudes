@extends('template/generic')

@section('title','Lista de servicios')

@section('h2','Servicios')

@section('content')
	<table class="table table-responsive table-striped">
		<thead>
			<tr>
				<th colspan="2">Servicio</th>
			</tr>
		</thead>
		<tbody id="spaceAll">
			@foreach($services as $service)
				<tr id="spaceService{{ $service->id }}">
					<td width="100%">
						<div id="spaceService{{ $service->id }}">
							<div id="view{{ $service->id }}">{{ $service->name }}</div>
							<div id="edit{{ $service->id }}" style="display: none;">
								<input id="inputService{{ $service->id }}" type="text" class="form-control" value="{{ $service->name }}">
							</div>
						</div>
					</td>
					<td>
						<button id="buttonEdit{{ $service->id }}" class="btn-primary-page-small" onclick="startEdition({{ $service->id }})" title="Editar"><span class="glyphicon glyphicon-edit"></span></button>
						<button id="buttonSave{{ $service->id }}" style="display: none" class="btn-primary-page-small" onclick="saveChanges({{ $service->id }})" title="Conservar cambios"><span class="glyphicon glyphicon-floppy-disk"></span></button>
					</td>
					<td>
						<button id="buttonDelete{{ $service->id }}" class="btn-primary-page-small" onclick="deleteService({{ $service->id }})" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></button>
						<button id="buttonReturn{{ $service->id }}" style="display: none" class="btn-primary-page-small" onclick="returnEdition({{ $service->id }})" title="Anular"><span class="glyphicon glyphicon-remove"></span></button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<table class="hidden">
		<tbody id="model">
			<tr id="spaceService">
				<td width="100%">
					<div id="spaceService">
						<div id="view"></div>
						<div id="edit" style="display: none;">
							<input id="inputService" type="text" class="form-control" value="">
						</div>
					</div>
				</td>
				<td>
					<button id="buttonEdit" class="btn-primary-page-small" onclick="startEdition()" title="Editar"><span class="glyphicon glyphicon-edit"></span></button>
					<button id="buttonSave" style="display: none" class="btn-primary-page-small" onclick="saveChanges()" title="Conservar cambios"><span class="glyphicon glyphicon-floppy-disk"></span></button>
				</td>
				<td>
					<button id="buttonDelete" class="btn-primary-page-small" onclick="deleteService()" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></button>
					<button id="buttonReturn" style="display: none" class="btn-primary-page-small" onclick="returnEdition()" title="Anular"><span class="glyphicon glyphicon-remove"></span></button>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<div class="row">
		<div class="col-xs-8 col-xs-offset-1">
			<input id="newService" type="text" class="form-control">
		</div>
		<div class="col-xs-2 text-center">
			<button class="btn-primary-page-small" onclick="addService()" title="Agregar"><span class="glyphicon glyphicon-plus-sign"></span></button>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12 text-center">
			<p id="labelPend" class="text-center">Cambios pendientes: 0</p>
			<button class="btn-primary-page-small" onclick="updateServices()" title="Guardar">Guardar</button>
			<button class="btn-primary-page-small" onclick="initAll()" title="Anular Todo">Anular</button>
			<span id="alertSuccess" class="alert-success glyphicon glyphicon-ok icon-service"></span>
			<span id="alertFail" class="glyphicon glyphicon-alert icon-service"></span>
		</div>
	</div>
@endsection

@section('js')
	<script src="{{ asset('assets/js/service.js') }}"></script>
@endsection