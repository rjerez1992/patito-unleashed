@extends('layouts.main')

@section('styles')

@endsection

@section('scripts')
@endsection

@section('content')
   
    @include('layouts.main-nav')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/"><span>Inicio </span></a></li>
            <li><a href="/cliente/institucion/{{$institucion->id}}"><span>{{ $institucion->nombre }}</span></a></li>
            <li><span>{{ $sucursal->nombre }}</span></li>
        </ol>
        <div class="row row-title">
            <div class="col-md-2 col-sm-2 col-xs-12"><img class="img-circle center-block" src="{{ $sucursal->image }}" width="100" height="100"></div>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <h3 class="text-left visible-sm-block visible-md-block visible-lg-block">{{ $sucursal->nombre }}</h3>
                <h3 class="text-center visible-xs-block">{{ $sucursal->nombre }}</h3></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-info-circle fa-fw icon-ticket-list"></i><strong>Información Básica</strong></h4></div>
            <div class="panel-body">
                <div class="row row-eq-height">
                    <div class="col-md-12 col-sm-12 col-xs-12 column-less-padding">
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-12"><strong>Dirección: </strong></div>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <p>{{ $sucursal->direccion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-12"><strong>Descripción: </strong></div>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <p>{{ $sucursal->descripcion }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-bank fa-fw icon-ticket-list"></i><strong>Servicios</strong></h4></div>
            <div class="panel-body">
                <div class="row visible-xs-block visible-sm-block visible-md-block visible-lg-block row-eq-height">
                    
                    @if(count($servicios) == 0)
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <p>No existen servicios disponibles para esta sucursal. Estamos trabajando en ello.</p>
                                </div>
                            </div>
                    @else
                        @foreach($servicios as $servicio)
                        <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                            <div class="panel panel-info panel-info-ticket">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12"><strong>{{$servicio->nombre}}</strong></div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6 info-service">
                                            <div class="alert alert-danger text-center alert-info-ticket center-block" role="alert">
                                                <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-flag fa-fw"></i><strong>Actual</strong></div>
                                                <div class="col-md-12 col-sm-12 col-xs-12"><strong>{{$servicio->letra}}{{$servicio->numero_actual}} </strong></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 info-service">
                                            <div class="alert alert-info text-center alert-info-ticket center-block" role="alert">
                                                <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-clock-o fa-fw"></i><strong>Espera</strong></div>
                                                <div class="col-md-12 col-sm-12 col-xs-12"><strong>{{$servicio->tiempo_espera}} minutos</strong></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($cuenta!=NULL && $servicio->numero_disponible!=-1)
                                    <div class="panel-footer">
                                        <button class="btn btn-primary btn-block btn-sm center-block" type="button" onclick="solicitarTicket({{$sucursal->id}},{{$servicio->id}})"><i class="fa fa-ticket fa-fw"></i>Solicitar Ticket </button>
                                    </div>
                                @elseif ($cuenta!=NULL)
                                    <div class="panel-footer">
                                        <p class="text-center" style="color: white;">El servicio no está disponible.</p>
                                    </div>
                                @else
                                    <div class="panel-footer">
                                        <p class="text-center" style="color: white;">Debes estar logueado para solicitar un ticket.</p>
                                    </div>
                                @endif
                            </div>
                        </div>                        
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-create-ticket">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-ticket fa-fw"></i>Solicitud de Ticket</h4></div>
                <div class="modal-body">
                    <p>Acabas de solicitar un ticket al sistema, estos son los datos de tu ticket: </p>
                    <div class="panel panel-info panel-info-ticket">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase">A150 </strong><strong>(<i class="fa fa-clock-o fa-fw"></i> </strong><strong>14:00:03 </strong><strong class="no-padding">) </strong></div>
                            </div>
                        </div>
                        <div class="panel-body body-info-ticket">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-3"><img class="img-circle" src="{{ $sucursal->image }}" width="55" height="55"></div>
                                <div class="col-md-10 col-sm-10 col-xs-9">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12"><strong>{{ $sucursal->nombre }}</strong></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12"><span id="modal_nombreServicio"></span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12"><strong>N° Actual: </strong><strong id="modal_numeroTicket"></strong></div>
                                        <div class="col-md-12 col-sm-12 col-xs-12"><span id="modal_tiempo"></span><span> minutos restantes</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal" onclick="actualizarPage({{$sucursal->id}})"><i class="fa fa-check fa-fw"></i>Aceptar </button>
                </div>
            </div>
        </div>
    </div>
@endsection