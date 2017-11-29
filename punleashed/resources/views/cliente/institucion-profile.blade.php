@extends('layouts.main')

@section('styles')

@endsection

@section('scripts')
@endsection

@section('content')
   
    @include('layouts.main-nav')

    <div class="container">
        <ol class="breadcrumb">
            <li><a><span>Inicio </span></a></li>
            <li><a><span>Instituciones </span></a></li>
            <li><a><span>{{ $nameInstitucion }}</span></a></li>
        </ol>
        <div class="row row-title">
            <div class="col-md-2 col-sm-2 col-xs-12"><img class="img-circle center-block" src="{{ $imageInstitucion }}" width="100" height="100"></div>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <h3 class="text-left visible-sm-block visible-md-block visible-lg-block">{{ $nameInstitucion }}</h3>
                <h3 class="text-center visible-xs-block">{{ $nameInstitucion }}</h3></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-info-circle fa-fw icon-ticket-list"></i><strong>Información Básica</strong></h4></div>
            <div class="panel-body">
                <div class="row row-eq-height">
                    <div class="col-md-12 col-sm-12 col-xs-12 column-less-padding">
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-12"><strong>RUN: </strong></div>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <p>{{ $runInstitucion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-12"><strong>Descripción: </strong></div>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <p>{{ $descInstitucion }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-bank fa-fw icon-ticket-list"></i><strong>Sucursales</strong></h4></div>
            <div class="panel-body">
                <div class="row visible-xs-block visible-sm-block visible-md-block visible-lg-block row-eq-height">
                    <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                        <div class="panel panel-default">
                            <div class="panel-body body-info-ticket">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $imageInstitucion }}" width="60" height="60"></div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>Santander Talca #346</strong></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span>1 Sur #346 Talca, Región del Maule</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                        <div class="panel panel-default">
                            <div class="panel-body body-info-ticket">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $imageInstitucion }}" width="60" height="60"></div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>Santander Merced #219</strong></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span>Av Merced #219 Chillán Región del Biobio</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                        <div class="panel panel-default">
                            <div class="panel-body body-info-ticket">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $imageInstitucion }}" width="60" height="60"></div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>Santander Express Terminal</strong></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span>Terminal Buses Molina, Región del Maule</span></div>
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