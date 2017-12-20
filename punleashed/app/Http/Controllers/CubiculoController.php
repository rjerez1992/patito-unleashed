<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institucion;
use App\Manager;
use App\Cuenta;
use App\Sucursal;
use App\Cliente;
use App\Operario;
use App\Cubiculo;


class CubiculoController extends Controller
{
    public function Insertar(Request $request, $id){

        $user=\Auth::user();

        $cubiculo= new Cubiculo;
        $cubiculo->nombre= $request->nombre;
        $cubiculo->numero_atencion= $request->numero_atencion;
        $cubiculo->disponibilidad= $request->disponibilidad;
        $cubiculo->servicio_id= $request->servicio_id;
        $cubiculo->save();
     	

     	$cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();
        $operarios=Operario::get();
        $cubiculos=Cubiculo::get();

        
    	return redirect('manager/Sucursales')->with('user', $user)->with('cliente', $cliente)
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('operarios', $operarios)   
                                 ->with('cubiculos', $cubiculos)   
                                 ->with('Institucion', $Institucion);    
    }

}
