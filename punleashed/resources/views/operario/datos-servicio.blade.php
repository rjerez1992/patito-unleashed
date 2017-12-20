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
        <h1 style="color: #1485ee;">Datos del servicio       
        </h1>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <h4 style="color: #1485ee;"> <i class="fa fa-info-circle"></i> Datos de atención del servicio</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <div class="row">
            <div class="col-md-3">
            <div class="thumb" style="background-image: url('/assets/img/{{$imagen}}'); height: 177px;"></div>
            </div>
            <div class="col-md-9">
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12">
                        <form style="margin: 0px !important; padding: 0px !important;">
                            <div class="column" style="margin: 0px !important; padding: 0px !important;">                                             
                                 <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12">
                              <span style="margin-bottom: 30px;"><i class="fa fa-info-circle"></i> Haz click en  la institucion o sucursal para ver informacion mas detallada de cada una.</span> </div>
                              </div>

                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Institucion:</strong> </span></div>
                                <!-- TODO: Agregar links para ver institucion, mismo abajo con  sucursal -->
                                <a href="#"><div class="col-md-10 col-sm-10 col-xs-8"><span>{{$servicio->sucursal->institucion->nombre}} </span></div></a>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Sucursal:</strong> </span></div>
                                <a href="#"><div class="col-md-10 col-sm-10 col-xs-8"><span>{{$servicio->sucursal->nombre}}</span></div></a>
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
                             <!--<div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Numero: </strong></span></div>
                                <div class="col-md-10 col-sm-10 col-xs-8"><span>
                                    @if($servicio->numero_actual != -1){{$servicio->numero_actual}}
                                    @else 0
                                    @endif 
                                    @if($servicio->letra != 'No especificado')-{{$servicio->letra}} @endif                                    
                                </span></div>
                            </div>-->
                             <div class="row" style="margin-bottom: 30px;">
                                <div class="col-md-2 col-sm-2 col-xs-4"><span><strong>Descripcion:</strong> </span></div>
                                <div class="col-md-10 col-sm-10 col-xs-8"><span>{{$servicio->descripcion}}</span></div>
                            </div> 

                       
                            </div>                         
                        </form>
                    </div>
                </div>  
              
            </div>

        </div>    

         <h4 style="color: #1485ee;"> <i class="fa fa-info-circle"></i> Managers a cargo</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <div class="row">
        <div class="col-md-12">
            @foreach($usuario->servicio->sucursal->institucion->managers as  $manager)
             <a href="#"><div class="row">
                <div class="col-md-12"><span><i class="fa fa-user"></i> {{$manager->nombre}} <!--- Desde {{$manager->created_at}}--></span></div>
                               
            </div> </a>
            @endforeach
        </div>
        </div>



    </div>
  
@endsection


  

 

