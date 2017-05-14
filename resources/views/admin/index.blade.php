@extends('template/generic')

@section('title','Panel de administrador')

@section('h2','Administrador')

@section('content')
	<table class="table table-responsive table-default">
		<thead>
			<th>#</th>
			<th>Descripción</th>
			<th>Fecha</th>
			<th>Estatus</th>
			<th>Usuario</th>
		</thead>
		<tbody>
			@foreach($solicitudes as $solicitud)
                <tr style="{{ !$solicitud->read ? 'background-color: #e5e5e5' : ''}}">
                    <td><a href="{{ route('admin.edit',array('id' => $solicitud->id)) }}">{{ $solicitud->id }}</a></td>
                    <td>{{ str_limit($solicitud->content,50) }}</td>
                    <td>{{ date_format($solicitud->created_at,'d-m-Y') }}</td>
                    <td class="{{ $solicitud->status == 'Pago Completo' ? 'text-success' : 'text-danger'  }}">{{ $solicitud->status }}</td>
					<td>{{ $solicitud->user->user }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
    <div class="text-center">{{ $solicitudes->render() }}</div>
@endsection