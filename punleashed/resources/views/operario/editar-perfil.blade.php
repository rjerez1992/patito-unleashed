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
    @php $backButton = true; @endphp
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

    <!-- TODO: Mover la imagen hacia arriba y colocar al lado el heading con la informacion. (En columnas separadas) -->  
    <div class="container">
        <h1 style="color: #1485ee;">Editar perfil
        <!-- boton editar -->

       
        @if(isset($backButton) && $backButton)
         <a href="/operario/perfil" class="btn btn-info pull-right" type="button"><i class="fa fa-chevron-left"></i><span class="hidden-xs"> Volver al perfil</span></a>
        @else
         <a href="/operario/perfil" class="btn btn-danger pull-right" type="button"><i class="fa fa-times"></i><span class="hidden-xs"> Cancelar</span></a>
        @endif
        <!-- boton  perfil publico -->
        <!--<a href="#" class="btn btn-link pull-right" type="button" style="margin-right: 15px;"><i class="fa fa-eye"></i><span class="hidden-xs"> Ver pefil publico</span></a>-->

        </h1>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <h4 style="color: #1485ee;"> <i class="fa fa-user"></i> {{$usuario->nombre}}</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        
        <div>
            <div class="tab-content">
                <div class="tab-pane fade in active" role="tabpanel" id="tab-1">
                    
                    <div class="panel panel-default" style="margin-top: 30px;">                        
                    <div class="panel-body">

                    <div class="col-lg-6 col-md-6 col-sm-12">

                    
                        <form method="POST" action="/operario/perfil/editarPerfil" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!-- Datos de cuenta -->
                        <h3>Datos de cuenta</h3>
                        <hr style="margin: 0px; margin-bottom: 15px;">

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="username" class="control-label">Nombre de usuario: </label>
                            <input id="username" name="username" class="form-control" type="text" required placeholder="Patricio774" value="{{$cuenta->username}}" readonly>
                            @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ str_replace("username","nombre de usuario",$errors->first('username')) }}</strong>
                                    </span>
                            @endif
                        </div>
    
                        <!--<h3>Cambiar contraseña</h3>-->                

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Nueva contraseña: </label>
                            <input id="password" class="form-control" type="password" name="password">
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{str_replace('password','contraseña',$errors->first('password')) }}</strong>
                                    </span>
                            @endif
                            <span style="color: gray;">Dejar en blanco si no desea cambiar</span>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Repetir nueva contraseña: </label>
                            <input id="password-confirm" class="form-control" type="password" name="password_confirmation">
                            <span style="color: gray;">Dejar en blanco si no desea cambiar</span>
                        </div>

                        

                        



                        <div class="form-group" style="margin-bottom: 0px;">
                            <button class="btn btn-info margin-top-15" style="margin-bottom: 0px;" type="submit"><i class="fa fa-pencil"></i> Actualizar perfil</button>
                        </div>
                     
                                 
                  
                </div>
                 <!-- Panel  de  informacion -->
                <div class="col-lg-6 col-md-6 col-sm-12">   

                <h3>Datos personales</h3>
                <hr style="margin: 0px; margin-bottom: 15px;">  

                   <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">Nombre completo: </label>
                            <input id="name" class="form-control" type="text" name="name" required autofocus placeholder="Patricio Castro" value="{{$usuario->nombre}}">
                            @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>


                        <div class="form-group {{ $errors->has('rut') ? ' has-error' : '' }}">
                            <label for="rut" class="control-label">RUT: </label>
                            <input id="rut" name="rut" class="form-control" type="text" required placeholder="123456785" value="{{$usuario->rut}}">
                            @if ($errors->has('rut'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rut') }}</strong>
                                    </span>
                            @endif
                        </div>
                    
                    <!-- Imagen -->
                        <h3>Nueva imagen</h3>
                        <hr style="margin: 0px; margin-bottom: 15px;">
                        
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-info">
                                    <i class="fa fa-folder"></i> Nueva <input name="image" id="image" type="file" style="display: none;">
                                </span>
                            </label>
                            <input type="text" class="form-control">
                        </div>

                      
                  
                        <!-- Select para servicios --> 
                        <!-- mostrar servicio (no se puede cambiar) -->
                                         
    

                <!--          
                    <div class="thumb-tall" style="background-image: url('/assets/img/negocio1.jpeg')"></div>
                    Es importante mantener cuidado al  modificar los distintos usuarios del  sistema. A nadie le gusta que le cambien su informacion personal de un momento para otro. Notifica a los usuarios cuando  cambies sus datos por algun motivo.
                    <br><br>
                    Recuerda que un cambio repentino  en el usuario  o contraseña podría dejar al  usuario  respectivo  sin acceso  a la plataforma.-->


                </div>  
                </form> 


                </div>    
               <div class="panel-footer"></div>        
            </div>

        </div>


    </div>


    <!-- Script para el file input -->
    <script type="text/javascript">
        $(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});

    </script>


  
@endsection


  

 

