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
            <li><a href="/cliente/profile/{{$cliente->id}}"><span>Mi Cuenta</span></a></li>
            <li><span>Mis Tickets</span></li>
        </ol>
        <div class="row row-title">
            <div class="col-md-12 col-sm-12 col-xs-12">
                
                <h3 class="text-left visible-sm-block visible-md-block visible-lg-block"><i class="fa fa-ticket"></i> Mis Tickets</h3>
                <h3 class="text-center visible-xs-block"><i class="fa fa-ticket"></i> Mis Tickets</h3></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-inbox fa-fw icon-ticket-list"></i><strong> Bandeja de Tickets</strong></h4></div>
            <div class="panel-body">
                <div class="row visible-xs-block visible-sm-block visible-md-block visible-lg-block row-eq-height">
                    
                    @if($ticketsActivos==NULL)
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <p>No existen tickets activos. Intente solicitar un ticket en alguna sucursal.</p>
                                </div>
                            </div>
                    @else
                        @foreach($ticketsActivos as $ticket)
                            <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                                <div class="panel panel-info panel-info-ticket">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase">{{$ticket->numero}} </strong><strong>(<i class="fa fa-clock-o fa-fw"></i> </strong><strong>{{$ticket->hora}}</strong><strong class="no-padding">) - En Espera</strong></div>
                                        </div>
                                    </div>
                                    <div class="panel-body body-info-ticket">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $imageSucursal }}" width="55" height="55"></div>
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12"><strong>{{$ticket->servicio->sucursal->nombre}}</strong></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$ticket->servicio->nombre}}</span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12"><strong>N° Actual: </strong><strong>A148 </strong></div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12"><span class="text-danger">10 </span><span class="text-danger"> minutos restantes</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer body-info-ticket">
                                        <button class="btn btn-primary btn-block" type="button" onclick="modalCancelarTicket({{$ticket->id}})"><i class="fa fa-remove fa-fw"></i> Cancelar Ticket</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-book fa-fw icon-ticket-list"></i><strong> Historial de Tickets</strong></h4></div>
            <div class="panel-body">
                <div class="row visible-xs-block visible-sm-block visible-md-block visible-lg-block row-eq-height">
                    
                    @if($historialTickets==NULL)
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <p>No existen tickets antiguos. Intente solicitar un ticket en alguna sucursal.</p>
                                </div>
                            </div>
                    @else
                        @foreach ($historialTickets as $ticket)
                            <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                            @if ($ticket->estado == App\Constantes::TicketAtendido())
                                <div class="panel panel-success panel-success-ticket">
                                <div class="panel-heading"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase"> {{$ticket->numero}}</strong><strong> - Atendido</strong></div>
                                <div class="panel-body body-success-ticket">
                            @elseif ($ticket->estado == App\Constantes::TicketCancelado())
                                <div class="panel panel-warning panel-warning-ticket">
                                <div class="panel-heading"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase"> {{$ticket->numero}}</strong><strong> - Cancelado</strong></div>
                                <div class="panel-body body-warning-ticket">
                            @elseif ($ticket->estado == App\Constantes::TicketInasistente())
                                <div class="panel panel-danger panel-danger-ticket">
                                <div class="panel-heading"><i class="fa fa-ticket fa-fw"></i><strong class="text-uppercase"> {{$ticket->numero}}</strong><strong> - Inasistente</strong></div>
                                <div class="panel-body body-danger-ticket">
                            @else
                                echo '<script language="javascript">alert("OJO, etiqueta estado mal hecha D:");</script>'; 
                            @endif


                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{ $ticket->servicio->sucursal->imagen }}" width="55" height="55"></div>
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12"><strong>{{$ticket->servicio->sucursal->nombre}}</strong></div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$ticket->servicio->nombre}}</span></div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-calendar fa-fw"></i><span>{{$ticket->fecha}} </span></div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-clock-o fa-fw"></i><span>{{$ticket->hora}} </span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-cancel-ticket">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-exclamation-circle fa-fw"></i>Aviso de cancelación de Ticket (id #<span id="modalIdTicket"></span>)</h4></div>
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