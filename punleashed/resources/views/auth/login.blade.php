@extends('layouts.main')

@section('content')

    @include('layouts.main-nav')

    <div class="container">
        <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-sign-in"></i> Ingresar</h3></div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username">Usuario</label>
                        <input class="form-control" type="text" placeholder="Ejemplo: Alberto89" name="username" id="username" value="{{ old('username') }}" autofocus>
                        @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="margin-top-10">Contraseña </label>
                        <input class="form-control" type="password" placeholder="Ejemplo: 12345689" id="password" name="password">
                        @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        </div>
                        
                        <div class="form-group">
                        <div class="checkbox">
                            <label class="pull-right">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Recordar datos</label>
                        </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-info" type="submit">Ingresar </button>
                        </div>
                    </form>
                </div>
                <div class="panel-footer"></div>
            </div><a href="/registro" class="pull-right">¿No tienes una cuenta? Crea una aquí</a>
            <!-- Despues vemos el tema del recuperar contraseña
            <a href="{{ route('password.request') }}" class="pull-right">¿Olvidaste tu contraseña? Entra aquí</a></div> -->
    </div>
@endsection