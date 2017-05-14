<?php
/**
 * Created by PhpStorm.
 * User: emilioaor
 * Date: 27/02/17
 * Time: 10:21 PM
 */

namespace App\Listeners;


use App\payment;
use App\solicitud;

class VerifyRequestPayments
{
    /**
     * Verifica el total pagado de la solicitud y cambia el estatus
     * @param $event
     */
    public function handle($event) {

        $payment = payment::find($event->source);
        $request = solicitud::find($payment->request_id);

        $paymentAmount = 0;

        foreach ($request->payments as $pay) {
            if ($pay->status === payment::STATUS_APPROVED) {
                $paymentAmount += $pay->mount;
            }
        }

        if ($paymentAmount >= $request->getTotal()) {
            $request->status = solicitud::STATUS_PAYMENT;
        } else {
            $request->status = solicitud::STATUS_PART_OF_PAYMENT;
        }

        $request->save();
    }
}