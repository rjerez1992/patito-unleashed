@extends('layouts.main')

@section('content')
@extends('layouts.main-nav')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
    body {
      background: #F1F3FA;
    }
    .panel-heading{
      background: #2471a3   !important;
      color: white;
    }

    /* Profile container */
    .profile {
      margin: 20px 0;
    }

    /* Profile sidebar */
    .profile-sidebar {
      padding: 20px 0 10px 0;
      background: #fff;
    }

    .profile-userpic img {
      float: none;
      margin: 0 auto;
      width: 50%;
     
      -webkit-border-radius: 50% !important;
      -moz-border-radius: 50% !important;
      border-radius: 50% !important;
    }

    .profile-usertitle {
      text-align: center;
      margin-top: 20px;
    }

    .profile-usertitle-name {
      color: #5a7391;
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 7px;
    }

    .profile-usertitle-job {
      text-transform: uppercase;
      color: #5b9bd1;
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .profile-userbuttons {
      text-align: center;
      margin-top: 10px;
    }

    .profile-userbuttons .btn {
      text-transform: uppercase;
      font-size: 11px;
      font-weight: 600;
      padding: 6px 15px;
      margin-right: 5px;
    }

    .profile-userbuttons .btn:last-child {
      margin-right: 0px;
    }
        
    .profile-usermenu {
      margin-top: 30px;
    }

    .profile-usermenu ul li {
      border-bottom: 1px solid #f0f4f7;
    }

    .profile-usermenu ul li:last-child {
      border-bottom: none;
    }

    .profile-usermenu ul li a {
      color: #93a3b5;
      font-size: 14px;
      font-weight: 400;
    }

    .profile-usermenu ul li a i {
      margin-right: 8px;
      font-size: 14px;
    }

    .profile-usermenu ul li a:hover {
      background-color: #fafcfd;
      color: #5b9bd1;
    }

    .profile-usermenu ul li.active {
      border-bottom: none;
    }

    .profile-usermenu ul li.active a {
      color: #5b9bd1;
      background-color: #f6f9fb;
      border-left: 2px solid #5b9bd1;
      margin-left: -2px;
    }

    /* Profile Content */
    .profile-content {
      padding: 20px;
      background: #fff;
      min-height: 460px;
    }
</style>

<body>
<body>
  <div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{ $user->username}}
                    </div>
                    <div class="profile-usertitle-job">
                         {{ $user->email}}
                    </div>
                </div>
                
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">

                    <ul class="nav">
                        <li class="active">
                              <a  data-toggle="pill" href="#panel1">
                                  Perfil
                              </a>
                        </li>
                          <li>
                              <a  data-toggle="pill" href="#panel2">
                                  Institución y Sucursales
                              </a>
                          </li>
                       
                    </ul>
                </div>
                <!-- END MENU -->

            </div>
        </div>
        <div class="col-md-9" >


          <div class="profile-content">

            <div class="tab-content">
              <div id="panel1" class="tab-pane fade in active">
                  <h3>Información Manager </h3>
                  <br>
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-4">
                        <strong>
                          INFORMACIÓN CUENTA
                        </strong> 
                        </div>
                      </div>
                  </div>
                  <div class="panel-body">
                   <h5 class="ticket-heading-number" style="margin-left:30px">
                   <h5> <span class="glyphicon glyphicon-envelope"> </span> <strong> Correo:</strong> </h5>
                    {{ $user->email}}
                  </h5>
                  <h5 class="ticket-heading-number" style="margin-left:30px">
                   <h5><i class="fa fa-user"></i> <strong> Nombre de usuario: </strong></h5>
                    {{ $user->username}}
                  </h5>
                  </div>
                </div>

                 <div class="panel panel-primary">
                 <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-4">
                        <strong>
                          INFORMACIÓN PERSONAL
                        </strong> 
                        </div>
                       
                        <div class="col-md-8">
                          <button data-toggle="modal" data-target="#modificarCuenta" class="btn btn-primary" style="float:right; background: #2471a3  ">
                            <i class="fa fa-edit icon-edit-ticket" ></i>
                          </button>

                           <div class="modal fade" id="modificarCuenta" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Modificar Datos</h4>
                                </div>

                                {!! Form::open(['route' => ['/admin/editar/', $cliente->id], 'method' => 'POST','validate','name'=>'myForm']) !!}
                                <div class="modal-body">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Nombre') !!}
                                        {!! Form::text('name', $cliente->nombre, ['class' => 'form-control' , 'required' => 'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rut', 'Rut') !!}
                                        {!! Form::text('rut', $cliente->rut, ['class' => 'form-control' , 'required' => 'required']) !!}
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

                        </div>
                      </div>
                  </div>
                  <div class="panel-body">
                  <h5 >
                   <h5> <i class="fa fa-user"></i> <strong> Nombre: </strong></h5>
                   {{ $cliente->nombre}} 
                  </h5>
                  <h5 class="ticket-heading-number" >
                    <strong>Rut: </strong>
                    {{$cliente->rut}}

                  </h5>
                  </div>
                </div>
                           
              
              </div>
              <div id="panel2" class="tab-pane fade">
                <h3>Información Institución </h3>
                  <br>
                <div class="panel panel-primary">
                  <div class="panel-heading"><i class="fa fa-university"></i>  Mi Institución</div>
                @if($Institucion!=null)
                  <div class="panel-body">
                  <h5 class="ticket-heading-number" >
                   <h5> <i class="fa fa-university"></i> <strong> Nombre: </strong></h5>
                   <h5 style="margin-left:20px"> {{ $Institucion->nombre}} </h5>
                  </h5>
                  <h5 class="ticket-heading-number" >
                   <h5> <i class="fa fa-university"></i> <strong> Run: </strong></h5>
                   <h5  style="margin-left:20px">{{ $Institucion->run}} </h5>
                  </h5>
                  
                  <h5 class="ticket-heading-number" >
                   <h5> <i class="fa fa-list"></i> <strong> Descripción: </strong></h5>
                   <h5  style="margin-left:20px">{{ $Institucion->descripcion}} </h5>
                  </h5>
                  </div>
                  
                  <br>
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Nueva sucursal</h4>
                        </div>

                        {!! Form::open(['route' => ['Insertar.Sucursal'], 'method' => 'POST','validate','name'=>'myForm']) !!}
                        <div class="modal-body">
                            <div class="form-group">
                                {!! Form::label('nombre', 'Nombre de Sucursal') !!}
                                {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('direccion', 'Dirección') !!}
                                {!! Form::text('direccion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('descripcion', 'Descripción') !!}
                                {!! Form::text('descripcion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('url', 'Url Imagen') !!}
                                {!! Form::text('imagen', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                                <input type="hidden" name="idInstitucion" value="{{$Institucion->id}}">

                            </div>
                        </div>
                        <div class="modal-footer">
                          <button  type="submit" value="Submit" class="btn btn-success">Agregar</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    {!! Form::close() !!}
                      </div>
                        
                      
                    </div>
                  </div>
                @endif
                </div>  
                <br>
                <h3>Mis Sucursales  <button type="button" style="float:right" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#myModal">Nueva Sucursal</button> </h3>
                <br>
                @if($Sucursales != null)

                    @foreach ($Sucursales as $sucursal)
                     
                    <div class="panel panel-primary">
                      <div class="panel-heading" >
                        <div class="row">
                            <div class="col-md-4">
                              <strong>
                             {{ $sucursal->nombre}} 
                            </strong> 
                            </div>
                           
                            <div class="col-md-8">
                               {!! Form::open(['route' => ['Sucursal.Eliminar', $sucursal->id], 'method' => 'POST']) !!}
                                <button class="btn btn-primary" style="float:right; background:  #2471a3 ">
                                  <i class="fa fa-remove icon-cerrar-ticket" ></i>
                                </button>
                               {!! Form::close() !!}
                                  <button data-toggle="modal" data-target="#myModalUP_{{$sucursal->id}}" class="btn btn-primary" style="float:right;background:#2471a3 ; margin-top:-14px">
                                    <i class="fa fa-edit icon-edit-ticket" ></i>
                                  </button>
                            </div>                          

                        </div>
                     </div>
                     <div class="modal fade" id="myModalUP_{{$sucursal->id}}" role="dialog">
                              <div class="modal-dialog">
                              
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Modificar sucursal</h4>
                                  </div>

                                  {!! Form::open(['route' => ['Update.Sucursal', $sucursal->id], 'method' => 'POST','validate','name'=>'myForm']) !!}
                                  <div class="modal-body">
                                      <div class="form-group">
                                          {!! Form::label('nombre', 'Nombre de Sucursal') !!}
                                          {!! Form::text('nombre', $sucursal->nombre, ['class' => 'form-control' , 'required' => 'required']) !!}
                                      </div>
                                      <div class="form-group">
                                          {!! Form::label('direccion', 'Dirección') !!}
                                          {!! Form::text('direccion',  $sucursal->direccion, ['class' => 'form-control' , 'required' => 'required']) !!}
                                      </div>
                                      <div class="form-group">
                                          {!! Form::label('descripcion', 'Descripcion') !!}
                                          {!! Form::text('descripcion',  $sucursal->descripcion, ['class' => 'form-control' , 'required' => 'required']) !!}
                                      </div>
                                      <div class="form-group">
                                          {!! Form::label('url', 'Url Imagen') !!}
                                          {!! Form::text('imagen', $sucursal->imagen, ['class' => 'form-control' , 'required' => 'required']) !!}
                                      </div>
                                          <input type="hidden" name="idInstitucion" value="{{$Institucion->id}}">

                                  </div>
                                  <div class="modal-footer">
                                    <button  type="submit" value="Submit" class="btn btn-success">Modificar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                  </div>
                                  {!! Form::close() !!}
                                </div>
                              </div>
                            </div>
                      <div class="panel-body row" >
                        <div class="col-md-12">
                           
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-4 col-lg-4">
                              <div>
                               <img src="{{$sucursal->imagen}}" width="60%" >
                               <br>
                               <br>
                              </div>
                              <div style="font-size:13px">
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
                            </div>
                          </div>
                          
                          <div class="col-md-8 col-lg-8">
                              <h5>
                                <strong>
                                   Servicios 
                                  <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModalServ_{{$sucursal->id}}" style="float:right;">
                                    Nuevo servicio</i>
                                  </button>
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
                                      </div>
                                    {!! Form::close() !!}
                                        
                                      
                                    </div>
                                  </div>
                               </strong> 
                              </h5>

                              <br>
                              <h5>
                              <table class="table table-hover"  style="font-size:14px;color:#151515">
                                <thead>
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Acción</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @if($sucursal->getServicios($sucursal->id)!=null)
                                    @foreach ($sucursal->getServicios($sucursal->id) as $servicio)
                                      <tr>
                                        <td>{{$servicio->nombre}} </td>
                                        <td > 
                                          <div class="dropdown" >
                                            <button style="font-size:13px"class="btn btn-primary  btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Acciones  <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                              <li style="font-size:13px"><a href="#" data-toggle="modal" data-target="#myModalUPServicio_{{$servicio->id}}" >Editar</a></li>
                                              <li style="font-size:13px">
                                                <a href="#" data-toggle="modal" data-target="#EliminarServicio_{{$servicio->id}}" >Eliminar</a></li>
                                            </ul>
                                          </div> 
                                        </td>
                                        <div class="modal fade" id="myModalUPServicio_{{$servicio->id}}" role="dialog">
                                          <div class="modal-dialog">
                                          
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Modificar Servicio</h4>
                                              </div>
                                              {!! Form::open(['route' => ['Update.Servicio', $servicio->id], 'method' => 'POST','validate','name'=>'myForm']) !!}
                                              <div class="modal-body">
                                                  <div class="form-group">
                                                      {!! Form::label('nombre', 'Nombre') !!}
                                                      {!! Form::text('nombre', $servicio->nombre, ['class' => 'form-control' , 'required' => 'required']) !!}
                                                  </div>
                                                  <div class="form-group">
                                                      {!! Form::label('descripcion', 'Descripción') !!}
                                                      {!! Form::text('descripcion', $servicio->descripcion, ['class' => 'form-control' , 'required' => 'required']) !!}
                                                  </div>
                                                  <div class="form-group">
                                                      {!! Form::label('horario', 'Horario') !!}
                                                      {!! Form::text('horario', $servicio->horario, ['class' => 'form-control' , 'required' => 'required']) !!}
                                                  </div>
                                                  <div class="form-group">
                                                      {!! Form::label('letra', 'Letra') !!}
                                                      {!! Form::text('letra', $servicio->letra, ['class' => 'form-control' , 'required' => 'required']) !!}
                                                  </div>
                                                      <input type="hidden" name="idSucursal" value="{{$sucursal->id}}">
                                              </div>
                                              <div class="modal-footer">
                                                <button  type="submit" value="Submit" class="btn btn-success">Modificar</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                              </div>
                                              {!! Form::close() !!}

                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal fade" id="EliminarServicio_{{$servicio->id}}" role="dialog">
                                          <div class="modal-dialog">
                                          
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Eliminar Servicio </h4>
                                              </div>
                                              {!! Form::open(['route' => ['Servicio.Eliminar', $servicio->id], 'method' => 'POST']) !!}
                                              <div class="modal-body">
                                                 @if($servicio->getCubiculo($servicio->id) > 0 || $servicio->getOperario($servicio->id) > 0)
                                                 
                                                    No se puede eliminar este servicio, existen operarios o cubiculos asociados.
                                                
                                                 @else
                                                 
                                                     ¿Decea eliminar este servicio?
                                                  
                                                  @endif

                                                
                                              </div>
                                              <div class="modal-footer">
                                                 @if($servicio->getCubiculo($servicio->id) > 0 || $servicio->getOperario($servicio->id) > 0)
                                                  @else
                                                    <button  type="submit" value="Submit" class="btn btn-success">Eliminar</button>
                                                  @endif
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                              </div>
                                             {!! Form::close() !!}
                                            </div>
                                          </div>
                                        </div>

                                      </tr>
                                    @endforeach
                                  @endif
                                </tbody>
                              </table>
                              </h5>
                              
                         
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    @endforeach
                @else
                  <h5>-- No hay Sucursales --</h5>

                @endif

                  
              </div>

              <div id="panel3" class="tab-pane fade">
                
              </div>
             
          </div>
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

