<?php

use App\Cliente;
use App\Manager;
use App\Operario;
use App\Admin;
use App\Cuenta;
use App\Constantes;
use App\Institucion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Cliente       
        $cuenta = Cuenta::firstOrCreate([
            'username' => 'cliente',
            'email' => 'cliente@cliente.com',
            'tipo' => Constantes::Cliente(), 
            'password' => bcrypt('cliente'),
        ]);
        Cliente::firstOrCreate([
        	'nombre' => 'cliente',
        	'rut' => '32165498',
        	'cuenta_id' => $cuenta->id,
    	]);

    	//Operario       
        $cuenta = Cuenta::firstOrCreate([
            'username' => 'operario',
            'email' => 'operario@operario.com',
            'tipo' => Constantes::Operario(), 
            'password' => bcrypt('operario'),
        ]);
        Operario::firstOrCreate([        	
        	'rut' => '15975385',
        	'cuenta_id' => $cuenta->id,
        	'cubiculo_id' => NULL,
        	'servicio_id' => NULL,
    	]);

    	//Manager   
    	$institucion = Institucion::firstOrCreate([
    		'run' => '12323445',
    		'nombre' => 'institucion',
    		'descripcion' => 'descripcion',
    		'imagen' => Constantes::ImagenDefecto(),
		]);    
        $cuenta = Cuenta::firstOrCreate([
            'username' => 'manager',
            'email' => 'manager@manager.com',
            'tipo' => Constantes::Manager(), 
            'password' => bcrypt('manager'),
        ]);
        Manager::firstOrCreate([        	
        	'rut' => '987456321',
        	'nombre' => 'manager',
        	'institucion_id' => $institucion->id,
        	'cuenta_id' => $cuenta->id,  
    	]);

    	//Admin
    	$cuenta = Cuenta::firstOrCreate([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'tipo' => Constantes::Admin(), 
            'password' => bcrypt('admin'),
        ]);
        Admin::firstOrCreate([          
        	'nombre' => 'admin',        	
        	'cuenta_id' => $cuenta->id,  
    	]);        
    }
}
