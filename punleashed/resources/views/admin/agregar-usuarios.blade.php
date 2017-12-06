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
        <h1 style="color: #1485ee;">Agregar nuevo
        @if(!Session::get('status-ok'))<a href="/admin/lista/clientes" class="btn btn-danger pull-right" type="button"><i class="fa fa-remove"></i><span class="hidden-xs"> Cancelar </span></a>
        @else <a href="/admin/lista/clientes" class="btn btn-info pull-right" type="button"><i class="fa fa-arrow-left"></i><span class="hidden-xs"> Volver a usuarios </span></a>@endif
        </h1>
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
                    <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="panel panel-default" style="margin-top: 30px;">                        
                        <div class="panel-body">
                        <form method="POST" action="/admin/agregar/{{$tipoUsuario}}/crear">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="username" class="control-label">Nombre de usuario: </label>
                            <input id="username" name="username" class="form-control" type="text" required autofocus placeholder="Patricio774">
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
                            <input id="name" class="form-control" type="text" name="name" required autofocus placeholder="Patricio Castro">
                            @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        @if(!$adminActive)
                        <div class="form-group {{ $errors->has('rut') ? ' has-error' : '' }}">
                            <label for="rut" class="control-label">RUT: </label>
                            <input id="rut" name="rut" class="form-control" type="text" required placeholder="123456785">
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
                 <!-- Panel  de  informacion -->
                    <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="panel panel-default" style="margin-top: 30px;">  
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-info"></i> Los {{$tipoUsuario}}</h3></div>                    
                        <div class="panel-body">                       
                        @if($tipoUsuario=='clientes')
                            <div class="thumb-tall" style="background-image: url('/assets/img/usuarios.jpg')"></div>

                            Los clientes son la parte mas escenecial en el  funcionamiento de Ticketter. Los usuarios tienen la capacidad  de buscar buscar instituciones,  buscar sucursales y pedir tickets.
                            <br><br>                           
                            En caso  que un cliente se comporte de manera indebida, el sistema restringirá la cantidad de tickets que puede  obtener hasta un minimo  de uno. Lo mismo aplica de manera  contraría. Un cliente con buen comportamiento tendrá una cantidad maxima de tickets mayor al promedio.
                        @elseif($tipoUsuario=='operarios')
                            <div class="thumb-tall" style="background-image: url('/assets/img/cajero.jpg')"></div>

                            Los operarios son los que hacen que todo el sistema de  Ticketter funcione. Los operarios son los encargados de controlar los distintos cubiculos dispuestos por la sucursal  a la que pertenecen.
                            <br><br>
                            Los operarios son gestionados por los managers de cada  institucion, y tienen la responsabilidad de mover la cola de  clientes y entregar feedback de cada atencion realizada.
                        @elseif($tipoUsuario=='managers')
                            <div class="thumb-tall" style="background-image: url('/assets/img/manager.jpg')"></div>

                            Los managers, gestores de la informacion existente en la plataforma Ticketter. Estos son los encargados de gestionar casi la totalidad de los aspectos de la plataforma.
                            <br><br>
                            Es tarea de  los managers gestionar sus propias instituciones. Cada  manger está relacionado con una  institucion. Ademas, debe gestionar las  sucursales, servicios, cubiculos y operarios correspondientes.
                        @elseif($tipoUsuario=='admins')
                            <div class="thumb-tall" style="background-image: url('/assets/img/admins.jpg')"></div>

                            Los administradores puede gestionar a todos los usuarios y sucursales del sistema. Se debe tener cuidado  con las cuentas de  administrador entregadas, ya que se puede acceder a practicamente cualquier  sección del sistema.

                            Es tarea de los administradores monitorear la plataforma. Detectar problemas  y entregar solucion a los clientes o comunica al  area  de asistencia adecuada para la pronta  correción de ellos.
                        @endif


                        </div>
                        <div class="panel-footer"></div>
                   </div>
                   </div>            
            </div>
        </div>
    </div> 
@endsection


  

 

