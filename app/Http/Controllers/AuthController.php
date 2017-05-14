<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Auth;
use League\Flysystem\Exception;

class AuthController extends MainController
{
    const MESSAGE_AUTHENTICATION_FAIL = 'Error al iniciar sesión. Intente nuevamente';
    
	public function login(Request $request)
	{

        $errors = $this->requestValidation($request,User::InitParamsFormValidationLogin());
        if (!$errors['error_success']) {
            return redirect()->route('index.login')->with('errors',$errors);
        }

        if (Auth::attempt(array('user' => trim($request->user), 'password' => trim($request->password))) ||
            Auth::attempt(array('user' => trim($request->user), 'password_temp' => trim($request->password)))) {

            $user = User::find(Auth::user()->id);
            $user->password_temp = null;
            $user->save();

            if (Auth::user()->level === User::LEVEL_USER) {
                return redirect()->route('zone.index');
            }elseif (Auth::user()->level === User::LEVEL_ADMIN) {
                return redirect()->route('admin.index');
            }
        }

        $errors['errors'][] = self::MESSAGE_AUTHENTICATION_FAIL;
        $errors['error_success'] = false;

        return redirect()->route('index.login')->with('errors',$errors);
	}

	public function logout()
	{
		Auth::Logout();

		return redirect()->route('index.login');
	}

	public function register(Request $request)
    {

        $errors = $this->requestValidation($request, User::InitParamsFormValidationRegister());

        $passwordError = $this->passwordValidation($request->password);
        if ($passwordError != '') {
            $errors['errors'][] = $passwordError;
            $errors['error_success'] = false;
        }

        if (!$errors['error_success']) {
            return redirect()->route('index.register')->with('errors',$errors);
        }

        try {
            $user = new User($request->all());
            $user->password = bcrypt($request->password[0]);
            $user->level = User::LEVEL_USER;
            $user->save();
        } catch (Exception $ex) {
            throw $ex;
        }

        $errors['errors'][] = User::MESSAGE_USER_CREATE_SUCCESS;

        return redirect()->route('index.login')->with('errors',$errors);
    }

}
