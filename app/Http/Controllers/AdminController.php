<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\solicitud;
use App\service;

use DB;


/**
 *
 * Class AdminController
 * @package App\Http\Controllers
 * @author Emilio Ochoa
 */

class AdminController extends MainController
{

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if (isset($request->page) && $request->page == 1) {
            return redirect()->route('admin.index');
        }

        $solicitudes = solicitud::orderBy('id','DESC')->paginate(10);

        return view('admin.index')->with('solicitudes',$solicitudes);
    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {

        $solicitud = solicitud::find($id);
        if ($solicitud) {
            $solicitud->read = solicitud::STATUS_READ;
            $solicitud->save();
            return view('admin.edit')->with('solicitud',$solicitud);
        }

        $errors = array();
        $errors['errors'][] = solicitud::MESSAGE_REQUEST_NOT_FOUND;
        $errors['error_success'] = false;

        return redirect()->route('admin.index')->with('errors',$errors);

    }

    /**
     * Actualiza los precios para un servicio de una solicitud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePriceREST(Request $request)
    {

        if (!$this->verifySpecialString($request->price, '/^[0-9]([0-9]{0,6})$/')) {
            return new JsonResponse(array('ok' => false,'message' => 'Formato de precio no es correcto'));
        }

        $solicitud = solicitud::find($request->solicitudId);

        if ($solicitud) {

            foreach ($solicitud->services as $service) {

                if ($service->id == $request->serviceId) {
                    $service->pivot->price = $request->price;
                    $service->pivot->save();
                }
            }

            return new JsonResponse(array('ok' => true));

        }

        return new JsonResponse(array('ok' => false,'message' => 'Error al actualizar precio'));
    }

    /**
     * Actualiza el status de una solicitud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateStatusREST(Request $request)
    {
        $status = $request->status;

        if ($status === solicitud::STATUS_PENDING ||
            $status === solicitud::STATUS_PENDING_PAY ||
            $status === solicitud::STATUS_PART_OF_PAYMENT ||
            $status === solicitud::STATUS_PAYMENT) {

                $solicitud = solicitud::find($request->solicitudId);

                if ($solicitud) {

                    $solicitud->status = $status;
                    $solicitud->save();

                    return new JsonResponse(array('ok' => true));
                }

                return new JsonResponse(array('ok' => false));
        }

        return new JsonResponse(array('ok' => false));
    }

    /**
     * Obtiene los servicios actuales
     *
     * @return JsonResponse
     */
    public function getCurrentValueREST()
    {
        $services = service::select('id','name')->get();

        return new JsonResponse($services);
    }

    /**
     * ACtualiza los servicios
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateServicesREST(Request $request) {

            try {

                DB::beginTransaction();

                    if ($this->hasResults($request->editValue)) {
                        foreach($request->editValue as $id => $edit) {
                            if ($edit != null && $edit != '') {

                                $service = service::find($id);
                                $service->name = $edit;
                                $service->save();
                            }
                        }
                    }

                   if ($this->hasResults($request->delValue)) {
                       foreach($request->delValue as $id => $del) {
                           if ($del != null && $del != '') {

                               $service = service::find($id);
                               $service->status = service::STATUS_INACTIVE;
                               $service->save();
                           }
                       }
                   }

                DB::commit();

            } catch (\Exception $ex) {
                DB::rollback();
                return new JsonResponse(array('ok' => false, 'message' => service::MESSAGE_UPDATE_FAIL));
            }


        return new JsonResponse(array('ok' => true, 'message' => service::MESSAGE_UPDATE_SUCCESS));

    }

    /**
     * Agrega nuevos servicios
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addServicesREST(Request $request) {

        try {
            $service = new service();
            $service->name = $request->addValue;
            $service->status = service::STATUS_ACTIVE;
            $service->save();

            return new JsonResponse(array('ok' => true, 'id' => $service->id));

        } catch(\Exception $ex) {
            return new JsonResponse(array('ok' => false, 'message' => $ex->getMessage()));
        }
    }

    /**
     * Validar precios de una solicitud
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function validateRequest($id) {

        $request = solicitud::find($id);
        $request->status = solicitud::STATUS_PENDING_PAY;
        $request->save();

        $errors = [
            'errors' => [solicitud::MESSAGE_REQUEST_VALIDATED],
            'error_success' => true,
        ];

        return redirect()->route('admin.edit',[$id])->with('errors',$errors);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile() {

        return view('user.profile');
    }

}
