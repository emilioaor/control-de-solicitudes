<?php

namespace App\Http\Controllers;

use App\Events\PaymentApprovedEvent;
use App\Events\PaymentRegister;
use App\solicitud;
use Illuminate\Http\Request;

use App\payment;

use DB;
use Mockery\CountValidator\Exception;

class PaymentsController extends MainController
{

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store($id, Request $request) {

        $errors = $this->requestValidation($request, payment::paymentRegisterValidationInitParams());
        if ($errors['error_success']) {

            try {

                DB::beginTransaction();

                    $errors['errors'][] = payment::MESSAGE_PAYMENT_REGISTER_SUCCESS;
                    $payment = new payment($request->all());
                    $payment->request_id = $id;
                    $payment->status = solicitud::STATUS_PENDING;
                    $payment->save();

                    event(new PaymentRegister($payment->id));

                    //TODO(EO) Enviar correo para informar sobre pago registrado
                    // preferiblemente esta logica debe esta en un subscriber

                DB::commit();

            } catch (\Exception $ex) {
                DB::rollback();
                throw $ex;
            }
        }

        return redirect()->route('zone.show',[$id])->with('errors',$errors);
    }

    /**
     * Valida un pago asociado a una solicitud y cambia el estatus de la
     * solicitud acorde a la cantidad del pago aprobado
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paymentValidate(Request $request) {

        try {
            
            DB::beginTransaction();

                $payment = payment::find($request->id);
                $payment->status = payment::STATUS_APPROVED;
                $payment->save();

                $errors = [
                    'errors' => [payment::STATUS_APPROVED],
                    'error_success' => true
                ];

                event(new PaymentApprovedEvent($payment->id, $payment->request->user_id));

            DB::commit();

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }

        return redirect()->route('admin.edit',[$payment->request->id])->with('errors',$errors);
    }
}
