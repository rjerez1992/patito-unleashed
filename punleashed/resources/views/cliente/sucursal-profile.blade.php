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
                            @if($servicio->numero_disponible!=-1)
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6 info-service">
                                            <div class="alert alert-danger text-center alert-info-ticket center-block" role="alert">
                                                <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-flag fa-fw"></i><strong> Atendiendo</strong></div>
                                                <div class="col-md-12 col-sm-12 col-xs-12"><h4><strong style="font-size: 16px,">{{$servicio->letra}}{{$servicio->numero_actual}}</strong></h4></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 info-service">
                                            <div class="alert alert-warning text-center alert-info-ticket center-block" role="alert">
                                                <div class="col-md-12 col-sm-12 col-xs-12"><strong><i class="fa fa-flag fa-fw"></i> Disponible</strong></div>
                                                <div class="col-md-12 col-sm-12 col-xs-12"><h4><strong>{{$servicio->letra}}{{$servicio->numero_disponible}}</strong></h4></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 info-service">
                                            <div class="alert alert-info text-center alert-info-ticket center-block" role="alert">
                                                <div class="col-md-6 col-sm-6 col-xs-6"><i class="fa fa-clock-o fa-fw"></i><strong> Espera</strong></div>
                                                <div class="col-md-6 col-sm-6 col-xs-6"><strong>{{$servicio->tiempo_espera}} minutos</strong></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($cuenta!=NULL)
                                    @if($servicio->ticketCliente($cuenta->usuario->id)!=NULL)
                                        <div class="panel-footer">
                                            <p class="text-center" style="color: white;"><strong>Ya posees un ticket para este servicio.</strong></p>
                                        </div>
                                    @elseif($cuenta->usuario->ticketsActivos->count()>=$cuenta->usuario->max_tickets)
                                        <div class="panel-footer">
                                            <p class="text-center" style="color: white;"><strong>Ya has pedido un máximo de tickets.</strong></p>
                                        </div>
                                    @else
                                        <div class="panel-footer">
                                            <button class="btn btn-primary btn-block btn-sm center-block botonObtenerTicket" type="button" data-id="{{$servicio->id}}" onclick=getTicketAjax(this)><i class="fa fa-ticket fa-fw"></i>Solicitar Ticket </button>
                                            
                                            <script type="text/javascript">
                                                function getTicketAjax(but) {
                                                    $.ajaxSetup({
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                        }
                                                    });
                                                    $.ajax({
                                                      url: 'getTicket',
                                                      type: 'POST',
                                                      data: {'idSucursal': {{$sucursal->id}},
                                                            'idServicio': $(but).data("id")},
                                                      success:function(data) {
                                                        $("#modal-create-ticket").html(data);
                                                        $('.modal-create-ticket').click(function(e) {
                                                            e.preventDefault();
                                                            $('body').css('overflow', 'hidden');
                                                        });
                                                        $('#modal-create-ticket').modal({backdrop: 'static', keyboard: false})
                                                        $('#modal-create-ticket').modal('show')
                                                      }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    @endif
                                @else
                                    <div class="panel-footer">
                                        <p class="text-center" style="color: white;"><strong>Debes estar logueado para solicitar un ticket.</strong></p>
                                    </div>
                                @endif
                            @else
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 col-xs-3 info-service">
                                            <div class="alert alert-info text-center alert-info-ticket center-block" role="alert">
                                                <div class="col-md-12 col-sm-12 col-xs-12"><i class="fa fa-info-circle fa-fw"></i></div>
                                                <div class="col-md-12 col-sm-12 col-xs-12"><strong>Info</strong></div>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-9 info-service">
                                            <div class="alert alert-info text-center alert-info-ticket center-block" role="alert">
                                                <div class="col-md-12 col-sm-12 col-xs-12">{{$servicio->descripcion}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <p class="text-center" style="color: white;"><strong>El servicio no está disponible.</strong></p>
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

    </div>
    
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection