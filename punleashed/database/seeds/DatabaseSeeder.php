<?php

use App\Cliente;
use App\Manager;
use App\Operario;
use App\Admin;
use App\Cuenta;
use App\Constantes;
use App\Institucion;
use App\Sucursal;
use App\Servicio;
use App\Cubiculo;
use App\Ticket;
use Carbon\Carbon;
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
        $cantidad = 10;

        //Cliente       
        $c = 1;
        for($c; $c<=$cantidad; $c++){
            $cuenta = Cuenta::firstOrCreate([
                'username' => 'cliente'.$c,
                'email' => 'cliente'.$c.'@cliente.com',
                'tipo' => Constantes::Cliente(), 
                'password' => bcrypt('cliente'.$c),
            ]);
            Cliente::firstOrCreate([
                'nombre' => 'Cliente '.$c,
                'rut' => '3216549'.$c,
                'cuenta_id' => $cuenta->id,
            ]);
        }    
        $cuenta = Cuenta::create([
            'username' => 'patito',
            'email' => 'patito@holamundo.com',
            'tipo' => Constantes::Cliente(), 
            'password' => bcrypt('1234567890'),
        ]);
        Cliente::create([
            'nombre' => 'Patricio Castro Rojas',
            'rut' => '123456785',
            'direccion' => '5 1/2 oriente #3056, Talca, Chile',
            'imagen' => 'https://www.ibertronica.es/blog/wp-content/uploads/2016/02/perfil-azul.png',
            'cuenta_id' => $cuenta->id,
        ]);
    
    	//Manager e institucion
        for($c=1; $c<=$cantidad; $c++){   
        	$institucion = Institucion::firstOrCreate([
        		'run' => '12323445'.$c,
        		'nombre' => 'Institucion '.$c,
        		'descripcion' => 'descripcion'.$c,
        		'imagen' => Constantes::ImagenDefecto(),
    		]);

            //3 Sucursales  por cada institucion
            $d = 1;
            for($d; $d<=3; $d++){
                $sucursal = Sucursal::firstOrCreate([
                    'nombre' => 'Sucursal '.$d.' '.$institucion->nombre,
                    'institucion_id' => $institucion->id,
                ]);

                //2 Servicios por cada sucursal
                $e = 1;
                for ($e=1; $e <= 2; $e++) { 
                    $servicio = Servicio::firstOrCreate([
                        'nombre' => 'Servicio '.$e.' '.$sucursal->nombre,
                        'tiempo_espera' => '00:00:00',
                        'numero_actual' => '-1',
                        'numero_disponible' => '-1',
                        'sucursal_id' => $sucursal->id,
                    ]);

                    //2 cubiculos por cada servicio
                    $f = 1;
                    for ($f; $f <= 2 ; $f++) { 
                        Cubiculo::firstOrCreate([
                            'nombre' => 'Cubiculo '.$f.' '.$servicio->nombre,
                            'numero_atencion' => '-1',
                            'servicio_id' => $servicio->id,
                        ]);
                    }
                }    
            }

            $cuenta = Cuenta::firstOrCreate([
                'username' => 'manager'.$c,
                'email' => 'manager'.$c.'@manager.com',
                'tipo' => Constantes::Manager(), 
                'password' => bcrypt('manager'.$c),
            ]);
            Manager::firstOrCreate([        	
            	'rut' => '98745632'.$c,
            	'nombre' => 'Manager '.$c,
            	'institucion_id' => $institucion->id,
            	'cuenta_id' => $cuenta->id,  
        	]);
        }

        //Operario
        for($c=1; $c<=$cantidad*5; $c++){       
            $cuenta = Cuenta::firstOrCreate([
                'username' => 'operario'.$c,
                'email' => 'operario'.$c.'@operario.com',
                'tipo' => Constantes::Operario(), 
                'password' => bcrypt('operario'.$c),
            ]);

            $servicio_random = Servicio::inRandomOrder()->first();
            $cubiculo_random = Cubiculo::where('servicio_id', $servicio_random->id)->inRandomOrder()->first();

            Operario::firstOrCreate([           
                'rut' => '1597538'.$c,
                'nombre' => 'Operario '.$c,
                'cuenta_id' => $cuenta->id,
                'cubiculo_id' => $cubiculo_random->id, 
                'servicio_id' => $servicio_random->id, 
            ]);
        }


    	//Admin
        for($c=1; $c<=$cantidad; $c++){   
        	$cuenta = Cuenta::firstOrCreate([
                'username' => 'admin'.$c,
                'email' => 'admin'.$c.'@admin.com',
                'tipo' => Constantes::Admin(), 
                'password' => bcrypt('admin'.$c),
            ]);
            Admin::firstOrCreate([          
            	'nombre' => 'Admin '.$c,        	
            	'cuenta_id' => $cuenta->id,  
        	]); 
        }       

        //Tickets
        for($c=1; $c<=$cantidad*3; $c++){
            Ticket::firstOrCreate([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'numero' => rand(),
                'estado' => Constantes::TicketCancelado(),
                'servicio_id' => Servicio::inRandomOrder()->first()->id,
                'cliente_id' => Cliente::inRandomOrder()->first()->id,
            ]);
        }
        

    }
}
