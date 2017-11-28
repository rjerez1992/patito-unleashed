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

Route::get('/', function () {
    return view('frontpage/frontpage');
});

Route::get('/cliente/tickets', 'ClienteController@tickets');

Route::get('/cliente/profile','ClienteController@profile');

Route::get('/cliente/institucion','ClienteController@institucion');

Route::get('/cliente/sucursal','ClienteController@sucursal');

Route::get('/operario/servicio', 'OperarioController@servicio');

Route::get('/manager/dashboard', 'ManagerController@dashboard');

Route::get('/admin/dashboard', 'AdminController@dashboard');

/*
 * Rutas de login/registro re-nombradas y con redireccion
 */
Route::get('/ingresar', 'Auth\LoginController@ingresar');

Route::get('/registro', 'Auth\RegisterController@registro');

Auth::routes();