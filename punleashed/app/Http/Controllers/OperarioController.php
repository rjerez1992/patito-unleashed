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
    	//Buscamos el operario
    	$cuenta = Auth::user();
    	$usuario = $cuenta->usuario;

        //Redirecciona en caso que el usuario tenga un cubiculo activo
        if($usuario->cubiculo != NULL){
            return redirect("/operario/atencion/".$usuario->cubiculo->id);
        }

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

    public function editar(){
        $data = array(
                'usuario' => Auth::user()->usuario,
                'cuenta' => Auth::user(),
            );

        return view('operario/editar-perfil')->with($data);        
    }

    //Esta es para el post del edit
    public function editarPerfil(Request $request){
        $cuenta = Auth::user();
        $usuario = $cuenta->usuario;
        if ($usuario==NULL){abort(404);}

        //Valida las entradas
        $this->validate($request, [              
            'name' => 'required|string|max:255',    
            'rut' => 'required|numeric', 
        ]); 
        $usuario->nombre = $request->name;
        $usuario->rut = $request->rut; 

        if ($request->password != ""){
           $this->validate($request, [              
                'password' => 'string|min:6|confirmed',
            ]); 
            $cuenta->password = bcrypt($request->password);
            $cuenta->save();
        }
      
        if ($request->image != ""){
            $originalName = $request->image->getClientOriginalName();
            $ext = pathinfo($originalName, PATHINFO_EXTENSION);
            $imageName = $cuenta->username.".".$ext;
            $request->image->move(public_path('/assets/img'), $imageName);
            $usuario->imagen = $imageName;
        }

        $usuario->save();
      
        //Entrega un mensaje de vuelta
        Session::flash('msg', Constantes::Mensaje('cuenta_editada_exito'));
        Session::flash('status-ok', true);
        return back();
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
        $cuentaOperario = Auth::user();
        $operario = $cuentaOperario->usuario;
     
        $cuentaUsuario = NULL;
        $usuario = NULL;
        $cubiculo = Cubiculo::findOrFail($id); 

        //Revisamos si el usuario ya tiene asignado este cubiculo, sino lo asignamos
        if ($operario->cubiculo != NULL){
            $cubiculo = $operario->cubiculo;
            if($cubiculo->id != $id){abort(404);} 

            //En el caso que el cubiculo ya esté abierto y asignado  
            if ($cubiculo->numero_atencion > 0){
                //Buscamos el cliente que tenga ese numero de ticket
                $ticket = Ticket::where('numero', $cubiculo->numero_atencion)
                ->where('servicio_id', $cubiculo->servicio_id)->get()->first();

                $usuario = $ticket->cliente;
                $cuentaUsuario = $usuario->cuenta;
            }                
        }

        else{           
            //En el caso que se deba asignar y abrir el cubiculo                
            if ($cubiculo->disponibilidad == Constantes::CubiculoOcupado()){abort(404);} 

            $operario->servicio;
            $operario->cuenta;
            $operario->cubiculo_id = $cubiculo->id;
            $operario->save();

            //Refresca la relacion
            $operario = $operario->fresh();                

            //Lo marcamos como ocupado            
            $cubiculo->disponibilidad = Constantes::CubiculoOcupado();

            //Revisamos si el servicio estaba cerrado
            $servicio = $cubiculo->servicio;
            if ($servicio->numero_disponible <= 0){
                //Iniciamos el servicio
                $servicio->numero_actual = 0;
                $servicio->numero_disponible = 1;   
                $servicio->save();         
            }

            $cubiculo->numero_atencion = 0;
            $cubiculo->save();
        }   
   
        //Entregamos la vista con los datos necesarios
        $data = array(
                "usuario" => $usuario,
                "cuentaUsuario" => $cuentaUsuario,
                "operario" => $operario,
                "cuentaOperario" => $cuentaOperario,
                "cubiculo" => $cubiculo,
            );

        return view('operario/atencion')->with($data);        
    }

    public function cerrarCubiculo(Request $request){
        $cuenta = Auth::user();
        $usuario = $cuenta->usuario;
        $cubiculo = $usuario->cubiculo;

        //Desliga el cubiculo del usuario
        $usuario->cubiculo_id = NULL;
        $usuario->save();

        //Cierra el cubiculo
        $cubiculo->disponibilidad = Constantes::CubiculoVacio();
        $cubiculo->numero_atencion = -1;
        $cubiculo->save();

        //Verifica si quedan mas cubiculos abierto para el servicio
        $servicio = $cubiculo->servicio;
        if (count($servicio->cubiculos->where('disponibilidad', 
            Constantes::CubiculoOcupado())->all()) <= 0){
            //Cierra el servicio
            $servicio->numero_actual = -1;
            $servicio->numero_disponible = -1;
            $servicio->save();

            //Cancela todos los tickets activos para este servicio
            $tickets = $servicio->tickets;
            foreach($tickets as $ticket){
                if ($ticket->estado == Constantes::NuevoTicket()){
                    $ticket->estado = Constantes::TicketAutocancelado();
                    $ticket->numero = -1;
                    $ticket->save();
                }                
            }
        }        

        return redirect("/operario/servicio");
    }

    public function Calificar(Request $request, $value){    
        //Buscamos el ticket
        $cubiculo = Cubiculo::findOrFail($request->cubiculoId);

        $ticket = Ticket::where('numero', $cubiculo->numero_atencion)
        ->where('servicio_id', $cubiculo->servicio_id)->get()->first();

        if($value == 1){
            $ticket->estado = Constantes::TicketAtendido();
        }
        else{
            $ticket->estado = Constantes::TicketInasistente();
        }

        $ticket->save();

        $cubiculo->numero_atencion = 0; //En espera de un nuevo cliente 
        $cubiculo->save();

        return back();
    }

    public function siguiente(){
        //Buscamos el proximo ticket        
        $existe = false;             
     
        //Transaccion para evitar errores
        \DB::transaction(function() {
            $cubiculo = Auth::user()->usuario->cubiculo;
            
            $ticket = Ticket::where('servicio_id', $cubiculo->servicio_id)
            ->where('estado', 'Pendiente')->orderBy('numero', 'asc')->get()->first();  

            if ($ticket != NULL){
                $ticket->estado = 'En curso';
                $ticket->save();
                $cubiculo->numero_atencion = $ticket->numero;
                $cubiculo->save();  
                $existe = true; 
            }
        });
        
        if(Auth::user()->usuario->cubiculo->numero_atencion <= 0){
            Session::flash('msg', 'No hay tickets en espera');
            Session::flash('status-ok', true);        
        }

        return back();        
    }

    //Funcion para el ajax (ajax for dummies eso si)
    public function ticketsActivos(){
        //Revisa si hay
        $ticket = Ticket::where('servicio_id', Auth::user()->usuario->cubiculo->servicio_id)
            ->where('estado', 'Pendiente')->get()->first();  

        if ($ticket != NULL){
            echo '1'; //hay
        }
        else{
            echo '0'; //nohay;
        }        
    }

    //Debug
    public function tickets(){
        /*$ticket = new Ticket;
        $ticket->fecha = Carbon::now()->toDateString();
        $ticket->hora = Carbon::now()->toTimeString();
        $ticket->numero = 15;
        $ticket->estado = Constantes::NuevoTicket();
        $ticket->servicio_id = Auth::user()->usuario->servicio->id;
        $ticket->cliente_id = 12;
        $ticket->save();*/

        //return $ticket;

        //Ticket::find(32)->delete();
        return Ticket::orderBy('numero', 'asc')->get();
    }
}
