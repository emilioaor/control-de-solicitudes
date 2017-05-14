<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
	const STATUS_ACTIVE = 'Activo';
	const STATUS_INACTIVE = 'Inactivo';

	const MESSAGE_UPDATE_SUCCESS = 'Servicios actualizados correctamente';
	const MESSAGE_UPDATE_FAIL = 'Error al actualizar los servicios';
    
	protected $table = 'services';

	protected $fillable = ['name','status'];

	public function solicitudes()
	{
		return $this->belongsToMany('App\solicitud','solicitudes_services')->withPivot('solicitud_id','price');
	}

}
