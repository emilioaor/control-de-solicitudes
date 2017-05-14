<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class solicitud extends Model
{
	const STATUS_PENDING = 'Pendiente';
	const STATUS_PENDING_PAY = 'Por Pagar';
	const STATUS_PART_OF_PAYMENT = 'Con parte de pago';
	const STATUS_PAYMENT = 'Pago Completo';
	const STATUS_UNREAD = 0;
	const STATUS_READ = 1;

	const MESSAGE_CREATE_SUCCESS = 'Solicitud generada';
	const MESSAGE_CREATE_FAIL = 'Error al generar la solicitud';

	const MESSAGE_UPDATE_SUCCESS = 'Solicitud Actualizada';
	const MESSAGE_UPDATE_FAIL = 'Error al actualizar solicitud';
	const MESSAGE_REQUEST_NOT_FOUND = 'Esta solicitud no existe';

	const MESSAGE_REQUEST_VALIDATED = 'Solicitud validada';
    
	protected $table = 'solicitudes';

	protected $fillable = ['content','status','user_id'];


    /**
     * Inicializa los parametro de validacion para la creacion de nuevas solicitudes
     * @return array
     */
    public static function requestCreateInitParams() {

        $params = array(
            'content' => array(
                'required' => true,
                'label' => 'Contenido de la solicitud',
				'pattern' => array(
					'pattern' => '/^([\w\s])+([\w\s])*$/i',
					'message' => ' no puede contener caracteres especiales',
				),
            ),
            'services' => array(
                'required' => true,
                'label' => 'Servicios'
            ),
        );

        return $params;

    }

	/**
	 * Obtiene el total a pagar por la solicitud
	 * @return int
	 */
	public function getTotal() {

		$total = 0;

		foreach($this->services as $service) {
			if ($service->pivot->price != null) {
				$total+= $service->pivot->price;
			}
		}

		return $total;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User','user_id');
	}

	/**
	 * @return $this
	 */
	public function services()
	{
		return $this->belongsToMany('App\service','solicitudes_services')
						->withPivot('service_id','price');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function payments() {
		return $this->hasMany('App\payment','request_id');
	}

	/**
	 * @return int
	 */
	public function getPendingMountPayment() {

		$mountPending = 0;

		foreach ($this->payments as $payment) {
			if ($payment->status == payment::STATUS_PENDING) {
				$mountPending += $payment->mount;
			}
		}

		return $mountPending;
	}

	/**
	 * @return int
	 */
	public function getApprovedMountPayment() {

		$approvedMount = 0;

		foreach ($this->payments as $payment) {
			if ($payment->status == payment::STATUS_APPROVED) {
				$approvedMount += $payment->mount;
			}
		}

		return $approvedMount;
	}

}
