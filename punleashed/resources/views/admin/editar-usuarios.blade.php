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
        <h1 style="color: #1485ee;">Edicion de usuarios
        @if(!Session::get('status-ok'))<a href="/admin/lista/clientes" class="btn btn-danger pull-right" type="button"><i class="fa fa-remove"></i><span class="hidden-xs"> Cancelar </span></a>
        @else <a href="/admin/lista/clientes" class="btn btn-info pull-right" type="button"><i class="fa fa-arrow-left"></i><span class="hidden-xs"> Volver atras </span></a>@endif
        </h1>
        <hr style="margin-top: 0px; margin-bottom: 15px;">
        <div>
            <div class="tab-content">
                <div class="tab-pane fade in active" role="tabpanel" id="tab-1">
                    <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="panel panel-default" style="margin-top: 30px;">                        
                        <div class="panel-body">
                        <form method="POST" action="/admin/editar/{{$tipoUsuario}}/editar">
                        {{ csrf_field() }}

                        <input type="hidden" name="usuarioId" id="usuarioId" value="{{$usuario->id}}">

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="username" class="control-label">Nombre de usuario: </label>
                            <input id="username" name="username" class="form-control" type="text" required autofocus placeholder="Patricio774" value="{{$cuenta->username}}">
                            @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ str_replace("username","nombre de usuario",$errors->first('username')) }}</strong>
                                    </span>
                            @endif
                        </div>
    
                        <!--<h3>Cambiar contraseña</h3>-->
                        <hr>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Nueva contraseña: </label>
                            <input id="password" class="form-control" type="password" name="password">
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{str_replace('password','contraseña',$errors->first('password')) }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Repetir nueva contraseña: </label>
                            <input id="password-confirm" class="form-control" type="password" name="password_confirmation">
                        </div>

                        <hr>

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Nombre completo: </label>
                            <input id="name" class="form-control" type="text" name="name" required autofocus placeholder="Patricio Castro" value="{{$usuario->nombre}}">
                            @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>


                        @if(!$adminActive)
                        <div class="form-group {{ $errors->has('rut') ? ' has-error' : '' }}">
                            <label for="rut" class="control-label">RUT: </label>
                            <input id="rut" name="rut" class="form-control" type="text" required placeholder="123456785" value="{{$usuario->rut}}">
                            @if ($errors->has('rut'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rut') }}</strong>
                                    </span>
                            @endif
                        </div>
                        @endif

                        @if($operarioActive)
                        <hr>
                        <!-- Select para servicios --> 
                        <div class="form-group {{ $errors->has('servicio') ? ' has-error' : '' }}">
                            <label for="servicio" class="control-label">Servicio asociado: </label>
                            <select class="form-control" name="servicio" id="servicio">
                                @foreach($instituciones as $institucion)
                                <optgroup label="{{$institucion->nombre}}">     
                                    @foreach($institucion->servicios as $servicio)                       
                                    <option value="{{$servicio->id}}" @if($servicio->id==$usuario->servicio_id) selected @endif>{{$servicio->nombre}}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                            @if ($errors->has('servicio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('servicio') }}</strong>
                                    </span>
                            @endif
                        </div>
                        @endif

                        @if($managerActive)
                        <hr>
                        <!-- Select para instituciones  --> 
                        <div class="form-group {{ $errors->has('institucion') ? ' has-error' : '' }}">
                            <label for="institucion" class="control-label">Institucion asociada: </label>
                            <select class="form-control" name="institucion" id="institucion">
                                @foreach($instituciones as $institucion)
                                <option value="{{$institucion->id}}" @if($institucion->id==$usuario->institucion_id) selected @endif>{{$institucion->nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('institucion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('institucion') }}</strong>
                                    </span>
                            @endif
                        </div>
                        @endif
    
                        <div class="form-group" style="margin-bottom: 0px;">
                            <button class="btn btn-info margin-top-15" style="margin-bottom: 0px;" type="submit"><i class="fa fa-pencil"></i> Guardar cambios de {{$tipoUsuario}} </button>
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
                        <h3 class="panel-title"><i class="fa fa-warning"></i> Edicion de usuarios</h3></div>                    
                        <div class="panel-body"> 
                        <div class="thumb-tall" style="background-image: url('/assets/img/negocio1.jpeg')"></div>
                        Es importante mantener cuidado al  modificar los distintos usuarios del  sistema. A nadie le gusta que le cambien su informacion personal de un momento para otro. Notifica a los usuarios cuando  cambies sus datos por algun motivo.
                        <br><br>
                        Recuerda que un cambio repentino  en el usuario  o contraseña podría dejar al  usuario  respectivo  sin acceso  a la plataforma.
                        </div>
                        <div class="panel-footer"></div>
                   </div>
                   </div>            
            </div>
        </div>
    </div> 
@endsection