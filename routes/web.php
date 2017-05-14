<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'redirectToZone'], function() {
    Route::get('/',array('uses' => 'IndexController@index', 'as' => 'index.index'));
    Route::get('registro',array('uses' => 'IndexController@register','as' => 'index.register'));
    Route::get('login',array('uses' => 'IndexController@login','as' => 'index.login'));
    Route::get('galeria',array('uses' => 'IndexController@galeria','as' => 'index.galery'));
    Route::get('password-reset',array('uses' => 'IndexController@passwordReset','as' => 'index.passwordreset'));
    Route::post('password-reset',array('uses' => 'IndexController@passwordResetToEmail','as' => 'index.passwordresetemail'));
});
//RUTAS AUTH
Route::post('auth/login',array('uses' => 'AuthController@login','as' => 'auth.login'));
Route::get('auth/logout',array('uses' => 'AuthController@logout','as' => 'auth.logout'));
Route::post('auth/register-user',array('uses' => 'AuthController@register','as' => 'auth.register'));
//RUTAS USER
Route::group(['prefix' => 'zona','middleware' => 'user'],function(){
	Route::get('/',array('uses' => 'MemberZoneController@index','as' => 'zone.index'));
	Route::get('show/{id}',array('uses' => 'MemberZoneController@show','as' => 'zone.show'));
	Route::get('create',array('uses' => 'MemberZoneController@create','as' => 'zone.create'));
    Route::post('create',array('uses' => 'MemberZoneController@store','as' => 'zone.store'));
    Route::post('payment/{id}',array('uses' => 'PaymentsController@store', 'as' => 'zone.payment.store'));
    Route::get('profile',array('uses' => 'MemberZoneController@profile', 'as' => 'zone.profile'));
    Route::post('profile/updatepassword',array('uses' => 'MemberZoneController@updatePassword', 'as' => 'zone.profile.updatepassword'));
});
//RUTAS ADMIN
Route::group(['prefix' => 'admin','middleware' => 'admin'],function(){
    Route::get('/',array('uses' => 'AdminController@index','as' => 'admin.index'));
    Route::get('servicios',array('uses' => 'IndexController@services','as' => 'index.services'));
    Route::get('edit/{id}',array('uses' => 'AdminController@edit','as' => 'admin.edit'));
    Route::put('update/{id}',array('uses' => 'MemberZoneController@update','as' => 'admin.update'));
    Route::get('update/REST/price',array('uses' => 'AdminController@updatePriceREST','as' => 'admin.REST.updateprice'));
    Route::get('update/REST/status',array('uses' => 'AdminController@updateStatusREST','as' => 'admin.REST.updatestatus'));
    Route::get('get/REST/currentValue',array('uses' => 'AdminController@getCurrentValueREST','as' => 'admin.REST.getcurrentvalue'));
    Route::get('update/REST/services',array('uses' => 'AdminController@updateServicesREST','as' => 'admin.REST.updateservices'));
    Route::get('add/REST/services',array('uses' => 'AdminController@addServicesREST','as' => 'admin.REST.addservices'));
    Route::post('request/{id}/validate',array('uses' => 'AdminController@validateRequest', 'as' => 'admin.request.validate'));
    Route::post('payment/validate',array('uses' => 'PaymentsController@paymentValidate', 'as' => 'admin.payment.validate'));
    Route::get('profile',array('uses' => 'AdminController@profile', 'as' => 'admin.profile'));
});