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

    <!-- Modal para eliminar elementos -->
    <div class="modal fade in" id="modalConfirmacion" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="fa fa-remove"></i> Confirmación </h4></div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar el registro de {{$tipoUsuario}}?</p><br>
                    @if($tipoUsuario=='managers') 
                    Si está eliminando un manager el cual es el unico de una institucion, la institucion tambien será eliminada @endif
                </div>
                <div class="modal-footer" styles="padding: 0px !important; margin; 0px; bottom: 0px;">
                    <form class="form-horizontal" method="POST" action="/admin/eliminar/{{$tipoUsuario}}">
                        {{ csrf_field() }}
                        <input class="form-control" value="-1" type="hidden" name="hiddenId" id="hiddenId">
                        <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-check"></i> Eliminar </button>
                        <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">        
        function EliminarUsuario(id){        
            //Pasar id valor al input hidden del modal
            $("#hiddenId").val(id);
            //Abrir modal
            $('#modalConfirmacion').modal('show'); 
        }
    </script>

	<div class="container">
        <h1 style="color: #1485ee;">Usuarios<a href="/admin/agregar/{{$tipoUsuario}}" class="btn btn-info pull-right" type="button"><i class="fa fa-plus"></i><span class="hidden-xs"> Agregar nuevo</span></a></h1>
        <hr style="margin-top: 0px; margin-bottom: 15px;">
        <div>
            <ul class="nav nav-tabs nav-justified">
                <li class="{{$clienteActive}}"><a href="/admin/lista/clientes">Clientes </a></li>
                <li class="{{$operarioActive}}"><a href="/admin/lista/operarios">Operarios</a></li>
                <li class="{{$managerActive}}"><a href="/admin/lista/managers">Managers</a></li>
                <li class="{{$adminActive}}"><a href="/admin/lista/admins">Administradores</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" role="tabpanel" id="tab-1">
                    <div class="table-responsive" style="margin-top: 20px;">
                        <table class="table table-hover">
                            <thead>
                                <tr style="background: #1485ee; color:white;">
                                    <!--<th>ID </th>-->
                                    <th>Nombre</th>
                                    <th>Usuario </th>    
                                    @if($managerActive) <th>Institucion</th>@endif
                                    @if($operarioActive) <th>Servicio</th>@endif                               
                                    <th>Fecha de registro</th>
                                    <th><!--
                                        <button class="btn btn-info btn-block btn-xs" type="button"><i class="fa fa-filter"></i> <span class="hidden-xs">Filtrar resultados</span></button>-->
                                    </th>
                                </tr>
                            </thead>
                            <tbody>    
								@foreach ($lista as $elemento)
                                @if ($elemento->cuenta->username != \Auth::user()->username)
                                <tr>
                                    <!--<td>{{$elemento->id}}</td>-->                                    
                                    <td>{{$elemento->nombre}}</td>
                                    <td>{{$elemento->cuenta->username}}</td>
                                    @if($managerActive) 
                                    <td>{{$elemento->institucion->nombre}}</td>
                                    @endif
                                    @if($operarioActive)
                                    <td>{{$elemento->servicio->nombre}}</td>
                                    @endif
                                    <td style="width: 170px;">{{$elemento->created_at->format('j/m/Y')}}</td>
                                    <td style="width: 170px;">
                                        <div class="btn-toolbar">
                                            <div class="btn-group" role="group">
                                                <a href="/admin/editar/{{$tipoUsuario}}/{{$elemento->id}}" class="btn btn-info btn-xs" type="button" style="width: 70px;"><i class="fa fa-pencil"></i> <span class="hidden-xs">Editar </span></a>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <button onclick="EliminarUsuario({{$elemento->id}})" class="btn btn-danger btn-xs" type="button" style="width: 70px;"><i class="fa fa-times"></i> <span class="hidden-xs">Eliminar </span></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                @endif
                                @endforeach                               
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                    	{{ $lista->links() }}                  
                    </div>
                </div>            
            </div>
        </div>
    </div>


@endsection
 

