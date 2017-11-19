<h1>MAIN MANAGER</h1>

 @include('layouts.main-nav')

 @php

$cuenta = Auth::user();
$manager = $cuenta->usuario;
//Siempre es necesario verificar que no sea nulo (por seguridad)
if ($manager){
	echo $manager->nombre;
}

@endphp