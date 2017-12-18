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
        <h1 style="color: #1485ee;">Atención de cubiculo        
        </h1>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <!--<h4 style="color: #1485ee;"> <i class="fa fa-info-circle"></i> Datos de atención del servicio</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <div class="row">
            <div class="col-md-3">
            <div class="thumb" style="background-image: url('/assets/img/{{$imagen}}'); height: 170px;"></div>
            </div>
            <div class="col-md-9">
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <form style="margin: 0px !important; padding: 0px !important;">
                            <div class="column" style="margin: 0px !important; padding: 0px !important;">                                                                     
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Institucion:</strong> </span></div>
                                <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$servicio->sucursal->institucion->nombre}} </span></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Sucursal:</strong> </span></div>
                                <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$servicio->sucursal->nombre}}</span></div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Servicio: </strong></span></div>
                                <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$servicio->nombre}}</span></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Horario:</strong> </span></div>
                                <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$servicio->horario}}</span></div>
                            </div>
                             <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Numero: </strong></span></div>
                                <div class="col-md-10 col-sm-10 col-xs-8"><span>
                                    @if($servicio->numero_actual != -1){{$servicio->numero_actual}}
                                    @else 0
                                    @endif 
                                    @if($servicio->letra != 'No especificado')-{{$servicio->letra}} @endif                                    
                                </span></div>
                            </div>
                             <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Descripcion:</strong> </span></div>
                                <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$servicio->descripcion}}</span></div>
                            </div> 
                            </div>                         
                        </form>
                    </div>
                </div>
            </div>
        </div>-->
        <h4 style="margin-top: 15px; color: #1485ee;" ><i class="fa fa-hand-o-up"></i> Seleccione un cubiculo disponible</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">

        <p>Para comenzar la atencion del servicio asignado debe seleccionar un cubiculo disponible, los cubiculos disponibles están marcados con azul. Una vez seleccionado el cubiculo debe confirmar la apertura de este mismo, luego será redirigido al control del cubiculo.  Desde ahi podrá llamar al siguiente ticket,  notificar el  estado de la atencion y cerrar el cubiculo para terminar.</p>

        <hr style="margin: 0px; margin-bottom: 15px;">

        <div class="row">

            @if(empty($servicio->cubiculos))
            <h4 class="text-center">No hay cubiculos asignados para este servicio. Comuniquese con el manager de la plataforma correspondiente a su institución.</h4>
            @endif
          
            @foreach($servicio->cubiculos->sortBy('disponibilidad') as $cubiculo)

            <!-- Panel de cubiculo -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">       
                @if($cubiculo->operario==NULL)<a href="#">@endif<div class="panel panel-default @if($cubiculo->operario!=NULL) panel-off @endif">
                    <!--<div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-cube"></i> {{$cubiculo->nombre}}</h3></div>-->
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
            </div> <!-- Panel de cubiculo -->
            @endforeach
        </div>
    </div>
  
@endsection


  

 

