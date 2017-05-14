@extends('template/generic')

@section('title','Zona de miembros')

@section('h2','Zona de miembros')

@section('content')
	<table class="table table-responsive table-default">
		<thead>
			<th>#</th>
			<th>Descripción</th>
			<th>Fecha</th>
			<th>Estatus</th>
			<th>¿Leida?</th>
		</thead>
		<tbody>
			@foreach($solicitudes as $solicitud)
                <tr>
                    <td><a href="{{ route('zone.show',array('id' => $solicitud->id)) }}">{{ $solicitud->id }}</a></td>
                    <td>{{ str_limit($solicitud->content,50) }}</td>
                    <td>{{ date_format($solicitud->created_at,'d-m-Y') }}</td>
                    <td class="{{ $solicitud->status == 'Pago Completo' ? 'text-success' : 'text-danger'  }}">{{ $solicitud->status }}</td>
					<td>{{ $solicitud->read ? 'SI' : 'NO' }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
    <div class="text-center">{{ $solicitudes->render() }}</div>
@endsection