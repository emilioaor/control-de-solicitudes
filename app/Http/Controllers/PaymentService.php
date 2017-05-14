<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\payment;

use Auth;

class PaymentService extends MainController
{


    public function getPayments() {

        if ($this->isAdmin()) {
            $payments = payment::orderBy('id','DESC')->limit(5)->get();
        } elseif ($this->isUser()) {
            $payments = payment::select('payments.id','mount','payments.status','references')->join('solicitudes','request_id','solicitudes.id')->where('user_id',Auth::user()->id)->orderBy('payments.id','DESC')->limit(5)->get();
        }

        if (!$this->hasResults($payments)) {
            return 'No hay pagos registrados';
        }

        return $payments;
    }
}
