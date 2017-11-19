@extends('layouts.main')

@section('content')

    @include('layouts.main-nav')

    <div class="container">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user-plus"></i> Crear cuenta</h3></div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

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
                            <input id="name" class="form-control" type="text" placeholder="Ejemplo: Matias Guajardo" name="name" value="{{ old('name') }}" required autofocus>
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
                            <button class="btn btn-info margin-top-15" type="submit">Registrarse </button>
                        </div>
                    </form>
                </div>
                <div class="panel-footer"></div>
            </div>
        </div>
    </div>
@endsection