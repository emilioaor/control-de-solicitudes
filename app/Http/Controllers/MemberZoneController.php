<?php

namespace App\Http\Controllers;

use App\Events\PasswordUpdate;
use App\User;
use Illuminate\Http\Request;

use DB;
use Auth;

use App\solicitud;
use App\service;

use App\Events\RequestCreate;

class MemberZoneController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->page) && $request->page == 1) {
            return redirect()->route('admin.index');
        }

        $solicitudes = solicitud::where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(10);

        return view('user.index')->with('solicitudes',$solicitudes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = service::where('status',service::STATUS_ACTIVE)->get();

        return view('user/create')->with('services',$services);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     * @throws \Exception
     */
    public function store(Request $request)
    {

        $errors = $this->requestValidation($request,solicitud::requestCreateInitParams());
        if ($errors['error_success']) {

            try {

                DB::beginTransaction();

                    $solicitud = new solicitud($request->all());
                    $solicitud->status = solicitud::STATUS_PENDING;
                    $solicitud->user_id = Auth::user()->id;
                    $solicitud->read = solicitud::STATUS_UNREAD;
                    $solicitud->save();

                    $solicitud->services()->sync($request->services);

                    $errors['errors'][] = solicitud::MESSAGE_CREATE_SUCCESS;

                    event(new RequestCreate($solicitud->id));

                    //TODO(EO) Enviar correo para informar sobre nueva solicitud

                DB::commit();

            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
        }

        return redirect()->route('zone.index')->with('errors',$errors);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = solicitud::find($id);

        if ($solicitud && $solicitud->user_id == Auth::user()->id) {

            return view('user.show')
                ->with([
                    'solicitud' => $solicitud,
                    'total' => $solicitud->getTotal()
                ]);
        }

        $errors = array();
        $errors['errors'][] = solicitud::MESSAGE_REQUEST_NOT_FOUND;
        $errors['error_success'] = false;

        return redirect()->route('zone.index')->with('errors',$errors);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile() {

        return view('user.profile');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request) {

        $passwordValidation = $this->passwordValidation($request->password);

        $errors = array(
            'error_success' => $passwordValidation === '',
            'errors' => $passwordValidation === '' ? array(User::MESSAGE_EMAIL_CODE_VALIDATION) : array($passwordValidation),
        );

        if ($errors['error_success']) {
            DB::beginTransaction();

            if (event(new PasswordUpdate())) {
                DB::commit();
            } else {
                DB::rollback();
            }
        }

        return redirect()->route('zone.profile')->with('errors',$errors);
    }

}
