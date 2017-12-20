<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manager;
use App\Institucion;
use App\Sucursal;
use App\Operario;
use App\Cubiculo;

class ManagerController extends Controller
{
    public function dashboard(){

        $user=\Auth::user();

    	$cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);

        if ($Institucion!=null) {
       		$Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();
        }
        else{
        	$Sucursales=null;
        }

        
    	return view('manager/dashboard')->with('user', $user)->with('cliente', $cliente)
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion); 
    }
    public function Sucursales(){

        $user=\Auth::user();

        $cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);

        if ($Institucion!=null) {
            $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();
        }
        else{
            $Sucursales=null;
        }

        $operarios=Operario::get();
        $cubiculos=Cubiculo::get();
        
        return view('manager/Sucursales')->with('user', $user)->with('cliente', $cliente)
                                 ->with('operarios', $operarios)   
                                 ->with('cubiculos', $cubiculos)   
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion); 
    }

    public function Usuarios(){

        $user=\Auth::user();

        $cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);

        if ($Institucion!=null) {
            $MisSucursales=Sucursal::where('institucion_id', $Institucion->id)->get();
            $Sucursales=$MisSucursales->pluck('nombre','id'); 
        }
        else{
            $Sucursales=null;
        }

        $operarios=Operario::get();
        $cubiculos=Cubiculo::get();
        
        return view('manager/Usuarios')->with('user', $user)->with('cliente', $cliente)
                                 ->with('operarios', $operarios)   
                                 ->with('cubiculos', $cubiculos)   
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion); 
    }

    public function editarCliente(Request $request, $id)
    {
        $manager=Manager::find($id);
        $manager->nombre = $request->name;
        $manager->rut = $request->rut;
        $manager->save();

        $user=\Auth::user();

        $cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        if ($Institucion!=null) {
            $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();
        }
        else{
            $Sucursales=null;
        }
        return view('manager/dashboard')->with('user', $user)->with('cliente', $cliente)
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion); 
    }


}
