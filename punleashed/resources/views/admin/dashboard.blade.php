@extends('layouts.main')

@section('styles')
    <!-- Estilo especial para la pagina inicial -->
    <link rel="stylesheet" href="assets/css/admin-dash.css">
@endsection

@section('scripts')
@endsection

@php
@endphp

@section('content')

	@include('layouts.main-nav')

	<div class="projects-horizontal">
        <div class="container">
            <div class="intro" style="margin-bottom: 20px;">
                <h1 class="accent-color" style="margin-bottom: 10px !important; padidng: 0px !important;">Dashboard de Administración</h3><hr/>
                <p class="">Desde este dashboard puedes acceder a las funcionalidades mas utilizadas de tu cuenta de administrador. Ademas puedes leer estadisticas relevantes de manera sencilla.</p>
            </div>
            <div class="row projects">              
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="thumb" style="background-image: url('/assets/img/instituciones.jpg')"></div>
                        </div>
                        <div class="col-md-7">
                            <a href="#"><h3 class="name accent-color">Ver instituciones </h3></a>
                            <p class="description">Desde esta seccion puede crear y monitorear instituciones dentro del sistema</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="thumb" style="background-image: url('/assets/img/usuarios.jpg')"></div>
                        </div>
                        <div class="col-md-7">
                            <a href="/admin/lista/clientes"><h3 class="name accent-color">Ver usuarios </h3></a>
                            <p class="description">Desde esta seccion puede agregar managers y gestionar distintos tipos de usuarios del sistema</p>
                        </div>
                    </div>
                </div>                       
                <div class="col-sm-6 item">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="thumb" style="background-image: url('/assets/img/n-institucion.jpg')"></div>
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
                            <div class="thumb" style="background-image: url('/assets/img/admin.png')"></div>
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
                                            <p class="text-center description">{{$total_instituciones}} </p>
                                            <p class="text-center description">{{$total_sucursales}} </p>
                                            <p class="text-center description">{{$total_servicios}} </p>
                                            <p class="text-center description">{{$total_cubiculos}} </p>
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
                                            <p class="text-center description">{{$total_managers}} </p>
                                            <p class="text-center description">{{$total_operarios}} </p>
                                            <p class="text-center description">{{$total_clientes}} </p>
                                            <p class="text-center description">{{$total_tickets}} </p>
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
                                            <p class="text-center description">{{$semana_instituciones}} </p>
                                            <p class="text-center description">{{$semana_sucursales}} </p>
                                            <p class="text-center description">{{$semana_servicios}} </p>
                                            <p class="text-center description">{{$semana_cubiculos}} </p>
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
                                            <p class="text-center description">{{$semana_managers}} </p>
                                            <p class="text-center description">{{$semana_operarios}} </p>
                                            <p class="text-center description">{{$semana_clientes}} </p>
                                            <p class="text-center description">{{$semana_tickets}} </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- TODO: Graficos -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
 

