<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get("/", function(){
	return redirect('auth/login');
});



Route::group(['middleware' => 'auth'], function () {

	
	Route::group(['middleware' => 'role'], function () {
			/*
		Administracion de registro de modulos
		 */
		Route::get('registromodulorfid', 'muduloRfidConroller@index')->name('registromodulorfid');
		Route::post('gridmodulosRFID', 'muduloRfidConroller@gridmodulosRFID')->name('gridmodulosRFID');
		Route::get('modaleditarmodulo', 'muduloRfidConroller@modaleditarmoduloRFID')->name('modaleditarmodulo');
		Route::post('modaleditarmodulo', 'muduloRfidConroller@pmodaleditarmoduloRFID');
		Route::get('registrarmodulo', 'muduloRfidConroller@registrarmoduloRFID')->name('registrarmodulo');
		Route::post('registrarmodulo', 'muduloRfidConroller@pregistrarmoduloRFID')->name('registrarmodulo');
		Route::post('eliminarmodulo', 'muduloRfidConroller@peliminarmoduloRFID')->name('eliminarmodulo');

		/*
		Administracion de registro de funcionarios
		 */

		Route::get('registrofuncionariosfid', 'funcionarioRfidController@index')->name('registrofuncionariosfid');
		Route::post('gridfuncionariosRFID', 'funcionarioRfidController@gridfuncionariosRFID')->name('gridfuncionariosRFID');
		Route::get('modaleditarfuncionario', 'funcionarioRfidController@modaleditarfuncionarioRFID')->name('modaleditarfuncionario');
		Route::post('drodtdocumento', 'funcionarioRfidController@drodtdocumentoRFID')->name('drodtdocumento');
		Route::post('modaleditarfuncionario', 'funcionarioRfidController@pmodaleditarfuncionarioRFID');
		Route::get('registrarfuncionario', 'funcionarioRfidController@registrarfuncionarioRFID')->name('registrarfuncionario');
		Route::post('registrarfuncionario', 'funcionarioRfidController@pregistrarfuncionarioRFID');
		Route::post('eliminarfuncionario', 'funcionarioRfidController@peliminarfuncionarioRFID')->name('eliminarfuncionario');

		


	});



/*
control de acceso
 */

Route::get('controlaccc','ControlaccController@index')->name('controlaccc');
Route::get('modaldetalleaccmod','ControlaccController@modaldetalleaccmod')->name('modaldetalleaccmod');
Route::post('gridcontrolaccRFID','ControlaccController@gridcontrolaccRFID')->name('gridcontrolaccRFID');
Route::post('gridDetalleaccmodRFID','ControlaccController@gridDetalleaccmodRFID')->name('gridDetalleaccmodRFID');
Route::get('configurarmodulo/{id}/configurar','ControlaccController@configuraraccmoduloRFID');
Route::post('gridnoautorizadosRFID','ControlaccController@gridnoautorizadosRFID')->name('gridnoautorizadosRFID');
Route::post('gridautorizadosRFID','ControlaccController@gridautorizadosRFID')->name('gridautorizadosRFID');
Route::post('agregarfuncionariomoduloRFID','ControlaccController@agregarfuncionariomoduloRFID')->name('agregarfuncionariomoduloRFID');
Route::post('eliminarfuncionariomoduloRFID','ControlaccController@eliminarfuncionariomoduloRFID')->name('eliminarfuncionariomoduloRFID');
Route::post('actualizartodomoduloRFID','ControlaccController@actualizartodomoduloRFID')->name('actualizartodomoduloRFID');
Route::post('confirmacionRFID','ControlaccController@confirmacionRFID')->name('confirmacionRFID');


/*
Registro de invitados
 */

Route::get('registroinvitados','registroinvitadoController@index')->name('registroinvitados');
Route::post('registroinvitados','registroinvitadoController@pregistroinvitados');
Route::post('buscarinvitado','registroinvitadoController@buscarinvitado')->name('buscarinvitado');
Route::post('drodmdulo','registroinvitadoController@drodmdulo')->name('drodmdulo');
Route::get('getdocumento','registroinvitadoController@getdocumento')->name('getdocumento');



Route::get("home", function(){
	return redirect('registromodulorfid');
});

});





Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');




/*
idiomas
*/

Route::get('espanol', 'idiomaController@espanol')->name('espanol');

Route::get('auth/register', 'Auth\AuthController@getRegister')->name('register');
Route::post('auth/register', 'Auth\AuthController@postRegister');