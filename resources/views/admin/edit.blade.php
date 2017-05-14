@extends('template/generic')

@section('title','Editar solicitud')

@section('h2','Solicitud N°:' . $solicitud->id)

@section('content')
	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Telefono</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ $solicitud->user->firstnames . ' ' . $solicitud->user->lastnames }}</td>
				<td>{{ $solicitud->user->phone }}</td>
			</tr>
		</tbody>
		<thead>
			<tr>
				<th colspan="2">Descripción</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2">{{ $solicitud->content }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th width="70%">Servicio</th>
				@if($solicitud->status === \App\solicitud::STATUS_PENDING)
					<th></th>
				@endif
				<th width="30%">Precio</th>
				@if($solicitud->status === \App\solicitud::STATUS_PENDING)
					<th></th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($solicitud->services as $service)
				<tr>
					<td>{{ $service->name }}</td>
					@if($solicitud->status === \App\solicitud::STATUS_PENDING)
						<td>
							<span id="alertSuccess{{ $service->id }}" class="alert-success glyphicon glyphicon-ok icon-service"></span>
							<span id="alertFail{{ $service->id }}" class="glyphicon glyphicon-alert icon-service"></span>
						</td>
					@endif
					<td>
						@if($solicitud->status === \App\solicitud::STATUS_PENDING)
						<input type="text" class="inputPrice form-control price"  id="price{{ $service->id }}" value="{{ $service->pivot->price ? $service->pivot->price : '0' }}" autocomplete="off">
						@else
							{{ $service->pivot->price ? $service->pivot->price : '0' }}
						@endif
					</td>
					@if($solicitud->status === \App\solicitud::STATUS_PENDING)
						<td>
							<button class="btn-primary-page-small" id="button{{ $service->id }}" onclick="setPrice('{{ $service->id }}','{{ $solicitud->id }}')" title="Establecer precio"><span class="glyphicon glyphicon-floppy-disk"></span></button>
						</td>
					@endif
				</tr>
			@endforeach
		</tbody>
		@if($solicitud->status === \App\solicitud::STATUS_PENDING)
			<tfooter>
				<tr>
					<td></td>
					<td></td>
					<td class="text-center">
						<button type="button" class="btn-primary-page-small" data-toggle="modal" data-target="#modalPrice"><span class="glyphicon glyphicon-ok-sign"></span> Aprobar</button>
					</td>
					<td></td>
				</tr>
			</tfooter>
		@else
			<tfooter>
				<tr>
					<th>Total a pagar</th>
					<td>{{ $solicitud->getTotal() }}</td>
				</tr>
			</tfooter>
		@endif
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
				<th></th>
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
					<td>
						@if($payment->status === \App\payment::STATUS_PENDING)
							<button type="button" class="btn-primary-page-small" onclick="$('#paymentId').val('{{ $payment->id }}')" data-toggle="modal" data-target="#myModal" title="Aprobar pago"><span class="glyphicon glyphicon-hand-right"></span></button>
						@endif
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<p class="text-center">
			<strong>Monto pendiente:</strong> {{ $solicitud->getPendingMountPayment() }} |
			<strong>Monto aprobado:</strong> {{ $solicitud->getApprovedMountPayment() }}
		</p>

		<!-- Modal Payment -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Atención <span class="glyphicon glyphicon-exclamation-sign"></span></h4>
					</div>
					<div class="modal-body">
						<p>Una vez aprobado el pago <strong>no se podrá reevertir</strong>, asegurese de validar que ha recibido el monto en el banco correspondiente. ¿Seguro quiere aprobar este pago?</p>
					</div>
					<div class="modal-footer">
						<form action="{{ route('admin.payment.validate') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" id="paymentId" name="id">
							<button class="btn-primary-page-small"><span class="glyphicon glyphicon-ok-sign"></span> Aprobar</button>
						</form>
					</div>
				</div>

			</div>
		</div>
	@endif

	<!-- Modal Price -->
	<div id="modalPrice" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Atención <span class="glyphicon glyphicon-exclamation-sign"></span></h4>
				</div>
				<div class="modal-body">
					<p>Una vez aprobado los precios <strong>no podrá modificarlos</strong>. El validar los precios le permite al usuario registrar pagos a esta solicitud. Asegurese de que sean correctos antes de aprobar. ¿Seguro quiere aprobar los precios establecidos?</p>
				</div>
				<div class="modal-footer">
					<form action="{{ route('admin.request.validate',[$solicitud->id]) }}" method="post">
						{{ csrf_field() }}
						<button class="btn-primary-page-small"><span class="glyphicon glyphicon-ok-sign"></span> Aprobar</button>
					</form>
				</div>
			</div>

		</div>
	</div>
@endsection

@section('js')
	<script src="{{ asset('assets/js/priceService.js') }}"></script>
	<script src="{{ asset('js/jquery.mask.js') }}"></script>
	<script type="text/javascript">
        $(document).ready(function(){
            $('.price').mask('000000000',{reverse : true});
        });
	</script>
@endsection