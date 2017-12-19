    <div>

        @php
            $user_type = '';
            if (Auth::user()!=NULL)
                $user_type = App\Constantes::Textual(Auth::user()->tipo);
        @endphp

        <nav class="navbar navbar-default" style="background: white;">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="/"><i class="fa fa-ticket"></i> Ticketter<span style="font-weight: normal">{{ $user_type }}</span></a>
                @if(!Auth::guest())
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"
                    style="padding: 5px; border: none !important; padding-bottom: 2px;"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify" style="font-size: 25px; color: #1485ee;"></i></button>
                @endif                    
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav navbar-right">                
                    @if(Auth::user()!=NULL && Auth::user()->tipo==App\Constantes::Cliente())
                    <li role="presentation"><a href="/cliente/search"><i class="fa fa-search fa-fw navbar-menu-icon"></i>Buscador</a></li>
                    <li role="presentation"><a href="/cliente/tickets"><i class="fa fa-ticket fa-fw navbar-menu-icon"></i>Mis tickets <i id="iconoNotificacion" class="fa fa-info-circle fa-fw" style="display: none"></i></a></li>
                    <li role="presentation"><a href="/cliente/profile/"><i class="fa fa-user fa-fw navbar-menu-icon"></i>Mi cuenta</a></li>
                    @endif

                    @if(Auth::user()!=NULL && Auth::user()->tipo==App\Constantes::Manager())
                    <li role="presentation"><a href="/administrador/dashboard" style="color:rgb(102,102,102);"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active" role="presentation"><a href="/administrador/institucion" style="color:rgb(102,102,102);"><i class="fa fa-building"></i> Institución</a></li>
                    <li role="presentation"><a href="#" style="color:rgb(102,102,102);"><i class="fa fa-university"></i> Sucursales</a></li>
                    <li role="presentation"><a href="#" style="color:rgb(102,102,102);"><i class="fa fa-users"></i> Usuarios</a></li>
                    @endif

                    @if(Auth::user()!=NULL && Auth::user()->tipo==App\Constantes::Admin())
                    <li role="presentation" style="color:rgb(102,102,102);"><a href="/admin/dashboard" style="color: #1485ee;"><i class="fa fa-building"></i> Dashboard</a></li>
                        <li class="active" role="presentation"><a href="/admin/instituciones/lista" style="color: #1485ee;"><i class="fa fa-university"></i> Instituciones</a></li>
                        <li class="active" role="presentation"><a href="/admin/lista/clientes" style="color: #1485ee;"><i class="fa fa-users"></i> Usuarios</a></li>
                    @endif


                    @if(Auth::user()!=NULL)
                    <li role="presentation"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw navbar-menu-icon"></i>Desconectarse </a></li>
                    @endif
                    </ul>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </nav>
        <div class="container" id="aviso1TicketAtencion" style="display: none">
            <div class="alert alert-warning">
                <h4><strong>¡Atención, tu turno está cerca!</strong> Ingrese a la bandeja de tickets para revisar el servicio al cuál acudir, y así llegar con tiempo.</h4>
            </div>
        </div>
        <div class="container" id="aviso2TicketAtencion" style="display: none">
            <div class="alert alert-danger">
                <h4><strong>¡Atención, es tu turno!</strong> Ingrese a la bandeja de tickets para revisar el servicio al cuál acudir.</h4>
            </div>
        </div>

                        <script type="text/javascript">
                            function ajax(){
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="_tokenNotify"]').attr('content')
                                    }
                                });
                                $.ajax({
                                        type:"POST",
                                        url:"/cliente/notificarCercanos",
                                        data:"",
                                        success: function(msg){
                                            if(msg=='NOTIFIED')
                                            {
                                                document.getElementById("iconoNotificacion").style.display = "inline";
                                                document.getElementById("iconoNotificacion").style.color = "red";
                                                document.getElementById("aviso1TicketAtencion").style.display = "block";
                                                document.getElementById("aviso2TicketAtencion").style.display = "none";
                                            }
                                            else if(msg=='YOUTURN')
                                            {
                                                document.getElementById("iconoNotificacion").style.display = "inline";
                                                document.getElementById("iconoNotificacion").style.color = "red";
                                                document.getElementById("aviso1TicketAtencion").style.display = "none";
                                                document.getElementById("aviso2TicketAtencion").style.display = "block";
                                            }
                                            else
                                            {
                                                document.getElementById("iconoNotificacion").style.display = "none";
                                                document.getElementById("aviso1TicketAtencion").style.display = "none";
                                                document.getElementById("aviso2TicketAtencion").style.display = "none";
                                            }
                                        }
                                    }); 
                            }
                            setInterval(ajax,1000);
                        </script>
    </div>
    <meta name="_tokenNotify" content="{!! csrf_token() !!}" />