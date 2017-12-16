@extends('layouts.main')

@section('content')
@extends('layouts.main-nav')

<style type="text/css">
 body {
      background: #F1F3FA;
    }
</style>

<body>
<body>
  <div class="container">
    <div class="row ">
        <div class="col-md-1"></div>
        <div class="panel col-md-10"  style="text-align:cen">
          	<h2 style="margin-left:20px">
              Operarios
              <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#NuevoOperario"style="float:right;">Nuevo Operario</button>

            </h2>
            <div id="NuevoOperario" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nuevo Operario</h4>
                  </div>
                   {!! Form::open(['route' => ['Insertar.Operario2',2], 'method' => 'POST','validate','name'=>'myForm','files'=>'true']) !!}
                      <div class="modal-body">
                      <div class="row">

                        <div class="col-md-12 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <h4>Cuenta</h4>
                              <label for="username" class="control-label">Nombre de usuario: </label>
                              <input id="username" name="username" class="form-control" type="text" placeholder="Ejemplo: matias29" value="{{ old('username') }}" required autofocus>
                              @if ($errors->has('username'))
                                      <span class="help-block">
                                          <strong>{{ str_replace("username","nombre de usuario",$errors->first('username')) }}</strong>
                                      </span>
                              @endif
                          </div>

                          <div class=" col-md-12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                              <label for="email" class="control-label">Correo electronico:</label>
                              <input id="email" name="email" class="form-control" type="email" placeholder="Ejemplo: mguajardo@dominio.com" value="{{ old('email') }}" required>
                              @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                              @endif
                          </div>

                          <div class="form-group col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                              <label for="password" class="control-label">Contraseña: </label>
                              <input id="password" class="form-control" type="password" name="password" required>
                              @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{str_replace('password','contraseña',$errors->first('password')) }}</strong>
                                      </span>
                              @endif
                          </div>

                          <div class="form-group col-md-6">
                              <label for="password-confirm" class="control-label">Repetir contraseña: </label>
                              <input id="password-confirm" class="form-control" type="password" name="password_confirmation" required>
                          <br>
                          </div>
                          <div class="col-md-12 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                          <h4>Datos Personales</h4>
                              <label for="name" class="control-label margin-top-15">Nombre completo: </label>
                              <input id="nombre" class="form-control" type="text" placeholder="Ejemplo: Matias Guajardo" name="nombre" value="{{ old('name') }}" required autofocus>
                              @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                              @endif
                          </div>

                          <div class="col-md-12 form-group {{ $errors->has('rut') ? ' has-error' : '' }}">
                              <label for="rut" class="control-label">RUT: </label>
                              <input id="rut" name="rut" class="form-control" type="text" placeholder="Ejemplo: 15755658" required>
                              @if ($errors->has('rut'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('rut') }}</strong>
                                      </span>
                              @endif
                          </div>
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class=" form-group col-md-6">
                            {!! Form::label('sucursal', 'Sucursal', ['for' => 'sucursal'] ) !!}<br>
                            {{Form::select('sucursal', $Sucursales, null,['id'=>'sucursal','style'=>'margin-bottom:5px','required' => 'required','class'=>'form-control','onchange' => 'javascript:Servicio(this.value)']) }}<br>
                            <br>
                          </div>
                          <div class="form-group col-md-6">
                            {!! Form::label('servicio', 'Servicio', ['for' => 'servicio'] ) !!}<br>
                            {{Form::select('servicio',[null=>'Seleccione'],null,['id'=>'servicio','style'=>'margin-bottom:5px','required' => 'required', 'class'=>'form-control']) }}<br>
                            <br>
                          </div>

                          <div class="col-md-12 form-group">
                            <label class="col-md-4 control-label">Imagen de perfil</label>
                            <br>
                            <input type="file"  name="file" >
                          </div>
                          <br>
                          <br>

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button  type="submit" value="Submit" class="btn btn-success">Crear</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      </div>
                      {!! Form::close() !!}  
                      
                </div>

              </div>
            </div>
            <hr>
            <br>
            <table class="table">
              <thead>
                <tr>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Rut</th>
                  <th>Correo</th>
                  <th>Sucursal</th>
                  <th>Servicio</th>
                  <th>Cubiculo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @if($operarios != null)
                  @foreach ($operarios as $operario)
                    <tr>
                      <td><img src="../storage/{{$operario->imagen}}" width="100px"></td>
                      <td>{{$operario->nombre}}</td>
                      <td>{{$operario->rut}}</td>
                      <td>{{$operario->Cuenta($operario->cuenta_id)->email}}</td>
                      <td>{{$operario->Sucursal($operario->servicio_id)->nombre}}</td>
                      <td>{{$operario->Servicio($operario->servicio_id)->nombre}}</td>
                      <td>
                        @if( $operario->cubiculo_id==0)
                          Sin Cubiculo
                        @else
                        {{$operario->Cubiculo($operario->cubiculo_id)->nombre}}

                        @endif
                      </td>
                      <td>
                         <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Acciones
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="#" data-toggle="modal" data-target="#EditarOperario_{{$operario->id}}">Editar</a></li>
                              <li><a href="#" data-toggle="modal" data-target="#EliminarOperario_{{$operario->id}}">Eliminar</a></li>
                              <li><a href="#" data-toggle="modal" data-target="#CubiculoOperario_{{$operario->id}}">Asignar Cubiculo</a></li>
                            </ul>
                          </div> 
                      </td>
                    </tr>
                                        <!-- Modal -->
                    <div id="EditarOperario_{{$operario->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Nuevo Operario</h4>
                              </div>
                               {!! Form::open(['route' => ['EditarOperario',$operario->id], 'method' => 'POST','validate','name'=>'myForm','files'=>'true']) !!}
                                  <div class="modal-body">
                                  <div class="row">

                                    <div class="col-md-12 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <h4>Cuenta</h4>
                                          <label for="username" class="control-label">Nombre de usuario: </label>
                                          <input id="username" name="username" class="form-control" type="text" value="{{$operario->Cuenta($operario->cuenta_id)->username }}" value="{{ old('username') }}" required autofocus>
                                          @if ($errors->has('username'))
                                                  <span class="help-block">
                                                      <strong>{{ str_replace("username","nombre de usuario",$errors->first('username')) }}</strong>
                                                  </span>
                                          @endif
                                      </div>

                                      <div class=" col-md-12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                          <label for="email" class="control-label">Correo electronico:</label>
                                          <input id="email" name="email" class="form-control" type="email" value="{{$operario->Cuenta($operario->cuenta_id)->email }}" disabled>
                                          <input id="idS" name="idS" type="hidden" value="{{$operario->Cuenta($operario->cuenta_id)->id }}" >
                                          @if ($errors->has('email'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('email') }}</strong>
                                                  </span>
                                          @endif
                                      </div>

                                      <div class="form-group col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                                          <label for="password" class="control-label">Contraseña: </label>
                                          <input id="password" class="form-control" type="password" name="password" required>
                                          @if ($errors->has('password'))
                                                  <span class="help-block">
                                                      <strong>{{str_replace('password','contraseña',$errors->first('password')) }}</strong>
                                                  </span>
                                          @endif
                                      </div>

                                      <div class="form-group col-md-6">
                                          <label for="password-confirm" class="control-label">Repetir contraseña: </label>
                                          <input id="password-confirm" class="form-control" type="password" name="password_confirmation" required>
                                      <br>
                                      </div>
                                      <div class="col-md-12 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                      <h4>Datos Personales</h4>
                                          <label for="name" class="control-label margin-top-15">Nombre completo: </label>
                                          <input id="nombre" class="form-control" type="text" value="{{$operario->nombre}}" name="nombre"  required autofocus>
                                          @if ($errors->has('name'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                          @endif
                                      </div>

                                      <div class="col-md-12 form-group {{ $errors->has('rut') ? ' has-error' : '' }}">
                                          <label for="rut" class="control-label">RUT: </label>
                                          <input id="rut" name="rut" class="form-control" type="text" value="{{$operario->rut}}" required>
                                          @if ($errors->has('rut'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('rut') }}</strong>
                                                  </span>
                                          @endif
                                      </div>
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <div class=" form-group col-md-6">
                                        {!! Form::label('sucursal', 'Sucursal', ['for' => 'sucursal'] ) !!}<br>
                                        {{Form::select('sucursal', $Sucursales, null,['id'=>'sucursal','style'=>'margin-bottom:5px','required' => 'required','class'=>'form-control','onchange' => 'javascript:Servicio2(this.value)']) }}<br>
                                        <br>
                                      </div>
                                      <div class="form-group col-md-6">
                                        {!! Form::label('servicio', 'Servicio', ['for' => 'servicio'] ) !!}<br>
                                        {{Form::select('servicio2',[null=>'Seleccione'],null,['id'=>'servicio2','style'=>'margin-bottom:5px','required' => 'required', 'class'=>'form-control']) }}<br>
                                        <br>
                                      </div>
                                      <div class="col-md-12 form-group">
                                        <label class="col-md-4 control-label">Imagen de perfil</label>
                                        <br>
                                        <input type="file"  name="file" >
                                      </div>
                                      <br>
                                      <br>

                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button  type="submit" value="Submit" class="btn btn-success">Modificar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                  </div>
                                {!! Form::close() !!}  
                            </div>

                        </div>
                    
                    </div>

                    <div id="EliminarOperario_{{$operario->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Eliminar Operario</h4>
                          </div>
                          {!! Form::open(['route' => ['EliminarOperario',$operario->id], 'method' => 'POST','validate','name'=>'myForm','files'=>'true']) !!}
                          <div class="modal-body">
                            <p>¿Decea eliminar el operario {{$operario->nombre}}?.</p>
                          </div>
                          <div class="modal-footer">
                            <button  type="submit" value="Submit" class="btn btn-success">Eliminar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          </div> 
                           {!! Form::close() !!}
                        </div>

                      </div>
                    </div>

                    <div id="CubiculoOperario_{{$operario->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Asignar Cubiculo</h4>
                          </div>
                          {!! Form::open(['route' => ['AgregarCubiculo',$operario->id], 'method' => 'POST','validate','name'=>'myForm','files'=>'true']) !!}

                          <div class="modal-body">
                            {!! Form::label('Cubiculo', 'Nombre Operario: ') !!}

                            <h5>{{$operario->nombre}}</h5>
                            <br>
                             <div class="form-group">
                               {!! Form::label('Cubiculo', 'Cubiculo') !!}
                                @if($operario->Cubiculos($operario->servicio_id)->Count() > 0)
                                  <select name="cubiculo" class="form-control">
                                    <option value="0">Seleccione</option>

                                    @foreach ($operario->Cubiculos($operario->servicio_id) as $cubiculo)
                                      <option value="{{$cubiculo->id}}">{{$cubiculo->nombre}}</option>
                                    @endforeach
                                  </select> 
                                @else
                                  <h5>No existen cubiculos para este servicio</h5>
                                @endif
                              </div>
                          </div>
                          <div class="modal-footer">
                                <button  type="submit" value="Submit" class="btn btn-success">Crear</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          </div>
                          {!! Form::close() !!}  

                        </div>

                      </div>
                    </div>
                   @endforeach
                @endif
                
                
              </tbody>
            </table>
            
        </div>
    </div>
  </div>

<center>
</center>
<br>
<br>
<script type="text/javascript">
  function Servicio(_sucursal) {
    var procemessage = "<option value='0'> Cargando...</option>";
    $("#servicio").html(procemessage).show();
    var url = "Servicio.N";
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        data: { id: _sucursal, _token: token },   
        type: "POST",
        success: function (data) {
           var markup = "<option value='-1'>Seleccione</option>";
           for (var x = 0; x < data.length; x++) {
              markup += "<option value=" + data[x].id + ">" + data[x].nombre + "</option>";
           }
           $("#servicio").html(markup).show();
           },
        error: function (reponse) {
           alert("error : " + reponse);
        }
     });
  }
</script>
<script type="text/javascript">
  function Servicio2(_sucursal) {
    console.log("333333333")
    var procemessage = "<option value='0'> Cargando...</option>";
    $("#servicio2").html(procemessage).show();
    var url = "Servicio.N";
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        data: { id: _sucursal, _token: token },   
        type: "POST",
        success: function (data) {
           var markup = "<option value='-1'>Seleccione</option>";
           for (var x = 0; x < data.length; x++) {
              markup += "<option value=" + data[x].id + ">" + data[x].nombre + "</option>";
           }
           $("#servicio2").html(markup).show();
           },
        error: function (reponse) {
           alert("error : " + reponse);
        }
     });
  }
</script>
<script>
  $(function () {
     $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>
</body>


@endsection

