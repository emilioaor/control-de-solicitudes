<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const MESSAGE_LOGIN_FAIL = 'Error al iniciar sesión';
    const MESSAGE_USER_CREATE_SUCCESS = 'Usuario creado correctamente';
    const MESSAGE_PASSWORD_RESET_SUCCESS = 'Su contraseña fue enviada a su correo';
    const MESSAGE_PASSWORD_RESET_FAIL = 'Los datos de recuperacion son incorrectos';
    const MESSAGE_EMAIL_CODE_VALIDATION = 'Hemos enviado un correo de verificación';

    const LEVEL_USER = 'USER';
    const LEVEL_ADMIN = 'ADMIN';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user','password','email','firstnames', 'lastnames','phone','country','state','level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','password_temp'
    ];

    /**
     * Inicializa los parametros para la validacion del login
     *
     * Dentro de params va un array por cada campo a validar. El key del array debe
     * coincidir con el del request
     *
     * @return array
     */
    public static function InitParamsFormValidationLogin(){

        $params = array(
            'user' => array(
                'required' => true,
                'max' => 20,
                'min' => 8,
                'label' => 'Usuario',
            ),
            'password' => array(
                'required' => true,
                'max' => 100,
                'min' => 8,
                'label' => 'Contraseña',
                'pattern' => array(
                    'pattern' => '/^[a-z0-9]+[a-z0-9]*$/i',
                    'message' => ' no puede contener caracteres especiales',
                ),
            ),
        );

        return $params;
    }

    /**
     * Inicializa los parametros para la validacion del registro
     *
     * Dentro de params va un array por cada campo a validar. El key del array debe
     * coincidir con el del request
     *
     * @return array
     */
    public static function InitParamsFormValidationRegister(){

        $params = array(
            'user' => array(
                'required' => true,
                'max' => 20,
                'min' => 8,
                'label' => 'Usuario',
                'unique' => array(
                    'class' => 'App\User',
                    'field' => 'user',
                ),
            ),
            'firstnames' => array(
                'required' => true,
                'max' => 40,
                'min' => 4,
                'label' => 'Nombres',
                'pattern' => array(
                    'pattern' => '/^([a-z]+)([a-z]+)\s?([a-z]*)([a-z]*)$/i',
                    'message' => ' no cumple con el formato correcto',
                ),
            ),
            'lastnames' => array(
                'required' => true,
                'max' => 40,
                'min' => 4,
                'label' => 'Apellidos',
                'pattern' => array(
                    'pattern' => '/^([a-z]+)([a-z]+)\s?([a-z]*)([a-z]*)$/i',
                    'message' => ' no cumple con el formato correcto',
                ),
            ),
            'email' => array(
                'required' => true,
                'max' => 100,
                'label' => 'Email',
                'unique' => array(
                    'class' => 'App\User',
                    'field' => 'email',
                ),
                'pattern' => array(
                    'pattern' => '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*.(\.[a-z]{2,4})$/i',
                    'message' => ' no cumple con el formato correcto',
                ),
            ),
            'phone' => array(
                'required' => true,
                'max' => 11,
                'min' => 11,
                'label' => 'Celular',
                'pattern' => array(
                    'pattern' => '/^[0][4][1|2][2|4|6]([0-9]{7})$/',
                    'message' => ' no cumple con el formato correcto',
                ),
            ),
            'country' => array(
                'required' => true,
                'max' => 100,
                'min' => 4,
                'label' => 'Pais',
            ),
            'state' => array(
                'required' => true,
                'max' => 100,
                'min' => 4,
                'label' => 'Estado',
            ),
        );

        return $params;
    }

    /**
     * Inicializa los parametros para validacion de formulario de
     * recuperacion de contraseña
     *
     * Dentro de params va un array por cada campo a validar. El key del array debe
     * coincidir con el del request
     *
     * @return array
     */
    public static function passwordResetInitParams() {

        $params = array(
            'user' => array(
                'required' => true,
                'max' => 20,
                'label' => 'Usuario',
            ),
            'email' => array(
                'required' => true,
                'max' => 255,
                'label' => 'Email',
                'pattern' => array(
                    'pattern' => '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*.(\.[a-z]{2,4})$/i',
                    'message' => ' no cumple con el formato correcto',
                ),
            ),
        );

        return $params;
    }


    public function solicitudes()
    {
        return $this->hasMany('App\solicitud','user_id');
    }

}
