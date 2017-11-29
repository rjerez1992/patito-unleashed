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
            <li><a><span>Mi Cuenta</span></a></li>
            <li><a><span>Mis Tickets</span></a></li>
        </ol>
        <div class="row row-title">
            <div class="col-md-2 col-sm-2 col-xs-12"><img class="img-circle center-block" src="{{ $imageSucursal }}" width="80" height="80"></div>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <h3 class="text-left visible-sm-block visible-md-block visible-lg-block">Mis Tickets</h3>
                <h3 class="text-center visible-xs-block">Mis Tickets</h3></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-inbox fa-fw icon-ticket-list"></i><strong> Bandeja de Tickets</strong></h4></div>
            <div class="panel-body">
                <div class="row visible-xs-block visible-sm-block visible-md-block visible-lg-block row-eq-height">
                    <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                        <div class="panel panel-info panel-info-ticket">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase">A150 </strong><strong>(<i class="fa fa-clock-o fa-fw"></i> </strong><strong>14:00:03 </strong><strong class="no-padding">) - En Espera</strong></div>
                                </div>
                            </div>
                            <div class="panel-body body-info-ticket">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $imageSucursal }}" width="55" height="55"></div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>BancoChile Curicó #2009</strong></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span>Créditos de Consumo</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>N° Actual: </strong><strong>A148 </strong></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span class="text-danger">10 </span><span class="text-danger"> minutos restantes</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer body-info-ticket">
                                <button class="btn btn-primary btn-block" type="button" data-target="#modal-cancel-ticket" data-toggle="modal"><i class="fa fa-remove fa-fw"></i> Cancelar Ticket</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                        <div class="panel panel-info panel-info-ticket">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase">C89 </strong><strong>(<i class="fa fa-clock-o fa-fw"></i> </strong><strong>15:27:54 </strong><strong class="no-padding">) - En Espera</strong></div>
                                </div>
                            </div>
                            <div class="panel-body body-info-ticket">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $imageSucursal }}" width="55" height="55"></div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>Santander Talca #346</strong></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span>Créditos de Consumo</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>N° Actual: </strong><strong>C44 </strong></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span>45 </span><span> minutos restantes</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer body-info-ticket">
                                <button class="btn btn-primary btn-block" type="button" data-target="#modal-cancel-ticket" data-toggle="modal"><i class="fa fa-remove fa-fw"></i> Cancelar Ticket</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-book fa-fw icon-ticket-list"></i><strong> Historial de Tickets</strong></h4></div>
            <div class="panel-body">
                <div class="row visible-xs-block visible-sm-block visible-md-block visible-lg-block row-eq-height">
                    <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                        <div class="panel panel-success panel-success-ticket">
                            <div class="panel-heading"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase"> A150</strong><strong> - Atendido</strong></div>
                            <div class="panel-body body-success-ticket">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $imageSucursal }}" width="55" height="55"></div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>Santander Talca #346</strong></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span>Créditos de Consumo</span></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-calendar fa-fw"></i><span>20/09/2015 </span></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-clock-o fa-fw"></i><span>15:30:12 </span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                        <div class="panel panel-warning panel-warning-ticket">
                            <div class="panel-heading"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase"> C52</strong><strong> - Cancelado</strong></div>
                            <div class="panel-body body-warning-ticket">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $imageSucursal }}" width="55" height="55"></div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>Santander Talca #346</strong></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span>Giros / Depósitos</span></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-calendar fa-fw"></i><span>27/02/2016 </span></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-clock-o fa-fw"></i><span>10:43:54 </span></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                        <div class="panel panel-danger panel-danger-ticket">
                            <div class="panel-heading"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase"> I39</strong><strong> -Inasistente</strong></div>
                            <div class="panel-body body-danger-ticket">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $imageSucursal }}" width="55" height="55"></div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><strong>Santander Talca #346</strong></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><span>Inversiones </span></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-calendar fa-fw"></i><span>10/05/2017 </span></div>
                                            <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-clock-o fa-fw"></i><span>18:30:05 </span></div>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-cancel-ticket">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-exclamation-circle fa-fw"></i>Aviso de cancelación de Ticket</h4></div>
                <div class="modal-body">
                    <p>¿Está seguro de cancelar el ticket solicitado? Esta acción puede llevar una penalización de por medio.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" type="button"><i class="fa fa-check fa-fw"></i>Aceptar </button>
                    <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-close fa-fw"></i>Cancelar </button>
                </div>
            </div>
        </div>
    </div>

@endsection