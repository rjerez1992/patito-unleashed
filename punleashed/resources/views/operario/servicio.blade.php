<h1>MAIN OPERARIO!"</h1>

 @include('layouts.main-nav')


 @php

$cuenta = Auth::user();
$operario = $cuenta->usuario;
//Siempre es necesario verificar que no sea nulo (por seguridad)
if ($operario){
	echo $operario->nombre;
}

@endphp