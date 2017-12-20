@extends('layouts.main')

@section('content')
@extends('layouts.main-nav')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style type="text/css">
 body {
      background: #F1F3FA;
    }
    .panel-heading{
      background: #2471a3   !important;
      color: white;
    }
</style>

<body>
<body>
  <div class="container">
    <div class="row ">
        <div class="col-md-1"></div>
        <div class="panel col-md-10"  style="text-align:cen">
          	<h2 style="margin-left:20px">Sucursales</h2>
            <hr>
            <br>
            @if($Sucursales != null)

              @foreach ($Sucursales as $sucursal)
              <div class="col-md-4">
                <div class="panel panel-primary " style="height:310px">
                   <div class="panel-heading" ><b>{{ $sucursal->nombre}} </b></div>
                   <div class="panel-body">
                      <div align="center">
                        <img src="{{$sucursal->imagen}}" height="15%" >
                      </div>
                       <br>
                      <h5 class="ticket-heading-number">
                        <strong>
                           Dirección:
                        </strong> 
                        {{ $sucursal->direccion}} 
                      </h5>
                      <h5 class="ticket-heading-number">
                        <strong>
                           Descripción:
                        </strong> 
                        {{ $sucursal->descripcion}} 
                      </h5>
                      <br>
                      <div class="dropdown">
                      <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">Acciones
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a data-toggle="modal" data-target="#verServicios_{{$sucursal->id}}" href="#">Ver Servicios</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModalServ_{{$sucursal->id}}">Agregar Servicio</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-toggle="modal" data-target="#VerOPerario_{{$sucursal->id}}">Ver Operario</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#AgregarOPerario_{{$sucursal->id}}">Agregar Operario</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-toggle="modal" data-target="#VerCubiculo_{{$sucursal->id}}">Ver Cubiculo</a></li>
                        <li><a href="#"  data-toggle="modal" data-target="#AgregarCubiculo_{{$sucursal->id}}">Agregar Cubiculo</a></li>
                      </ul>
                      <div class="modal fade" id="myModalServ_{{$sucursal->id}}" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Crear Servicio</h4>
                            </div>

                            {!! Form::open(['route' => ['Insertar.Servicio', $sucursal->id], 'method' => 'POST','validate','name'=>'myForm']) !!}
                            <div class="modal-body">
                                
                                <div class="form-group">
                                    {!! Form::label('nombre', 'Nombre') !!}
                                    {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                                    
                                </div>
                                <div class="form-group">
                                    {!! Form::label('descripcion', 'Descripción') !!}
                                    {!! Form::text('descripcion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                                </div>
                                
                                <div class="form-group">
                                    {!! Form::label('horario', 'Horario') !!}
                                    {!! Form::textarea('horario', null, ['class' => 'form-control' , 'required' => 'required','size' => '4x3']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('letra', 'Letra') !!}
                                    {!! Form::text('letra', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                                </div>
                                
                                    <input type="hidden" name="idSucursal" value="{{$sucursal->id}}">

                            </div>
                            <div class="modal-footer">
                              <button  type="submit" value="Submit" class="btn btn-success">Crear</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                            {!! Form::close() !!}
                          </div>
                            
                          
                        </div>
                      </div>
                      <div id="verServicios_{{$sucursal->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Servicios</h4>
                            </div>
                            <div class="modal-body">
                               @if($sucursal->getServicios($sucursal->id)!=null)
                                  @foreach ($sucursal->getServicios($sucursal->id) as $servicio)
                                        <div class="col-md-8">
                                           <li>
                                                {{$servicio->nombre}} 
                                           </li>
                                        </div>
                                        <div class="col-md-2">
                                          {!! Form::open(['route' => ['Servicio.Eliminar', $servicio->id], 'method' => 'POST']) !!}
                                                <button style="float:right; background-color:white; border: none">
                                                  <i class="fa fa-remove icon-cerrar-ticket" ></i>
                                                </button>
                                          {!! Form::close() !!}
                                        </div>
                                        <br>
                                  @endforeach
                                @endif

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="modal fade" id="VerOPerario_{{$sucursal->id}}" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Operadores</h4>
                            </div>

                              <div class="modal-body">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Servicio</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if($operarios != null)
                                      @foreach ($operarios as $operario)
                                        @if($operario->getSucursal($operario->servicio_id)->id == $sucursal->id )

                                          <tr>
                                            <td><img src="../storage/{{$operario->imagen}}" width="100px"></td>
                                            <td>{{$operario->nombre}}</td>
                                            <td>{{$operario->getCuenta($operario->cuenta_id)->email}}</td>
                                            <td>{{$operario->getServicio($operario->servicio_id)->nombre}}</td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    @endif
                                    </tbody>
                                  </table>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade" id="AgregarOPerario_{{$sucursal->id}}" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Nuevo Operario</h4>
                            </div>

                            {!! Form::open(['route' => ['Insertar.Operario', $sucursal->id], 'method' => 'POST','validate','name'=>'myForm','files'=>'true']) !!}
                              <div class="modal-body">
                                
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                      <label for="username" class="control-label">Nombre de usuario: </label>
                                      <input id="username" name="username" class="form-control" type="text" placeholder="Ejemplo: matias29" value="{{ old('username') }}" required autofocus>
                                      @if ($errors->has('username'))
                                              <span class="help-block">
                                                  <strong>{{ str_replace("username","nombre de usuario",$errors->first('username')) }}</strong>
                                              </span>
                                      @endif
                                  </div>

                                  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                      <label for="email" class="control-label">Correo electronico:</label>
                                      <input id="email" name="email" class="form-control" type="email" placeholder="Ejemplo: mguajardo@dominio.com" value="{{ old('email') }}" required>
                                      @if ($errors->has('email'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('email') }}</strong>
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
                                      <input id="nombre" class="form-control" type="text" placeholder="Ejemplo: Matias Guajardo" name="nombre" value="{{ old('name') }}" required autofocus>
                                      @if ($errors->has('name'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('name') }}</strong>
                                              </span>
                                      @endif
                                  </div>

                                  <div class="form-group {{ $errors->has('rut') ? ' has-error' : '' }}">
                                      <label for="rut" class="control-label">RUT: </label>
                                      <input id="rut" name="rut" class="form-control" type="text" placeholder="Ejemplo: 15755658" required>
                                      @if ($errors->has('rut'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('rut') }}</strong>
                                              </span>
                                      @endif
                                  </div>
                                  <div class="form-group">
                                    <label for="rut" class="control-label">Servicio asociado: </label>
                                    <select name="servicio" class="form-control" >
                                      @if($sucursal->getServicios($sucursal->id)!=null)
                                        @foreach ($sucursal->getServicios($sucursal->id) as $servicio)
                                          <option value="{{$servicio->id}} ">{{$servicio->nombre}} </option>
                                        @endforeach
                                      @endif
                                    </select> 
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Imagen de perfil</label>
                                    <br>
                                    <input type="file"  name="file" >
                                  </div>
                                  <br>
                                  <br>

                              </div>
                              <div class="modal-footer">
                                <button  type="submit" value="Submit" class="btn btn-success">Crear</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                              </div>
                            {!! Form::close() !!}
                          </div>
                            
                          
                        </div>
                      </div>
                      <div class="modal fade" id="AgregarCubiculo_{{$sucursal->id}}" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Nuevo Cubiculo</h4>
                            </div>

                            {!! Form::open(['route' => ['Insertar.Cubiculo', $sucursal->id], 'method' => 'POST','validate','name'=>'myForm','files'=>'true']) !!}
                              <div class="modal-body">
                                
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                      <label for="username" class="control-label">Nombre del cubiculo: </label>
                                      <input id="nombre" name="nombre" class="form-control" type="text" placeholder="Ejemplo: Cubiculo 1" value="{{ old('username') }}" required autofocus>
                                  </div>
                                  <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                      <label for="username" class="control-label">Numero de atención: </label>
                                      <input type="number" id="myNumber" value="0" name="numero_atencion" class="form-control" required autofocus>
                                  </div>

                                  <select name="disponibilidad" class="form-control">
                                    <option value="Disponible">Disponible</option>
                                    <option value="No Disponible">No Disponible</option>
                                  </select>
                                 

                                  <div class="form-group">
                                    <label for="rut" class="control-label">Servicio asociado: </label>
                                    <select name="servicio_id" class="form-control" >
                                      @if($sucursal->getServicios($sucursal->id)!=null)
                                        @foreach ($sucursal->getServicios($sucursal->id) as $servicio)
                                          <option value="{{$servicio->id}} ">{{$servicio->nombre}} </option>
                                        @endforeach
                                      @endif
                                    </select> 
                                  </div>
                                 
                                  <br>
                                  <br>

                              </div>
                              <div class="modal-footer">
                                <button  type="submit" value="Submit" class="btn btn-success">Crear</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                              </div>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                      <div class="modal fade" id="VerCubiculo_{{$sucursal->id}}" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Ver Cubiculos</h4>
                            </div>

                              <div class="modal-body">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Nombre</th>
                                        <th>Disponibilidad</th>
                                        <th>Servicio</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if($cubiculos != null)
                                      @foreach ($cubiculos as $cubiculo)
                                        @if($cubiculo->getSucursal($cubiculo->servicio_id)->id == $sucursal->id )
                                          <tr>
                                            <td>{{$cubiculo->nombre}}</td>
                                            <td>{{$cubiculo->disponibilidad}}</td>
                                            <td>{{$cubiculo->getServicio($cubiculo->servicio_id)->nombre}}</td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    @endif
                                    </tbody>
                                  </table>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                              </div>
                          </div>
                        </div>
                      </div>
                      
                      
                    </div> 
                    
                  </div>
                </div>
              </div>
               @endforeach
            @endif
        </div>
    </div>
  </div>

<center>
<strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong>
</center>
<br>
<br>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>


@endsection

