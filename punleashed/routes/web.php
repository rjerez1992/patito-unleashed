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
Route::post('/cliente/tickets/updateActivos', 'ClienteController@ticketsActivos');
Route::get('/cliente/tickets/cancelarTicket/{id}', 'ClienteController@cancelarTicket');

Route::get('/cliente/profile/{id?}','ClienteController@profile');

Route::get('/cliente/institucion/{id}','ClienteController@institucion');

Route::get('/cliente/sucursal/{id}','ClienteController@sucursal');
Route::get('/cliente/sucursal/{idSucursal}/getTicket/{idServicio}','ClienteController@getTicketServicio');

Route::get('/cliente/search','ClienteController@search');

/*
 * Rutas de operarios
 */
Route::get('/cliente/sucursal/{idSucursal}/getTicket/{idServicio}', 'ClienteController@getTicketServicio');
//Verificar si hay tickets
Route::post('/operario/check', 'OperarioController@ticketsActivos');

//Rutas privadas
Route::middleware("filtro:".App\Constantes::Operario())->group(function () {

Route::get('/operario/servicio', 'OperarioController@servicio');
Route::get('/operario/datos/servicio', 'OperarioController@datosServicio');
Route::get('/operario/perfil', 'OperarioController@perfil');
Route::get('/operario/perfil/editar', 'OperarioController@editar');
Route::post('/operario/perfil/editarPerfil', 'OperarioController@editarPerfil');
Route::get('/operario/atencion/siguiente', 'OperarioController@siguiente');
Route::post('/operario/atencion/cerrar', 'OperarioController@cerrarCubiculo');
Route::post('/operario/atencion/calificar/{value}', 'OperarioController@calificar');
Route::get('/operario/atencion/{id}', 'OperarioController@atencion');

//debug
Route::get('/tickets', 'OperarioController@tickets'); //No Usar
});

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

//Institucion
Route::get('/CrearInstitucion',  [
        'as' => '/CrearInstitucion', 
        'uses' => 'InstitucionController@InsertForm']);
Route::post('Insertar.Inst', [
        'as' => 'Insertar.Inst', 
        'uses' => 'InstitucionController@Insertar']);
Route::post('/Insertar','InstitucionController@Insertar');

Route::get('/manager/Sucursales', 'ManagerController@Sucursales');
Route::get('/manager/Usuarios', 'ManagerController@Usuarios');
Route::post('/admin/editar/{id}', [
        'as' => '/admin/editar/', 
        'uses' => 'ManagerController@editarCliente']);

//Sucursal
Route::post('Insertar.Sucursal', [
        'as' => 'Insertar.Sucursal', 
        'uses' => 'SucursalController@Insertar']);

Route::post('ActualizarSucursal/{id}', [
        'as' => 'Update.Sucursal', 
        'uses' => 'SucursalController@Update']);

Route::post('EliminarSucursal/{id}', [
        'as' => 'Sucursal.Eliminar', 
        'uses' => 'SucursalController@Delete'
        ]);

//Servicio
Route::post('Insertar.Servicio/{id}', [
        'as' => 'Insertar.Servicio', 
        'uses' => 'ServicioController@Insertar']);

Route::post('ActualizarServicio/{id}', [
        'as' => 'Update.Servicio', 
        'uses' => 'ServicioController@Update']);

Route::post('EliminarServicio/{id}', [
        'as' => 'Servicio.Eliminar', 
        'uses' => 'ServicioController@Delete'
        ]);
Route::post('/manager/Servicio.N', [
    'as' => '/manager/Servicio.N', 
    'uses' => 'OperarioController@Servicios'
    ]);


//Operario
Route::post('Insertar.Operario/{id}', [
        'as' => 'Insertar.Operario', 
        'uses' => 'OperarioController@Insertar']);
Route::post('Insertar.Operario2/{id}', [
        'as' => 'Insertar.Operario2', 
        'uses' => 'OperarioController@Insertar2']);
Route::post('EditarOperario/{id}', [
        'as' => 'EditarOperario', 
        'uses' => 'OperarioController@Update']);
Route::post('EliminarOperario/{id}', [
        'as' => 'EliminarOperario', 
        'uses' => 'OperarioController@Delete']);

//Cubiculo
Route::post('Insertar.Cubiculo/{id}', [
        'as' => 'Insertar.Cubiculo', 
        'uses' => 'CubiculoController@Insertar']);
Route::post('AgregarCubiculo/{id}', [
        'as' => 'AgregarCubiculo', 
        'uses' => 'OperarioController@AgregarCubiculo']);





Auth::routes();