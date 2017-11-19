<?php
/*
 * Almacena las constantes para las distintas areas de la aplicacion
 */
return [
	'cuenta' => [
		'cliente' => '10',
		'operario' => '20',
		'manager' => '30',
		'admin' => '40',
		'10' => 'Cliente',
		'20' => 'Operario',
		'30' => 'Manager',
		'40' => 'Administrador'
	],
	'misc' => [
		'no_especificcado' => 'No especificado'
	]
];

/*
 * Modo de acceso: Config::get('cons.cuenta.cliente');
 * Update  de constantes: php artisan config:cache
 */

?>