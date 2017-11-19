<h1>MAIN ADMIN!</h1>

 @include('layouts.main-nav')

 @php

$cuenta = Auth::user();
$admin = $cuenta->usuario;
//Siempre es necesario verificar que no sea nulo (por seguridad)
if ($admin){
	echo $admin->nombre;
}

@endphp