@extends('layouts.main')

@section('styles')
@endsection

@section('scripts')
@endsection

@php
@endphp

@section('content')

    @include('layouts.main-nav')

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

    <div class="container">
        <h1 style="color: #1485ee;">Edicion de institucion
        @if(!Session::get('status-ok'))<a href="/admin/instituciones/lista" class="btn btn-danger pull-right" type="button"><i class="fa fa-remove"></i><span class="hidden-xs"> Cancelar </span></a>
        @else <a href="/admin/instituciones/lista" class="btn btn-info pull-right" type="button"><i class="fa fa-arrow-left"></i><span class="hidden-xs"> Volver a instituciones </span></a>@endif
        </h1>
        <hr style="margin-top: 0px; margin-bottom: 15px;">
        <div>
            <div class="tab-content">
                <div class="tab-pane fade in active" role="tabpanel" id="tab-1">
                    <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="panel panel-default" style="margin-top: 30px;">                        
                        <div class="panel-body">
                        <form method="POST" action="/admin/instituciones/editar/editar">
                        {{ csrf_field() }}

                        <input type="hidden" name="institucionId" id="institucionId" value="{{$institucion->id}}">

                        <!-- name -->
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Nombre de la institucion: </label>
                            <input id="name" name="name" class="form-control" type="text" required autofocus placeholder="Patricio774" value="{{$institucion->nombre}}">
                            @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ str_replace("name","nombre de institucion",$errors->first('name')) }}</strong>
                                    </span>
                            @endif
                        </div>
    
                       

                        <!-- run -->
                        <div class="form-group {{ $errors->has('run') ? ' has-error' : '' }}">
                            <label for="run" class="control-label">RUN de la institucion </label>
                            <input id="run" name="run" class="form-control" type="text" required placeholder="123456785" value="{{$institucion->run}}">
                            @if ($errors->has('run'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('run') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <!-- descripcion -->
                         <div class="form-group">
                          <label for="descripcion">Descripción:</label>
                          <textarea class="form-control" rows="8" id="descripcion" name="descripcion">{{$institucion->descripcion}}</textarea>
                        </div> 
                      
    
                        <div class="form-group" style="margin-bottom: 0px;">
                            <button class="btn btn-info margin-top-15" style="margin-bottom: 0px;" type="submit"><i class="fa fa-pencil"></i> Guardar cambios en institución </button>
                        </div>
                    </form>                 
                    </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
                 <!-- Panel  de  informacion -->
                    <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="panel panel-default" style="margin-top: 30px;">  
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-warning"></i> Edicion de manager</h3></div>                    
                        <div class="panel-body"> 
                        La edicion del  manager o los  managers de la sucursal  debe realizarse desde la gestion de usuarios. En la barra superior puede encontrar  el  acceso a "Usuarios".
                        </div>
                        <div class="panel-footer"></div>
                   </div>

                    <div class="panel panel-default" style="margin-top: 30px;">  
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-info"></i> Edicion de institucion</h3></div>                    
                        <div class="panel-body"> 
                        <div class="thumb-tall" style="background-image: url('/assets/img/instituciones.jpg')"></div>
                        Al editar la informacion de la institucion, está editando la informacion que es visible para todos los usuarios del sistema. Tenga cuidado al editar esta informacion y procure que sea simple de leer y exprese los datos reales de la institucion.
                        </div>
                        <div class="panel-footer"></div>
                   </div>
                   </div>            
            </div>
        </div>
    </div> 
@endsection