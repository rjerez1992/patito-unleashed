<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Cliente;
use App\Constantes;
use App\Cubiculo;
use App\Cuenta;
use App\Institucion;
use App\Manager;
use App\Operario;
use App\Servicio;
use App\Sucursal;
use App\Ticket;
use Session;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperarioController extends Controller
{
    public function servicio(){
        //TODOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
        //Si estoy atendiendo un cubiculo, tirarme a la pantalla de atencion
        //no a seleccionar cubiculo

    	//Buscamos el operario
    	$cuenta = Auth::user();
    	$usuario = $cuenta->usuario;

    	//Obtenemos el servicio del usuario
    	$servicio = $usuario->servicio;  
    	$imagen = $servicio->sucursal->imagen; 

    	//Si no tiene servicio asignado
    	if ($servicio == NULL){
    		return abort(404);
    	}

    	$data = array(
    			'cuenta' => $cuenta,
    			'usuario' => $usuario,
    			'servicio' => $servicio,
    			'imagen' => $imagen,
    		);    		   	

    	return view('operario/servicio')->with($data);
    }

    public function perfil(){
        //Buscamos el operario
        $cuenta = Auth::user();
        $usuario = $cuenta->usuario;
        $servicio = $usuario->servicio;

        //Si no tiene servicio asignado
        if ($servicio == NULL){
            return abort(404);
        }

        //Obtenemos el servicio del usuario          
        $sucursal = $servicio->sucursal;
        $institucion = $servicio->institucion; 

        $data = array(
                'cuenta' => $cuenta,
                'usuario' => $usuario,
                'servicio' => $servicio,
                'sucursal' => $sucursal,
                'institucion' => $institucion,
            );              

        return view('operario/perfil')->with($data);
    }

    public function datosServicio(){                
        //Buscamos el operario
        $cuenta = Auth::user();
        $usuario = $cuenta->usuario;

        //Obtenemos el servicio del usuario
        $servicio = $usuario->servicio;  
        $imagen = $servicio->sucursal->imagen; 

        //Si no tiene servicio asignado
        if ($servicio == NULL){
            return abort(404);
        }

        $data = array(
                'cuenta' => $cuenta,
                'usuario' => $usuario,
                'servicio' => $servicio,
                'imagen' => $imagen,
            );                    

        return view('operario/datos-servicio')->with($data);
    }

    public function atencion($id){
        return view('operario/atencion');        
    }
}
