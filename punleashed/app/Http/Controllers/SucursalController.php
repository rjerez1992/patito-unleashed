<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institucion;
use App\Manager;
use App\Cuenta;
use App\Sucursal;
use App\Cliente;

class SucursalController extends Controller
{
 
    
    public function Insertar(Request $request){

        $user=\Auth::user();

    	$Sucursal= new Sucursal;
    	$Sucursal->nombre = $request->nombre;
    	$Sucursal->imagen = $request->imagen;
    	$Sucursal->institucion_id = $request->idInstitucion;
    	$Sucursal->direccion = $request->direccion;
    	$Sucursal->descripcion = $request->descripcion;
    	$Sucursal->save();
    	
        $cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();

        
    	return redirect('manager/dashboard')->with('user', $user)->with('cliente', $cliente)
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion);    
    }


    public function Delete($id){
        $user=\Auth::user();
    	$Sucursal=Sucursal::where('id', $id)->first();
        $Sucursal->delete(); 
    	
    	$cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();

        
    	return redirect('manager/dashboard')->with('user', $user)->with('cliente', $cliente)
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion);    
    }
    public function Update(Request $request , $id){
        $user=\Auth::user();
    	$Sucursal=Sucursal::find($id);
    	$Sucursal->nombre = $request->nombre;
        $Sucursal->imagen = $request->imagen;
        $Sucursal->institucion_id = $request->idInstitucion;
        $Sucursal->direccion = $request->direccion;
        $Sucursal->descripcion = $request->descripcion;
        $Sucursal->save();
        
        $cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();

        
    	return redirect('manager/dashboard')->with('user', $user)->with('cliente', $cliente)
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion);    
    }
    

}
