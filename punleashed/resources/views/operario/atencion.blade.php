@extends('layouts.main')

@section('styles')
@endsection

@section('scripts')
@endsection

@php
@endphp

@section('content')

    @include('layouts.main-nav')

    <!-- mensajes --> 
    @if (Session::has('msg'))  
    <!-- Modal de notificaciones por defecto -->    
    <div class="modal fade in" id="defaultModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">@if(Session::get('status-ok'))<i class="fa fa-info-circle"></i>@else<i class="fa fa-remove"></i>@endif Notificación </h4></div>
                <div class="modal-body">
                    <p>{{ Session::get('msg') }}</p>
                </div>
                <div class="modal-footer" styles="padding: 0px !important; margin; 0px; bottom: 0px;">
                    <button class="btn @if(Session::get('status-ok')) btn-info @else btn-danger @endif btn-sm" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Entendido</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#defaultModal').modal('show');
        });
    </script>
    @endif


    @if($usuario==NULL)
    <!-- Modal para eliminar elementos -->
    <div class="modal fade in" id="modalConfirmacion" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-remove"></i> Confirmación </h4></div>
                <div class="modal-body">
                    <p><strong>¿Esta seguro que desea cerrar el  cubiculo  actual?</strong><br><br> Si este es el ultimo cubiculo del servicio el servicio será cerrado. Todos los tickets pendientes para este servicio serán cancelados.</p>
                </div>
                <div class="modal-footer" styles="padding: 0px !important; margin; 0px; bottom: 0px;">
                    <form class="form-horizontal" method="POST" action="/operario/atencion/cerrar">
                        {{ csrf_field() }}
                        <!--<input class="form-control" value="-1}" type="hidden" name="hiddenId" id="hiddenId">-->
                        <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-check"></i> Cerrar </button>
                        <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">        
        function CerrarCubiculo(){        
            //Pasar id valor al input hidden del modal
            //$("#hiddenId").val(id);
            //Abrir modal
            $('#modalConfirmacion').modal('show'); 
        }
    </script>
    @endif

    <!-- Modal para calificar -->
    <div class="modal fade in" id="modalCalificar" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-remove"></i> Calificación </h4></div>
                <div class="modal-body">
                    <p><strong>¿Asistió el cliente a la atención?</strong><br><br> Necesitamos saber si <strong>@if($usuario!=NULL){{$usuario->nombre}}@endif</strong> llegó o no a la atención de su ticket. Esto nos ayuda a poder controlar los clientes que utilizan inadecuadamente el sistema.</p>
                </div>
                <div class="modal-footer" styles="padding: 0px !important; margin; 0px; bottom: 0px;">
                    <!-- Form asistió -->
                    <form class="form-inline" method="POST" action="/operario/atencion/calificar/1">
                        {{ csrf_field() }}
                        <!-- Datos del form -->
                        <input class="form-control" value="@if($usuario!=NULL){{$usuario->id}}@endif" type="hidden" name="hiddenId" id="hiddenId">
                        <input class="form-control" value="{{$cubiculo->id}}" type="hidden" name="cubiculoId" id="cubiculoId"><!--- /datos -->
                        <button class="btn btn-block btn-info btn-sm" type="submit"><i class="fa fa-check"></i> El cliente asistió debidamente</button>
                    </form>

                    <!-- Form NOOOOOOOO asistió -->
                    <form class="form-inline" method="POST" action="/operario/atencion/calificar/0" style="margin-top: 5px; margin-bottom: 5px;">
                        {{ csrf_field() }}
                        <!-- Datos del form -->
                        <input class="form-control" value="@if($usuario!=NULL){{$usuario->id}}@endif" type="hidden" name="hiddenId" id="hiddenId">
                        <input class="form-control" value="{{$cubiculo->id}}" type="hidden" name="cubiculoId" id="cubiculoId"><!--- /datos -->
                       
                        <button class="btn btn-block btn-warning btn-sm" type="submit"><i class="fa fa-check"></i> El cliente no asistió </button>                        
                    </form>

                    <button class="btn btn-danger btn-block btn-sm" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> No terminar atención aun</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">        
        function Calificar(){        
            //Pasar id valor al input hidden del modal
            //$("#hiddenId").val(id);
            //Abrir modal
            $('#modalCalificar').modal('show'); 
        }
    </script>



    <!-- TODO: Mover la imagen hacia arriba y colocar al lado el heading con la informacion. (En columnas separadas) -->  
    <div class="container">
        <h1>Atendiendo <span class="hidden-xs">cubiculo</span>

        
        <div class="pull-right">
        @if($usuario==NULL)
        <div class="btn-group" role="group">
        <button onclick="CerrarCubiculo()" class="btn btn-danger pull-right" type="button"><i class="fa fa-close"></i> <span class="hidden-xs">Cerrar el cubiculo</span></button>
        </div>
        @endif

        <!-- Si no hay usuario, mostramos el boton para llamar al siguiente -->
        <!-- Actualizar la disponibilidad del boton con ajax cada 3 segundos -->
        @if($usuario == NULL)
        <div class="btn-group" role="group">
        <a href="/operario/atencion/siguiente" class="btn btn-info pull-right" type="button"><i class="fa fa-chevron-right"></i> <span class="hidden-xs">Llamar siguiente cliente</span></a>
        </div></div>

        <!-- Script para activar o desactivar el boton segun hay o no hay  usando AJAX -->
        <script type="text/javascript">
            
        </script>

        @endif

        <!-- Si hay usuario mostramos el boton terminar atencion -->
        @if($usuario != NULL)
        <div class="btn-group" role="group">
        <button onclick="Calificar()" class="btn btn-warning pull-right" type="button"><i class="fa fa-check"></i> <span class="hidden-xs">Terminar atención</span></button>
        </div></div>@endif

        </h1>

        <hr style="margin: 0px; margin-bottom: 15px;">
        <h4> <i class="fa fa-suitcase"></i> Datos de atención</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">

        <!-- datos de atencion-->
        <div class="row">
            <div class="col-md-4">
                <h3 class="text-center" style="margin-bottom: 0px;">Numero actual</h3>
                <div class="row">                   
                    <div class="col-md-12">
                    @if($operario->cubiculo->numero_atencion > 0)
                        <h1 class="text-center" style="margin-bottom: 20px;"><strong>136</strong></h1>
                    @else
                    <h3 class="text-center" style="margin-bottom: 20px;"><strong>En espera</strong></h3>
                    @endif
                     </div>
                </div>
            </div>

            <!-- Columna de datos de  la atencion -->
                <div class="col-md-8">

                <!-- servicio -->
                
                <div class="row" style="margin-top: 13px;">
                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Servicio:</strong> </span></div>
                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$operario->servicio->nombre}}</span></div>
                </div>

                <!-- cubiculo -->
                
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Cubiculo:</strong> </span></div>
                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$operario->cubiculo->nombre}}</span></div>
                </div>

                <!-- sgte -->
               
                <!-- Luego lo implemento 
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Siguiente:</strong> </span></div>
                    <div class="col-md-10 col-sm-10 col-xs-8"><span>REVISAR ESTA WEA!</span></div>
                </div> -->

                <hr style="margin-top: 10px; margin-bottom: 10px;">

                <!-- ejecutivo -->
                
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Ejecutivo:</strong> </span></div>
                    <!-- TODO: CAMBIAR POR CLIENTE -->
                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$operario->nombre}}</span></div>
                </div>
                
            </div>
        </div>

        <h4 style="margin-top: 30px;"> <i class="fa fa-user"></i> Datos del cliente</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">

        <!-- Datos cliente -->
        
        <div class="row">
        @if($usuario != NULL)
            <div class="col-md-2">
            <!-- hidden  xs -->

            <div class="thumb hidden-xs" style="background-image: url('/assets/img/{{$usuario->imagen}}'); height: 90px;"></div>
          
            <!-- visible xs image -->
         
            <div class="thumb visible-xs" style="background-image: url('/assets/img/{{$usuario->imagen}}'); height: 180px;"></div>
           
              </div>
            <div class="col-md-10">
                <div class="row" style="margin-top: 10px; margin-bottom: 30px;">
                    <div class="col-md-12">
                        <form style="margin: 0px !important; padding: 0px !important;">
                                <div class="column" style="margin: 0px !important; padding: 0px !important;">

                                <!-- Campo:  Nombre -->                                                    
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Nombre:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$usuario->nombre}}</span></div>
                                </div>

                                <!-- Campo:  RUT -->                                                    
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>RUT:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$usuario->rut}}</span></div>
                                </div>
                               

                                <!-- Campo:  correo -->                                                    
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Correo:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$cuentaUsuario->email}}</span></div>
                                </div>

                              

                                <!-- Campo:  creacion -->                                                    
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Creacion:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$cuentaUsuario->created_at}}</span></div>
                                </div>

                                
                                
                            </div>
                                               
                        </form>
                    </div>
                </div>
            </div>
        @else
        <div class="text-center"><h4>No hay ningun usuario en atención</h4></div>
        
        @endif
        </div>

<!--
        <h4> <i class="fa fa-gears" style="margin-top: 15px;"></i> Operaciones</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <div class="row">
            <div class="col-md-12"><button class="btn btn-info btn-block" type="button"><i class="fa fa-bullhorn"></i> Llamar siguiente cliente</button></div>
        </div>
        <div class="row">
            <div class="col-md-12"><button class="btn btn-link btn-block" type="button" style="margin-top: 5px; margin-bottom: 40px;"><i class="fa fa-pencil"></i> Calificar cliente actual</button></div>
        </div>
    </div>-->

@endsection