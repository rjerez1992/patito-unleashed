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
        <h1 style="color: #1485ee;">Agregar nuevo<a href="/admin/lista/clientes" class="btn btn-danger pull-right" type="button"><i class="fa fa-remove"></i><span class="hidden-xs"> Cancelar </span></a></h1>
        <hr style="margin-top: 0px; margin-bottom: 15px;">
        <div>
            <ul class="nav nav-tabs nav-justified">
                <li class="{{$clienteActive}}"><a href="/admin/agregar/clientes">Cliente </a></li>
                <li class="{{$operarioActive}}"><a href="/admin/agregar/operarios">Operario</a></li>
                <li class="{{$managerActive}}"><a href="/admin/agregar/managers">Manager</a></li>
                <li class="{{$adminActive}}"><a href="/admin/agregar/admins">Administrador</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" role="tabpanel" id="tab-1">
                    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

                    <div class="panel panel-default" style="margin-top: 30px;">                        
                        <div class="panel-body">
                        <form method="POST" action="/admin/agregar/{{$tipoUsuario}}/crear">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="username" class="control-label">Nombre de usuario: </label>
                            <input id="username" name="username" class="form-control" type="text" required autofocus>
                            @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ str_replace("username","nombre de usuario",$errors->first('username')) }}</strong>
                                    </span>
                            @endif
                        </div>
    
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Contraseña: </label>
                            <input id="password" class="form-control" type="password" name="password" required>
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{str_replace('password','contraseña',$errors->first('password')) }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Repetir contraseña: </label>
                            <input id="password-confirm" class="form-control" type="password" name="password_confirmation" required>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label margin-top-15">Nombre completo: </label>
                            <input id="name" class="form-control" type="text" name="name" required autofocus>
                            @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        @if(!$adminActive)
                        <div class="form-group {{ $errors->has('rut') ? ' has-error' : '' }}">
                            <label for="rut" class="control-label">RUT: </label>
                            <input id="rut" name="rut" class="form-control" type="text"required>
                            @if ($errors->has('rut'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rut') }}</strong>
                                    </span>
                            @endif
                        </div>
                        @endif

                        @if($operarioActive)
                        <!-- Select para servicios --> 
                        <div class="form-group {{ $errors->has('servicio') ? ' has-error' : '' }}">
                            <label for="servicio" class="control-label">Servicio asociado: </label>
                            <select class="form-control" name="servicio" id="servicio">
                                @foreach($instituciones as $institucion)
                                <optgroup label="{{$institucion->nombre}}">     
                                    @foreach($institucion->servicios as $servicio)                       
                                    <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
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
                        <!-- Select para instituciones  --> 
                        <div class="form-group {{ $errors->has('institucion') ? ' has-error' : '' }}">
                            <label for="institucion" class="control-label">Institucion asociada: </label>
                            <select class="form-control" name="institucion" id="institucion">
                                @foreach($instituciones as $institucion)
                                <option value="{{$institucion->id}}">{{$institucion->nombre}}</option>
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
                            <button class="btn btn-info" style="margin-bottom: 0px;" type="submit"><i class="fa fa-plus"></i> Agregar registro en {{$tipoUsuario}} </button>
                        </div>
                    </form>                 
                    </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>            
            </div>
        </div>
    </div> 
@endsection


  

 

