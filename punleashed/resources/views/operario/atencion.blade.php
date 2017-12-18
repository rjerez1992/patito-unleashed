@extends('layouts.main')

@section('styles')
@endsection

@section('scripts')
@endsection

@php
@endphp

@section('content')

    @include('layouts.main-nav')

    <!-- TODO: Mover la imagen hacia arriba y colocar al lado el heading con la informacion. (En columnas separadas) -->  
    <div class="container">
        <h1>Cubiculo<button class="btn btn-danger pull-right" type="button"><i class="fa fa-close"></i> <span class="hidden-xs">Cerrar el cubiculo</span></button></h1>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <h4> <i class="fa fa-suitcase"></i> Datos de atención</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <h4 style="margin-top: 20px;"> <i class="fa fa-user"></i> Datos del cliente</h4>
        <hr style="margin: 0px; margin-bottom: 15px;">
        <h4> <i class="fa fa-gears"></i> Operaciones</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-toolbar">
                    <div class="btn-group" role="group"></div>
                    <div class="btn-group" role="group"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><button class="btn btn-info btn-block" type="button" style="margin-top: 20px;"><i class="fa fa-bullhorn"></i> Llamar siguiente cliente</button></div>
        </div>
        <div class="row">
            <div class="col-md-12"><button class="btn btn-link btn-block" type="button" style="margin-top: 5px; margin-bottom: 40px;"><i class="fa fa-pencil"></i> Calificar cliente actual</button></div>
        </div>
    </div>
@endsection