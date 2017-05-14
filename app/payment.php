<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    const MESSAGE_PAYMENT_REGISTER_SUCCESS = 'Pago registrado';

    const STATUS_PENDING = 'Pendiente';
    const STATUS_APPROVED = 'Aprobado';
    const STATUS_REFUSE = 'Rechazado';

    protected $table = 'payments';

    protected $fillable = [
        'source_bank','target_bank','mount','request_id','references'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request() {
        return $this->belongsTo('App\solicitud','request_id');
    }

    /**
     * Inicializar parametros de validacion para registro de pagos
     */
    public static function paymentRegisterValidationInitParams() {

        $params = array(
            'source_bank' => array(
                'required' => true,
                'max' => 30,
                'label' => 'Banco de origen',
                'pattern' => array(
                    'pattern' => '/^[0-9a-z]+[0-9a-z\s]*$/i',
                    'message' => ' no puede contener caracteres especiales'
                ),
            ),
            'target_bank' => array(
                'required' => 'true',
                'max' => 30,
                'label' => 'Banco de destino',
                'pattern' => array(
                    'pattern' => '/^[0-9a-z]+[0-9a-z\s]*$/i',
                    'message' => ' no puede contener caracteres especiales'
                ),
            ),
            'references' => array(
                'required' => true,
                'unique' => array(
                    'class' => 'App\payment',
                    'field' => 'references',
                ),
                'pattern' => array(
                    'pattern' => '/^[0-9]+$/',
                    'message' => ' solo puede contener números'
                ),
                'label' => 'Codigo de referencia'
            ),
            'mount' => array(
                'required' => true,
                'pattern' => array(
                    'pattern' => '/^[0-9]+$/',
                    'message' => ' solo puede contener números'
                ),
                'label' => 'Monto',
            ),
        );

        return $params;
    }
}
