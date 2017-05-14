@extends('template/generic')

@section('title','Vista de solicitud')

@section('h2','Solicitud N°:' . $solicitud->id)

@section('content')
	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th>Descripción</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ $solicitud->content }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-responsive table-striped">
		<thead>
			<tr>
				<th>Servicio</th>
				<th>Precio</th>
			</tr>
		</thead>
		<tbody>
			@foreach($solicitud->services as $service)
				<tr onclick="">
					<td>{{ $service->name }}</td>
					<td>{{ $solicitud->status !== \App\solicitud::STATUS_PENDING ? $service->pivot->price : '0' }}</td>
				</tr>
			@endforeach
		</tbody>
		<tfooter>
			<tr>
				<th>Total a pagar</th>
				<td>{{ $solicitud->status !== \App\solicitud::STATUS_PENDING ? $total : '0' }}</td>
			</tr>
		</tfooter>
	</table>
	@if(count($solicitud->payments) > 0)
		<table class="table table-striped table-responsive">
			<thead>
			<tr>
				<th colspan="5">Pagos registrados a esta solicitud</th>
			</tr>
			<tr>
				<th width="15%">Referencia</th>
				<th width="25%">Origen</th>
				<th width="25%">Destino</th>
				<th width="20%">Monto</th>
				<th width="15%">Estatus</th>
			</tr>
			</thead>
			<tbody>
			@foreach($solicitud->payments as $payment)
				<tr>
					<td>{{ $payment->references }}</td>
					<td>{{ $payment->source_bank }}</td>
					<td>{{ $payment->target_bank }}</td>
					<td>{{ $payment->mount }}</td>
					<td class="{{ $payment->status === \App\payment::STATUS_APPROVED ? 'text-success' : 'text-danger' }}">{{ $payment->status }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<p class="text-center">
			<strong>Monto pendiente:</strong> {{ $solicitud->getPendingMountPayment() }} |
			<strong>Monto aprobado:</strong> {{ $solicitud->getApprovedMountPayment() }}
		</p>
	@endif
	<hr>
	<p><strong>NOTA: </strong>En esta sección podra visualizar los precios para los distintos servicios solicitados una vez que hagamos contacto directo y determinemos el alcance de lo que requiere puede registrar el pago a traves de esta web.</p>
	@if($solicitud->status === 'Por Pagar' || $solicitud->status === 'Con parte de pago')
		<div class="text-center">
			<button type="button" class="btn-primary-page" data-toggle="modal" data-target="#myModal">Registrar pago</button>
		</div>
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Registrar pago</h4>
					</div>
					<form action="{{ route('zone.payment.store',[$solicitud->id]) }}" method="POST">
						<div class="modal-body">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="source_bank">Banco de origen</label>
								<input type="text" name="source_bank" class="form-control" placeholder="Banco de origen" required>
							</div>
							<div class="form-group">
								<label for="target_bank">Banco de destino</label>
								<input type="text" name="target_bank" class="form-control" placeholder="Banco de destino" required>
							</div>
							<div class="form-group">
								<label for="references">Número de referencia</label>
								<input type="text" name="references" class="form-control" placeholder="Número de referencia" required>
							</div>
							<div class="form-group">
								<label for="mount">Monto</label>
								<input type="text" name="mount" class="form-control" placeholder="Monto" required>
							</div>

						</div>
						<div class="modal-footer">
							<div class="text-center">
								<button class="btn-primary-page-small">Registrar</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	@endif
@endsection

@section('js')
	<script src="{{ asset('assets/js/api.js') }}"></script>
@endsection