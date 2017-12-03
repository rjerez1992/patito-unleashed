@extends('layouts.main')

@section('styles')
    <!-- Estilo especial para la pagina inicial -->
    <link rel="stylesheet" href="assets/css/admin-dash.css">
@endsection

@section('scripts')
@endsection

@php
	$cuenta = Auth::user();
	$admin = $cuenta->usuario;	
@endphp


@section('content')

	@include('layouts.main-nav')

	<div class="projects-horizontal">
        <div class="container">
            <div class="intro">
                <h1 class="text-center accent-color" style="margin-bottom: 10px !important; padidng: 0px !important;">Dashboard de {{$admin->nombre}}</h3>
                <p class="text-center">Desde este dashboard puedes acceder a las funcionalidades mas utilizadas de tu cuenta de administrador. Ademas puedes leer estadisticas relevantes de manera sencilla.</p>
            </div>
            <div class="row projects">     
            	<a href="#">       
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <img class="img-responsive" src="/assets/img/newppl.jpg">
                        </div>
                        <div class="col-md-7">
                            <h3 class="name accent-color">Ver instituciones </h3>
                            <p class="description">Desde esta seccion puede crear y monitorear instituciones dentro del sistema</p>
                        </div>
                    </div>
                </div></a>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/building.jpg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name accent-color">Ver usuarios </h3>
                            <p class="description">Desde esta seccion puede agregar managers y gestionar distintos tipos de usuarios del sistema</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/building.jpg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name accent-color">Agregar institucion</h3>
                            <p class="description">¿Quieres agregar una institucion rapidamente? Ingresa aquí y hazlo de manera directa</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#"><img class="img-responsive" src="assets/img/building.jpg"></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="name accent-color">Crear administrador</h3>
                            <p class="description">¿Necesitas ayuda manejando el sistema? Ingresa aqui para crear nuevos administradores</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="name accent-color">Estadisticas totales</h3></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <p class="description">Instituciones:</p>
                                            <p class="description">Sucursales:</p>
                                            <p class="description">Servicios:</p>
                                            <p class="description">Cubiculos: </p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <p class="text-center description">{{App\Institucion::count()}} </p>
                                            <p class="text-center description">{{App\Sucursal::count()}} </p>
                                            <p class="text-center description">{{App\Servicio::count()}} </p>
                                            <p class="text-center description">{{App\Cubiculo::count()}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <p class="description">Managers:</p>
                                            <p class="description">Operarios:</p>
                                            <p class="description">Clientes:</p>
                                            <p class="description">Tickets: </p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <p class="text-center description">{{App\Manager::count()}} </p>
                                            <p class="text-center description">{{App\Operario::count()}} </p>
                                            <p class="text-center description">{{App\Cliente::count()}} </p>
                                            <p class="text-center description">{{App\Ticket::count()}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="name accent-color">Estadisticas semanales</h3></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <p class="description">Instituciones:</p>
                                            <p class="description">Sucursales:</p>
                                            <p class="description">Servicios:</p>
                                            <p class="description">Cubiculos: </p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <p class="text-center description">000 </p>
                                            <p class="text-center description">000 </p>
                                            <p class="text-center description">000 </p>
                                            <p class="text-center description">000 </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <p class="description">Managers:</p>
                                            <p class="description">Operarios:</p>
                                            <p class="description">Clientes:</p>
                                            <p class="description">Tickets: </p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <p class="text-center description">000 </p>
                                            <p class="text-center description">000 </p>
                                            <p class="text-center description">000 </p>
                                            <p class="text-center description">000 </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
 

