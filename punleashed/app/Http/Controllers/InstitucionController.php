<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institucion;
use App\Manager;
use App\Cuenta;
use App\Sucursal;

use App\Http\Requests\UserFormRequest;
use DateTime;
use App\Cliente;

class InstitucionController extends Controller
{
	protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string||max:255',
            'descripcion' => 'required|string|max:255',
        ]);
    }

    public function InsertForm(){
    	return \View::make('CrearInstitucion'); 
    }
    public function Insertar(Request $request){

        $user=\Auth::user();
        $cliente=Manager::where('cuenta_id', $user->id)->first();

    	$institucion= new Institucion;
    	$institucion->nombre = $request->nombre;
    	$institucion->descripcion = $request->descripcion;
    	$institucion->manager = $cliente->id;
    	$institucion->run = $request->run;
    	$institucion->save();
    	

        $Institucion=Institucion::where('manager', $cliente->id)->first();
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

    public function Delete($id){
        $user=\Auth::user();
        $Institucion=Institucion::findOrFail($id);
        $cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::where('manager', $cliente->id)->first();
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
    public function Update($id){
        $user=\Auth::user();

        $institucion=  Institucion::findOrFail($id);
        $institucion->nombre = $request->nombre;
    	$institucion->descripcion = $request->descripcion;
    	$institucion->manager = \Auth::user()->id;
    	$institucion->run = $request->run;
    	$institucion->save();
        
        $cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::where('manager', $cliente->id)->first();
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
