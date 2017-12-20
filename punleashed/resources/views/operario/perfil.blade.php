@extends('layouts.main')

@section('styles')
@endsection

@section('scripts')
@endsection

@php
@endphp

@section('content')

    @include('layouts.main-nav')

    <!-- TODO: Mover la imagen hacia arriba y colocar al lado el heading con la informacion. (En columnas separadas) -->  
    <div class="container">
        <h1 style="color: #1485ee;">Perfil
        <!-- boton editar -->
        <a href="/operario/perfil/editar" class="btn btn-info pull-right" type="button"><i class="fa fa-edit"></i><span class="hidden-xs"> Modificar datos</span></a>
        <!-- boton  perfil publico -->
        <!--<a href="#" class="btn btn-link pull-right" type="button" style="margin-right: 15px;"><i class="fa fa-eye"></i><span class="hidden-xs"> Ver pefil publico</span></a>-->

        </h1>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <h4 style="color: #1485ee;"> <i class="fa fa-user"></i> {{$usuario->nombre}}</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <div class="row">
            <div class="col-md-3">
            <div class="thumb" style="background-image: url('/assets/img/{{$usuario->imagen}}'); height: 170px;"></div>
            </div>
            <div class="col-md-9">
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <form style="margin: 0px !important; padding: 0px !important;">
                                <div class="column" style="margin: 0px !important; padding: 0px !important;">
                                <!-- Campo:  Usuario -->                                                    
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Usuario:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$cuenta->username}}</span></div>
                                </div>

                                <!-- Campo:  correo -->                                                    
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Correo:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$cuenta->email}}</span></div>
                                </div>

                                <!-- Campo:  tipo -->                                                    
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Tipo:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{App\Constantes::Textual($cuenta->tipo)}}</span></div>
                                </div>

                                <!-- Campo:  creacion -->                                                    
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Creacion:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$cuenta->created_at}}</span></div>
                                </div>
                                
                                <hr>

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

                                
                                
                            </div>
                            <span class="pull-right hidden-xs" style="color: gray; margin-top: 15px; margin-bottom: 30px;">Ultima modificación: {{$usuario->updated_at->format('j/m/Y')}} a las {{$usuario->updated_at->format('H:i:s')}}</span>     
                            <span class="visible-xs" style="color: gray; margin-top: 30px; margin-bottom: 30px;">Ultima modificación: {{$usuario->updated_at->format('j/m/Y')}} a las {{$usuario->updated_at->format('H:i:s')}}</span>                       
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- perfil publico  --><!--
        <h4 style="color: #1485ee;"> <i class="fa fa-user"></i> {{$usuario->nombre}}  (Perfil publico)</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <div class="row">
            <div class="col-md-3">
            <div class="thumb" style="background-image: url('/assets/img/{{$usuario->imagen}}'); height: 170px;"></div>
            </div>
            <div class="col-md-9">
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <form style="margin: 0px !important; padding: 0px !important;">
                                <div class="column" style="margin: 0px !important; padding: 0px !important;">
                                                                                   
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Institucion:</strong> </span></div>
                                    <a href="#"><div class="col-md-10 col-sm-10 col-xs-8"><span>{{$usuario->servicio->sucursal->institucion->nombre}}</span></div></a>
                                </div>

                                                                               
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Sucursal:</strong> </span></div>
                                    <a href=""><div class="col-md-10 col-sm-10 col-xs-8"><span>{{$usuario->servicio->sucursal->nombre}}</span></div></a>
                                </div>

                              
                                
                                <hr>

                                                                                 
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Nombre:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$usuario->nombre}}</span></div>
                                </div>

                                                                               
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Tipo:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{App\Constantes::Textual($cuenta->tipo)}}</span></div>
                                </div>


                                                                            
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Miembro desde:</strong> </span></div>
                                    <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$cuenta->created_at}}</span></div>
                                </div>


                                
                                
                            </div>                                              
                        </form>
                    </div>
                </div>
            </div>
        </div>-->

        <!--
        <h4 style="margin-top: 15px; color: #1485ee;" ><i class="fa fa-hand-o-up"></i> Seleccione un cubiculo disponible</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <div class="row">

            @if(empty($servicio->cubiculos))
            <h4 class="text-center">No hay cubiculos asignados para este servicio.</h4>
            @endif
          
            @foreach($servicio->cubiculos->sortBy('disponibilidad') as $cubiculo)

           
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">       
                @if($cubiculo->operario==NULL)<a href="#">@endif<div class="panel panel-default @if($cubiculo->operario!=NULL) panel-off @endif">
                   
                    <div class="panel-body">

                    <span style="font-weight: bold; font-size: 16px;">@if($cubiculo->operario==NULL)<i class="fa fa-unlock">@else<i class="fa fa-lock">@endif</i> {{str_limit($cubiculo->nombre, $limit = 25, $end = '...')}}</span>
                   
                   @if($cubiculo->operario==NULL) 
                    <div class="thumb" style="background-image: url('/assets/img/cubiculo_vacio.png'); height: 80px; margin-top: 10px;"></div>
                    @else
                    <div class="thumb" style="background-image: url('/assets/img/cubiculo_ocupado.png'); height: 80px;background-color: hsla(0,0%,100%,0.30); background-blend-mode: overlay;margin-top: 10px;"></div>
                    @endif

                    <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><span><strong>Estado: </strong> </span></div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><span>@if($cubiculo->operario==NULL) Desocupado @else Ocupado @endif</span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><span><strong>Atiende: </strong></span></div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><span>@if($cubiculo->operario==NULL) - @else {{$cubiculo->operario->nombre}} @endif</span></div>
                        </div>                    
                    </div>

                    <div class="panel-footer"></div>
                </div>@if($cubiculo->operario==NULL)</a>@endif
            </div> 
            @endforeach
        </div>-->
    </div>
  
@endsection


  

 

