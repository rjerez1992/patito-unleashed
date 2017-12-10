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

Route::get('/cliente/profile/{id?}','ClienteController@profile');

Route::get('/cliente/institucion/{id}','ClienteController@institucion');

Route::get('/cliente/sucursal/{id}','ClienteController@sucursal');

Route::get('/cliente/search','ClienteController@search');

Route::get('/operario/servicio', 'OperarioController@servicio');

Route::get('/manager/dashboard', 'ManagerController@dashboard');

/*
 * Rutas de administracion
 */
Route::middleware("filtro:".App\Constantes::Admin())->group(function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');

    /* CRUD Instituciones */
    Route::get('/admin/instituciones/agregar', 'AdminController@agregarInstitucion');
    Route::post('/admin/instituciones/agregar/crear', 'AdminController@crearInstitucion');

    Route::get('/admin/instituciones/lista', 'AdminController@instituciones');

    Route::get('/admin/instituciones/editar/{id}', 'AdminController@preEdicionInstitucion');
    Route::post('/admin/instituciones/editar/editar', 'AdminController@editarInstitucion');

    Route::post('/admin/instituciones/eliminar', 'AdminController@eliminarInstitucion');

    /* CRUD USUARIOS*/
    Route::get('/admin/agregar/{tipoUsuario}', 'AdminController@agregar');
    Route::post('/admin/agregar/{tipoUsuario}/crear', 'AdminController@crear');

    Route::get('/admin/lista/{tipoUsuario}', 'AdminController@usuarios');    

    Route::get('/admin/editar/{tipoUsuario}/{id}', 'AdminController@preEdicion');
    Route::post('/admin/editar/{tipoUsuario}/editar', 'AdminController@editar');

    Route::post('/admin/eliminar/{tipoUsuario}', 'AdminController@eliminar');
});

/*
 * Rutas de login/registro re-nombradas y con redireccion
 */
Route::get('/ingresar', 'Auth\LoginController@ingresar');

Route::get('/registro', 'Auth\RegisterController@registro');

Auth::routes();