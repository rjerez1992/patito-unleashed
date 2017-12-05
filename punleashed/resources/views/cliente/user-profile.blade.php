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
            <li><span>Mi Cuenta</span></li>
        </ol>
        <div class="row row-title">
            <div class="col-md-2 col-sm-2 col-xs-12"><img class="img-circle center-block" src="{{ $cliente->imagen }}" width="100" height="100"></div>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <h3 class="text-left visible-sm-block visible-md-block visible-lg-block">{{ $cliente->nombre }}</h3>
                <h3 class="text-center visible-xs-block">{{ $cliente->nombre }}</h3>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <h4 class="ticket-heading-number"><i class="fa fa-info-circle fa-fw icon-ticket-list"></i><strong>Información Básica</strong></h4></div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <button class="btn btn-primary pull-right" type="button"><i class="fa fa-gear fa-fw"></i>Editar </button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row row-eq-height">
                    <div class="col-md-9 col-sm-9 col-xs-12 column-less-padding">
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-12"><strong>RUT: </strong></div>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <p>{{ $cliente->rut }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-12"><strong>Correo: </strong></div>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <p>{{ $cuenta->email }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-12"><strong>Domicilio: </strong></div>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <p>{{ $cliente->direccion }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 info-service">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="alert alert-info text-center alert-info-ticket center-block" role="alert">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-flag fa-fw"></i><strong> Reputación</strong></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>{{ $reputacionCliente }}</strong><strong> ({{ $cliente->max_tickets }} tickets máx) </strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-bank fa-fw icon-ticket-list"></i><strong>Sucursales Frecuentes</strong></h4></div>
            <div class="panel-body">
                <div class="row visible-xs-block visible-sm-block visible-md-block visible-lg-block row-eq-height">

                    @if($sucursalesFrecuentes->isEmpty())
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <p>No existen sucursales frecuentes. Intente solicitar un ticket en alguna sucursal.</p>
                                </div>
                            </div>
                    @else
                        @foreach($sucursalesFrecuentes as $sucursal)
                            <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                                <a href="/cliente/sucursal">
                                    <div class="panel panel-default">
                                        <div class="panel-body body-info-ticket">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $sucursal->imagen }}" width="60" height="60"></div>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12"><strong>{{$sucursal->nombre}}</strong></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$sucursal->direccion}}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>