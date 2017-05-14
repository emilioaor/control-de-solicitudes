<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\service;
use App\User;
use View;

class IndexController extends MainController
{
	/**
	 * @return View
	 */
	public function index()
	{
		return view('template.base');
	}

	/**
	 * @return mixed
	 */
	public function services()
	{
		$services = service::where('status',service::STATUS_ACTIVE)->get();

		return view('services')->with('services',$services);
	}

	/**
	 * @return View
	 */
	public function register()
	{
	    return view('register');
	}

	/**
	 * @return mixed
	 */
	public function login()
	{
		return view('login')->with('last','hola');
	}

	/**
	 * @return View
	 */
	public function galeria()
	{
		return view('galeria');
	}

	/**
	 * @return View
	 */
	public function passwordReset()
	{
		return view('password-reset');
	}

	/**
	 * Verifica los datos y envia la contraseña al correo especificado
	 * @param Request $request
	 * @return redirectResponse
	 */
	public function passwordResetToEmail(Request $request)
	{
		$errors = $this->requestValidation($request, User::passwordResetInitParams());

		if ($errors['error_success']) {

			$user = User::where('user', $request->user)->where('email', $request->email)->get();

			if ($this->hasResults($user)) {

				$user[0]->password_temp = csrf_token();
				$user[0]->save();

				$errors['errors'][] = User::MESSAGE_PASSWORD_RESET_SUCCESS;
				//TODO(EO) Enviar correo con password temp
			} else {
				$errors['errors'][] = User::MESSAGE_PASSWORD_RESET_FAIL;
				$errors['error_success'] = false;
			}
		}

		return redirect()->route('index.passwordreset')->with('errors',$errors);
	}

}
