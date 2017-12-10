@extends('layouts.main')

@section('styles')

@endsection

@section('scripts')
@endsection

@section('content')
   
    @include('layouts.main-nav')

    <div class="container">
        <ol class="breadcrumb">
            <li><a><span>Inicio </span></a></li>
            <li><span>Buscador </span></li>
        </ol>
        <div class="row row-title">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h3 class="text-left"> <i class="fa fa-search"></i> Buscador </h3></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="input-group">
                    <input class="form-control" type="search" name="search" placeholder="Ingrese valores a buscar..." id="search-input">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit"> <i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="ticket-heading-number"><i class="fa fa-list-alt fa-fw icon-ticket-list"></i> <strong>Resultados de Búsqueda</strong></h4></div>
            <div class="panel-body">
                <div class="row visible-xs-block visible-sm-block visible-md-block visible-lg-block row-eq-height">
                    
                    @if($sucursales->isEmpty())
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <p>No se han encontrado resultados. Intente con otros datos.</p>
                            </div>
                        </div>
                    @else
                        @foreach ($sucursales as $sucursal)
                        <div class="col-md-4 col-sm-6 col-xs-12 column-less-padding">
                            <div class="panel panel-default">
                                <div class="panel-body body-info-ticket">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 col-xs-3"><img class="img-circle" src="{{$sucursal->imagen}}" width="60" height="60"></div>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12"><strong>{{$sucursal->nombre}}</strong></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$sucursal->direccion}}</span></div>
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
    </div>
</body>

</html>