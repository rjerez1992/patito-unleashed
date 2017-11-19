<h1>CLIENTE!</h1>

@include('layouts.main-nav')

@php

$cuenta = Auth::user();
$cliente = $cuenta->usuario;
//Siempre es necesario verificar que no sea nulo (por seguridad)
if ($cliente){
	echo $cliente->nombre;
}

@endphp
