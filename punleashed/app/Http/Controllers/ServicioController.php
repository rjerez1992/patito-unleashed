<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use App\Cliente;
use App\Sucursal;
use App\Institucion;
use App\Servicio;
use App\Manager;

class ServicioController extends Controller
{    
	 public function Insertar(Request $request, $id){

        $user=\Auth::user();

    	$Servicio= new Servicio;
    	$Servicio->nombre = $request->nombre;
    	$Servicio->descripcion = $request->descripcion;
    	$Servicio->letra = $request->letra;
    	$Servicio->horario = $request->horario;
    	$Servicio->tiempo_espera = 0;
    	$Servicio->numero_actual = 0;
    	$Servicio->numero_disponible = 0;
    	$Servicio->sucursal_id = $id;
    	$Servicio->save();
    	
     	$cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();

        
    	return back();   
    }


    public function Delete($id){
    	
    	$Servicio=Servicio::where('id', $id)->first();
        $Servicio->delete(); 
        
        
        $user=\Auth::user();
    	$cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();

        
    	return redirect('manager/dashboard')->with('user', $user)->with('cliente', $cliente)
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion);  
    }
    public function Update(Request $request , $id){
    	$user=\Auth::user();
    	$Servicio=Servicio::where('id', $id)->first();
    	$Servicio->nombre = $request->nombre;
    	$Servicio->descripcion = $request->descripcion;
    	$Servicio->letra = $request->letra;
    	$Servicio->horario = $request->horario;
    	$Servicio->save();
    	
     	$cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();

        
    	return redirect('manager/dashboard')->with('user', $user)->with('cliente', $cliente)
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion);
    }
}
