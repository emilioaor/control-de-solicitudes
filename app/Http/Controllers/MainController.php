<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Auth;

/**
 * Class MainController
 * @package App\Http\Controllers
 * @author Emilio Ochoa
 */

abstract class MainController extends Controller
{

    const COMPLEMENT_MESSAGE_REQUEST_REQUIRED_ERROR = ' no puede ser vacio';
    const COMPLEMENT_MESSAGE_REQUEST_UNIQUE_ERROR = ' ya existe';
    const COMPLEMENT_MESSAGE_REQUEST_MAX_ERROR = ' tiene un maximo de caracteres de: ';
    const COMPLEMENT_MESSAGE_REQUEST_MIN_ERROR = ' tiene un minimo de caracteres de: ';
    const COMPLEMENT_MESSAGE_REQUEST_SPECIAL_STRING = ' no puede contener espacio ni caracteres especiales';

    const MESSAGE_PASSWORD_EMPTY = 'La contraseña no puede estar vacia';
    const MESSAGE_PASSWORD_REPEAT = 'Las contraseñas deben ser iguales';
    const MESSAGE_PASSWORD_MIN_LENGTH = 'La contraseña debe tener al menos 8 caracteres';
    const MESSAGE_PASSWORD_MAX_LENGTH = 'La contraseña puede tener un maximo 20 caracteres';
    const MESSAGE_PASSWORD_SPECIAL_STRING = 'La contraseña no puede contener caracteres especiales';
    const MESSAGE_PASSWORD_NO_DEFINED = 'Debe escribir ambas contraseñas';

    /**
     * Metodo para validacion de Request, recibe request y parametros de validacion
     * y retorna un array con todos los errores si los hay
     *
     * Explicacion de $params:
     *
     * required => true : Campo requerido
     * max => (integer) : Numero maximo de caracteres
     * min => (integer) : Numero minimo de caracteres
     * unique   :  El campo debe ser unico en una tabla
     *      class => (Modelo) : Modelo en el cual debe ser unico el campo
     *      field => (string) : Nombre del campo unico dentro del modelo
     * label => (string) : Etiqueta para los mensajes de error
     * pattern :
     *      pattern => (string) : Expresion regular para validar el campo default = /^[a-z]+([a-z0-9-_])*[a-z0-9-_]$/i
     *      message => (string) : Mensaje de error al coincidir la validacion
     *
     * @param $request Request
     * @param $params array
     * @return array
     */
    public function requestValidation($request, $params)
    {

        $errors = array();

        foreach ($params as $key => $param) {


            if (isset($param['required']) && $param['required']) {

                if ($request->$key == '' || $request->$key == null) {
                    $errors[] = $param['label'] . self::COMPLEMENT_MESSAGE_REQUEST_REQUIRED_ERROR;
                }
            }

            if (!is_array($request->$key)) {

                if (!$this->verifySpecialString($request->$key,(isset($param['pattern']['pattern'])) ? $param['pattern']['pattern'] : null ) && !$this->hasResults($errors)) {

                    if (isset($param['pattern']) && isset($param['pattern']['message'])) {
                        $errors[] = $param['label'] . $param['pattern']['message'];
                    } else {
                        $errors[] = $param['label'] . self::COMPLEMENT_MESSAGE_REQUEST_SPECIAL_STRING;
                    }

                }
            }

            if (isset($param['max']) && !$this->hasResults($errors)) {

                if (strlen($request->$key) > $param['max']) {
                    $errors[] = $param['label'] . self::COMPLEMENT_MESSAGE_REQUEST_MAX_ERROR . $param['max'];
                }
            }

            if (isset($param['min']) && !$this->hasResults($errors)) {

                if (strlen($request->$key) < $param['min']) {
                    $errors[] = $param['label'] . self::COMPLEMENT_MESSAGE_REQUEST_MIN_ERROR . $param['min'];
                }
            }

            if (isset($param['unique']) && isset($param['unique']['class']) && isset($param['unique']['field'])) {

                $uniqueClass = new $param['unique']['class']();
                $uniqueField = $uniqueClass::where($param['unique']['field'], $request->$key)->get();

                if ($this->hasResults($uniqueField)) {
                    $errors[] = $param['label'] . self::COMPLEMENT_MESSAGE_REQUEST_UNIQUE_ERROR;
                }
            }

        }

        $errors_result = array(
            'errors' => $errors,
            'error_success' => count($errors) === 0,
        );

        return $errors_result;

    }

    /**
     * Valida las contraseñas en el registro
     *
     * @param array $password
     * @return string
     */
    public function passwordValidation($password)
    {

        if (isset($password[0]) && isset($password[1])) {

            if ($password[0] === '' || $password[1] === '') {
                return self::MESSAGE_PASSWORD_EMPTY;
            }

            if ($password[0] !== $password[1]) {
                return self::MESSAGE_PASSWORD_REPEAT;
            } else {

                if (!$this->verifySpecialString($password[0],'/^[a-z0-9]+[a-z0-9]*$/i')) {
                    return self::MESSAGE_PASSWORD_SPECIAL_STRING;
                }

                if (strlen($password[0]) < 8) {
                    return self::MESSAGE_PASSWORD_MIN_LENGTH;
                } elseif (strlen($password[0]) > 20) {
                    return self::MESSAGE_PASSWORD_MAX_LENGTH;
                }
            }

        } else {

            return self::MESSAGE_PASSWORD_NO_DEFINED;
        }

        return '';
    }

    /**
     * @param string $string
     * @param string $pattern
     * @return int
     */
    public function verifySpecialString($string, $pattern = '/^[a-z]+([a-z0-9-_])*[a-z0-9-_]$/i')
    {
        return preg_match(!is_null($pattern) ? $pattern : '/^[a-z]+([a-z0-9-_])*[a-z0-9-_]$/i', $string);
    }

    /**
     * @param $results
     * @return bool
     */
    public function hasResults($results) {
        return (count($results) !== 0);
    }

    /**
     * @return bool
     */
    public function isAdmin() {
        return Auth::user()->level === User::LEVEL_ADMIN;
    }

    /**
     * @return bool
     */
    public function isUser() {
        return Auth::user()->level === User::LEVEL_USER;
    }

}
