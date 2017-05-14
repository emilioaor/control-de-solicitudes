@extends('template/generic')

@section('title','Generar solicitud')

@section('h2','Generar solicitud')

@section('content')
	<p><strong>Por favor. Explica tu requerimiento</strong></p>
	<form method="post" action="{{ route('zone.store') }}">
		{{ csrf_field() }}
		<div class="form-group">
			<textarea name="content" class="form-control" placeholder="Explica tu requerimiento" rows="6"></textarea>
		</div>
		<p><strong>Selecciona los servicios</strong></p>
		<div class="row">
			@foreach($services as $service)
				<div class="form-group col-md-3">
					<input type="checkbox"  id="serv{{ $service->id }}" value="{{ $service->id }}" name="services[]">
					<label for="serv{{ $service->id }}">{{ $service->name }}</label>
				</div>
			@endforeach
		</div>
		<div class="row">
			<div class="text-center">
				<button class="btn-primary-page">Enviar solicitud</button>
			</div>
		</div>
	</form>
@endsection