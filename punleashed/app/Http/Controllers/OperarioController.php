<?php

namespace App\Http\Controllers;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Institucion;
use App\Manager;
use App\Cuenta;
use App\Sucursal;
use App\Cliente;
use App\Operario;
use App\Servicio;
use App\Cubiculo;


class OperarioController extends Controller
{
    public function servicio(){
        return view('operario/servicio');
    }

    public function Insertar(Request $request, $id){

        $user=\Auth::user();

        //Crea la cuenta        
        $cuenta = new Cuenta;
        $cuenta->username = $request->username;
        $cuenta->email = $request->email;
        $cuenta->tipo = 5;
        $cuenta->password = bcrypt($request->password);
        $cuenta->save();
       
       //obtenemos el campo file definido en el formulario
       $file = $request->file('file');
       //obtenemos el nombre del archivo
        $nombre = date('Y-m-d-H:i:s')."-".$file->getClientOriginalName();
    	$file_route= time().'_'.$file->getClientOriginalName();
        Storage::disk('storage')->put($file_route,file_get_contents($file->getRealPath()));

        $operario= new Operario;
    	$operario->nombre = $request->nombre;
    	$operario->rut = $request->rut;
    	$operario->imagen =$file_route;
    	$operario->cuenta_id = $cuenta->id;
    	$operario->servicio_id = $request->servicio;
    	$operario->save();

     	$cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();
        $operarios=Operario::get();
        $cubiculos=Cubiculo::get();

        
    	return back(); 
    }
    public function Insertar2(Request $request, $id){

        $user=\Auth::user();

        //Crea la cuenta        
        $cuenta = new Cuenta;
        $cuenta->username = $request->username;
        $cuenta->email = $request->email;
        $cuenta->tipo = 5;
        if ( $cuenta->password !="") {
            $cuenta->password = bcrypt($request->password);
        }
        $cuenta->save();
       
       //obtenemos el campo file definido en el formulario
       $file = $request->file('file');
       //obtenemos el nombre del archivo
        $nombre = date('Y-m-d-H:i:s')."-".$file->getClientOriginalName();
        $file_route= time().'_'.$file->getClientOriginalName();
        Storage::disk('storage')->put($file_route,file_get_contents($file->getRealPath()));

        $operario= new Operario;
        $operario->nombre = $request->nombre;
        $operario->rut = $request->rut;
        $operario->imagen =$file_route;
        $operario->cuenta_id = $cuenta->id;
        $operario->servicio_id = $request->servicio;
        $operario->save();

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
        
        return back();  
    }
    public function AgregarCubiculo(Request $request, $id){
        $operario=Operario::find($id);
        $operario->cubiculo_id = $request->cubiculo;
        $operario->save();

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


    public function Delete($id){
    	
    	$Operario=Operario::where('id', $id)->first();
        $Operario->delete(); 
        
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
        
        return back();
    }
    public function Update(Request $request , $id){
    	$user=\Auth::user();

        //Crea la cuenta        
        $cuenta = Cuenta::find($request->idS);
        $cuenta->username = $request->username;
        $cuenta->tipo = 5;
        $cuenta->password = bcrypt($request->password);
        $cuenta->save();
       
       //obtenemos el campo file definido en el formulario
       $file = $request->file('file');
       //obtenemos el nombre del archivo
        $nombre = date('Y-m-d-H:i:s')."-".$file->getClientOriginalName();
        $file_route= time().'_'.$file->getClientOriginalName();
        Storage::disk('storage')->put($file_route,file_get_contents($file->getRealPath()));

        $operario=Operario::find($id);
        $operario->nombre = $request->nombre;
        $operario->rut = $request->rut;
        $operario->imagen =$file_route;
        $operario->servicio_id = $request->servicio2;
        $operario->save();

     	$cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::find($cliente->institucion_id);
        $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();
        $operarios=Operario::get();
        $cubiculos=Cubiculo::get();

        
    	return back();
    }

    public function servicios(Request $request)
    { 
            $Servicios=Servicio::where('sucursal_id','=',$request->id)->get(); 
            return response()->json($Servicios);
    }

}
