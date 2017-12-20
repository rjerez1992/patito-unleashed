@extends('layouts.main')

@section('styles')
@endsection

@section('scripts')
@endsection

@php
@endphp

@section('content')

    @include('layouts.main-nav')

    @if (isset($status))  
    <!-- Modal de notificaciones por defecto -->    
    <div class="modal fade in" id="defaultModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">@if($status==true)<i class="fa fa-info-circle"></i>@else<i class="fa fa-remove"></i>@endif Información del Sistema </h4></div>
                <div class="modal-body">
                    <p>{{ $msg }}</p>
                </div>
                <div class="modal-footer" styles="padding: 0px !important; margin; 0px; bottom: 0px;">
                    <button class="btn @if($status==true) btn-info @else btn-danger @endif btn-sm" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Aceptar</button>
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
        <div class="row row-title">
            <div class="col-md-10 col-sm-10 col-xs-12">
                <h3 class="text-left">Edición del Cliente</h3>
            </div>
        </div>
        <div>
            <div class="tab-content">
                <div class="tab-pane fade in active" role="tabpanel" id="tab-1">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="panel panel-default">  
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <h4 class="ticket-heading-number"><i class="fa fa-info-circle fa-fw icon-ticket-list"></i><strong>Información Básica</strong></h4></div>
                                </div>
                            </div>                      
                            <div class="panel-body">
                                <form method="POST" action="/cliente/profile/edit/basic">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="institucionId" id="institucionId" value="1234">

                                    
                                    <div class="form-group">
                                        <label for="nameCliente" class="control-label">Nombre del Cliente: </label>
                                        <input id="nameCliente" name="nameCliente" class="form-control" type="text" required placeholder="Ingrese nombre" value="{{$cliente->nombre}}">
                                        @if ($errors->has('nameCliente'))
                                                <span class="help-block">
                                                    <strong>Nombre debe contener al menos 10 carácteres.</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="direccionCliente" class="control-label">Dirección: </label>
                                        <input id="direccionCliente" name="direccionCliente" class="form-control" type="text" required autofocus placeholder="Ingrese dirección" value="{{$cliente->direccion}}">
                                        @if ($errors->has('direccionCliente'))
                                                <span class="help-block">
                                                    <strong>Dirección debe tener al menos 16 carácteres.</strong>
                                                </span>
                                        @endif
                                    </div>     

                                    <div class="form-group">
                                        <label for="imageCliente" class="control-label">Imagen de Perfil: </label>
                                        <input id="imageCliente" name="imageCliente" class="form-control" type="text" required autofocus placeholder="Ingrese link imagen de perfil" value="{{$cliente->imagen}}">
                                    </div>                             
                
                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <button class="btn btn-primary pull-right" style="margin-bottom: 0px;" type="submit"><i class="fa fa-pencil"></i> Guardar información </button>
                                    </div>
                                </form>                 
                            </div>
                        </div>
                    </div>   

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="panel panel-default">   
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <h4 class="ticket-heading-number"><i class="fa fa-info-circle fa-fw icon-ticket-list"></i><strong>Acualizar Contraseña</strong></h4></div>
                                </div>
                            </div>                      
                            <div class="panel-body">
                                <form method="POST" action="/cliente/profile/edit/pass">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="oldPass" class="control-label">Contraseña Actual: </label>
                                        <input id="oldPass" name="oldPass" class="form-control" type="password" required autofocus placeholder="Ingrese contraseña actual">
                                        @if ($errors->has('nameCliente'))
                                                <span class="help-block">
                                                    <strong>Contraseña no válida.</strong>
                                                </span>
                                        @endif
                                    </div>  

                                    <div class="form-group">
                                        <label for="newPass" class="control-label">Nueva contraseña: </label>
                                        <input id="newPass" name="newPass" class="form-control" type="password" required autofocus placeholder="Ingrese nueva contraseña">
                                        @if ($errors->has('nameCliente'))
                                                <span class="help-block">
                                                    <strong>Contraseñas no coinciden.</strong>
                                                </span>
                                        @endif
                                    </div>  

                                    <div class="form-group">
                                        <label for="newPass2" class="control-label">Reingrese nueva contraseña: </label>
                                        <input id="newPass2" name="newPass2" class="form-control" type="password" required autofocus placeholder="Reingrese nueva contraseña">
                                        @if ($errors->has('nameCliente'))
                                                <span class="help-block">
                                                    <strong>{{$cliente->nombre}}</strong>
                                                </span>
                                        @endif
                                    </div>  

                
                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <button class="btn btn-primary pull-right" style="margin-bottom: 0px;" type="submit"><i class="fa fa-pencil"></i> Cambiar contraseña </button>
                                    </div>
                                </form>                 
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div> 
@endsection