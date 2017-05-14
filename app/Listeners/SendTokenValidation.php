<?php

namespace App\Listeners;

use App\Events\PasswordUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;
use DB;

use App\User;

class SendTokenValidation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PasswordUpdate  $event
     * @return void
     */
    public function handle(PasswordUpdate $event)
    {

        try {

            $token = csrf_token();

            $user = User::find(Auth::user()->id);
            $user->temp = $token;
            $user->save();
            //TODO(EO) Enviar correo
            \Monolog\Handler\mail($user->email, 'VALIDACION',$token);

            return true;
        } catch (\Exception $ex) {
            return false;
        }

    }
}
