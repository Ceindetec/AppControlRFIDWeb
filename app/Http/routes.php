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


Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');



/*
idiomas
*/

Route::get('espanol', 'idiomaController@espanol')->name('espanol');