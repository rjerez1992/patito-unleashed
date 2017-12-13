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
                    <li role="presentation"><a href="#"><i class="fa fa-plus fa-fw navbar-menu-icon"></i>Obtener ticket</a></li>
                    <li role="presentation"><a href="/cliente/tickets"><i class="fa fa-ticket fa-fw navbar-menu-icon"></i>Mis tickets</a></li>
                    <li role="presentation"><a href="/cliente/profile"><i class="fa fa-user fa-fw navbar-menu-icon"></i>Mi cuenta</a></li>
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

                    @if(Auth::user()!=NULL && Auth::user()->tipo==App\Constantes::Operario())
                    <li role="presentation" style="color:rgb(102,102,102);"><a href="#" style="color: #1485ee;"><i class="fa fa-building"></i> Atención</a></li>
                    <!--<li class="active" role="presentation"><a href="#" style="color: #1485ee;"><i class="fa fa-university"></i> Historial</a></li>-->
                    <li class="active" role="presentation"><a href="/operario/perfil" style="color: #1485ee;"><i class="fa fa-users"></i> Perfil</a></li>
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
    </div>