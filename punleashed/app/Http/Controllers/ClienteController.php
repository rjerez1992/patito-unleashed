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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ClienteController extends Controller
{
    public function profile($id=-1)
    {
        $cuenta=Auth::user();
        if($id==-1)
        {
            $sucursalesFrecuentes = DB::table('tickets')
                ->orderBy('tickets.created_at', 'DESC')
                ->join('servicios', 'tickets.servicio_id', '=', 'servicios.id')
                ->join('sucursals', 'servicios.sucursal_id', '=', 'sucursals.id')
                ->take(6)->get();

            $TicketsValidos=Ticket::where('cliente_id', '=', $cuenta->usuario->id)->where('estado', '=', Constantes::TicketAtendido())->count();
            $TicketsCancelados=Ticket::where('cliente_id', '=', $cuenta->usuario->id)->where('estado', '=', Constantes::TicketCancelado())->count();
            $TicketsInasistentes=Ticket::where('cliente_id', '=', $cuenta->usuario->id)->where('estado', '=', Constantes::TicketInasistente())->count();

            $reputacion=(5+($TicketsValidos/10)-($TicketsCancelados/20)-($TicketsInasistentes/5));
            if($reputacion<1)
            {
                $reputacion=1;
            }
            if($reputacion>5)
            {
                $reputacion=5;
            }
            $cuenta->usuario->max_tickets=$reputacion;
            $cuenta->usuario->save();

            $data = array(
                'cuenta' => $cuenta,
                'cliente' => $cuenta->usuario,
                'sucursalesFrecuentes' => $sucursalesFrecuentes,
                'reputacionCliente' => $reputacion,
            );
            return  view('cliente/user-profile')->with($data);
        }
        $cliente = Cliente::find($id);

        if ($cliente==NULL){
            return redirect('/');
        }

        $data = array(
                'cuenta' => $cuenta,
                'cliente' => $cliente,
                'sucursalesFrecuentes' => Sucursal::all()->take(6),
            );

        return  view('cliente/user-profile')->with($data);
    }

    public function search()
    {
        $busqueda = NULL;
        $instituciones = NULL;
        $sucursales = NULL;
        if(Input::has('search_input') && Input::get('search_input')!='')
        {
            $busqueda = Input::get('search_input');
            $instituciones = Institucion::where('nombre', 'like', '%'.$busqueda.'%')->get();
            $sucursales = Sucursal::where('nombre', 'like', '%'.$busqueda.'%')->get();
        }
        $data = array(
            'instituciones' => $instituciones,
            'sucursales' => $sucursales,
        );
        return view('cliente/search')->with($data);
    }

    public function institucion($id)
    {
        $institucion = Institucion::find($id);

        if ($institucion==NULL){
            return redirect('/');
        }

        $data = array(
                'institucion' => $institucion,
                'sucursales' =>$institucion->sucursales,
            );

        return  view('cliente/institucion-profile')->with($data);
    }

    public function sucursal($id)
    {
        $sucursal = Sucursal::find($id);

        if ($sucursal==NULL){
            return redirect('/');
        }

        $cuenta=NULL;
        if(Auth::user()!=NULL) //&& (Auth::user())->usuario->tipo==constantes::Cliente())
        {
            $cuenta=Auth::user();
        }
        $data = array(
                'institucion' => Institucion::find($sucursal->institucion_id),
                'sucursal' => $sucursal,
                'servicios' => $sucursal->servicios,
                'cuenta' => $cuenta,
            );

        return  view('cliente/sucursal-profile')->with($data);
    }

    public function tickets()
    {
        if (Auth::user()!=NULL)
        {
            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;
            $data = array(
                    'cliente' => $cliente,
                    'ticketsActivos' => Ticket::where('cliente_id', '=', $cliente->id)->where('estado', '=', Constantes::NuevoTicket())->get(),
                    'historialTickets' => Ticket::where('cliente_id', '=', $cliente->id)->where('estado', '!=', Constantes::NuevoTicket())->orderBy('created_at', 'DESC')->take(9)->get(),
                    'cuenta' => $cuenta,
                );
            return view('cliente/tickets-box')->with($data);
        }
        return redirect('/');

    }

    public function editarCliente()
    {
        if (Auth::user()!=NULL)
        {
            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;
            $data = array(
                    'cliente' => $cliente,
                    'cuenta' => $cuenta,
                );
            return view('cliente/cliente-edit')->with($data); 
        }
        return redirect('/');
    }

    public function editarPassCliente(request $request)
    {
        if (Auth::user()!=NULL)
        {
            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;
            $pass=$request->oldPass;
            $newPass=$request->newPass;
            $newPass2=$request->newPass2;
            $this->validate($request, [
                'oldPass' => 'nullable|string|min:6|confirmed',
                'newPass' => 'nullable|string|min:6|confirmed',
                'newPass2' => 'nullable|string|min:6|confirmed',
            ]);  

            $estado=false;
            $msg="Contraseña actual errónea o nueva contraseña no cumple requisitos.";
            if ($cuenta->password==($oldPass) && Hash::check($newPass, $newPass2))
            {
                $cuenta->password=bcrypt($newPass);
                $cuenta->save();
                $estado=true;
                $msg="Contraseña de la cuenta actualizada exitosamente.";
            }
            $data = array(
                    'cliente' => $cliente,
                    'cuenta' => $cuenta,
                    'status' => $estado,
                    'msg' => $msg,
                );
            return view('cliente/cliente-edit')->with($data); 
        }
        return redirect('/');
    }

    public function editarInfoCliente(request $request)
    {
        if (Auth::user()!=NULL)
        {
            $nombre=$request->nameCliente;
            $direccion=$request->direccionCliente;
            $imagen=$request->imageCliente;

            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;

            $cliente->nombre=$nombre;
            $cliente->direccion=$direccion;
            $cliente->imagen=$imagen;
            $cliente->save();

            $estado=true;
            $msg="Información básica del cliente actualizada exitosamente.";

            $data = array(
                    'cliente' => $cliente,
                    'cuenta' => $cuenta,
                    'status' => $estado,
                    'msg' => $msg,
                );
            return view('cliente/cliente-edit')->with($data); 
        }
        return redirect('/');
    }

    public function ticketsActivos()
    {
        $cuenta = Auth::user();
        $cliente = $cuenta->usuario;
        $tickets=Ticket::where('cliente_id', '=', $cliente->id)->where('estado', '=', Constantes::NuevoTicket())->get();
        if (count($tickets) > 0) {
            foreach($tickets as $ticket) {
               echo "<div class='col-md-4 col-sm-6 col-xs-12 column-less-padding'>
                        <div class='panel panel-info panel-info-ticket'>
                            <div class='panel-heading'>
                                <div class='row'>
                                    <div class='col-md-12 col-sm-12 col-xs-12'><i class='fa fa-ticket fa-fw'></i><strong class='text-uppercase'>{$ticket->servicio->letra}{$ticket->numero} </strong><strong>(<i class='fa fa-clock-o fa-fw'></i> </strong><strong>{$ticket->hora}</strong><strong class='no-padding'>) - En Espera</strong></div>
                                </div>
                            </div>
                            <div class='panel-body body-info-ticket'>
                                <div class='row'>
                                    <div class='col-md-3 col-sm-3 col-xs-3'><a href='/cliente/sucursal/{$ticket->servicio->sucursal->id}'><img class='img-circle' src='{$ticket->servicio->sucursal->imagen}' width='55' height='55'></a></div>
                                    <div class='col-md-9 col-sm-9 col-xs-9'>
                                        <div class='row'>
                                            <div class='col-md-12 col-sm-12 col-xs-12'><a href='/cliente/sucursal/{$ticket->servicio->sucursal->id}'><strong>{$ticket->servicio->sucursal->nombre}</strong></a></div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-md-12 col-sm-12 col-xs-12'><span>{$ticket->servicio->nombre}</span></div>
                                        </div>
                                        <div class='row'>";
                if($ticket->numero==$ticket->servicio->numero_actual)
                {
                    echo "<div class='col-md-12 col-sm-12 col-xs-12'><strong>Cubículo: </strong><strong>";
                    $found=0;
                    $cubiculos=$ticket->servicio->cubiculos;
                    foreach($cubiculos as $cubiculo)
                    {
                        if($cubiculo->numero_atencion==$ticket->numero)
                        {
                            echo $cubiculo;
                            $found=1;
                            break;   
                        }
                    }
                    if($found==0)
                    {
                        echo 'No Definido';
                    }
                    echo "</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class='panel-footer body-info-ticket'>
                                <p class='text-center' style='color: white;'><strong>Diríjase a su cubículo correspondiente.</strong></p>
                            </div>
                        </div>
                    </div>";
                }
                else
                {
                    $tiempoEstimado=new Carbon($ticket->servicio->tiempo_espera);
                    $rangoTicket=$ticket->numero-$ticket->servicio->numero_actual;
                    $horaProm=$tiempoEstimado->hour*3600;
                    $minProm=$tiempoEstimado->minute*60;
                    $segProm=$tiempoEstimado->second;
                    $tiempoEstimado=(int)((($horaProm+$minProm+$segProm)*$rangoTicket)/60);

                    echo "<div class='col-md-12 col-sm-12 col-xs-12'><strong>N° Actual: </strong><strong>{$ticket->servicio->letra}{$ticket->servicio->numero_actual}</strong></div>
                                            <div class='col-md-12 col-sm-12 col-xs-12'><span class='text-danger'>{$tiempoEstimado} </span><span class='text-danger'> minutos restantes</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class='panel-footer body-info-ticket'>
                                <button class='btn btn-primary btn-block' type='button' onclick='modalCancelarTicket({$ticket->id})'><i class='fa fa-remove fa-fw'></i> Cancelar Ticket</button>
                            </div>
                        </div>
                    </div>";
                }
            }
        } 
        else {
            echo "<div class='row'>
                        <div class='col-md-12 col-sm-12 col-xs-12 text-center'>
                            <p>No existen tickets activos. Intente solicitar un ticket en alguna sucursal.</p>
                        </div>
                    </div>";
        }
    }

    public function cancelarTicket($idTicket)
    {
        $cuenta = Auth::user();
        $cliente = $cuenta->usuario;
        $ticket = Ticket::where('id', '=', $idTicket)->update(['estado' => Constantes::TicketCancelado()]);
        return redirect('/cliente/tickets');
    }

    public function getTicket(request $request)
    {
        $idServicio=$request->idServicio;
        $idSucursal=$request->idSucursal;
        $sucursal=Sucursal::find($idSucursal);
        $servicioAux = Servicio::find($idServicio);
        $ticket=DB::transaction(function() use($idServicio){

            $ticket=NULL;
            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;

            $servicioAux = Servicio::find($idServicio);
            $cantTickets = Ticket::where('cliente_id','=',$cliente->id)->where('estado', '=', Constantes::NuevoTicket())->count();
            if($servicioAux->numero_disponible!=-1 && $cantTickets<$cliente->max_tickets)
            {
                Servicio::where('id', '=', $idServicio)->update(['numero_disponible' => ($servicioAux->numero_disponible + 1)]);

                $ticket = new Ticket;

                $ticket->fecha = Carbon::now()->toDateString();
                $ticket->hora = Carbon::now()->toTimeString();
                $ticket->numero = $servicioAux->numero_disponible;
                $ticket->servicio_id = $idServicio;
                $ticket->cliente_id = $cliente->id;

                $ticket->save();
            }
            return $ticket;
        });
        if($ticket!=NULL)//pasa
        {
            echo "<div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='modal-title'><i class='fa fa-ticket fa-fw'></i>Solicitud de Ticket</h4></div>
                    <div class='modal-body'>
                        <p>Acabas de solicitar un ticket al sistema, estos son los datos de tu ticket: </p>
                        <div class='panel panel-info panel-info-ticket'>
                            <div class='panel-heading'>
                                <div class='row'>
                                    <div class='col-md-12 col-sm-12 col-xs-12'><i class='fa fa-ticket fa-fw'></i><strong class='text-uppercase'>{$servicioAux->letra}{$ticket->numero} </strong><strong>(<i class='fa fa-clock-o fa-fw'></i> </strong><strong>{$ticket->hora} </strong><strong class='no-padding'>) </strong></div>
                                </div>
                            </div>
                            <div class='panel-body body-info-ticket'>
                                <div class='row'>
                                    <div class='col-md-2 col-sm-2 col-xs-3'><img class='img-circle' src='{ $sucursal->image }' width='55' height='55'></div>
                                    <div class='col-md-10 col-sm-10 col-xs-9'>
                                        <div class='row'>
                                            <div class='col-md-12 col-sm-12 col-xs-12'><strong>{ $sucursal->nombre }</strong></div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-md-12 col-sm-12 col-xs-12'><span id='modal_nombreServicio'>{$servicioAux->nombre}</span></div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-md-12 col-sm-12 col-xs-12'><strong>N° Actual: </strong><strong id='modal_numeroTicket'>{$servicioAux->letra}{$servicioAux->numero_actual}</strong></div>
                                            <div class='col-md-12 col-sm-12 col-xs-12'><span id='modal_tiempo'>{$servicioAux->tiempo_espera}</span><span> minutos restantes</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button class='btn btn-primary' type='button' data-dismiss='modal' onclick='actualizarPage({$sucursal->id})'><i class='fa fa-check fa-fw'></i>Aceptar </button>
                    </div>
                </div>
            </div>";
        }
        else//no pasa
        {
            echo "<div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='modal-title'><i class='fa fa-exclamation-circle fa-fw'></i>Error: Solicitud de Ticket fallida</h4></div>
                    <div class='modal-body'>
                        <p>Ha ocurrido un error solicitando un ticket para el servicio seleccionado. Intente solicitar un ticket en este servicio mas tarde.</p>
                    </div>
                    <div class='modal-footer'>
                        <button class='btn btn-primary' type='button' data-dismiss='modal' onclick='actualizarPage({$sucursal->id})'><i class='fa fa-check fa-fw'></i>Aceptar </button>
                    </div>
                </div>
            </div>";
        }

    }

    public function notificarCercanos()
    {
        $cuenta = Auth::user();
        $cliente = $cuenta->usuario;
        $tickets=Ticket::where('cliente_id', '=', $cliente->id)->where('estado', '=', Constantes::NuevoTicket())->get();
        $encontrado=0;
        foreach($tickets as $ticket)
        {
            $servicioAux=Servicio::find($ticket->servicio_id);
            if($ticket->numero - $servicioAux->numero_actual < 5)
            {
                //ojo! notificar
                if($ticket->numero == $servicioAux->numero_actual)
                {
                    $encontrado=2;
                    break;
                }
                $encontrado=1;
            }
        }
        if($encontrado==1)
        {
            echo 'NOTIFIED';
        }
        else if($encontrado==2)
        {
            echo 'YOUTURN';
        }
        else
        {
            echo 'NON NOTIFIED';
        }
    }

}
