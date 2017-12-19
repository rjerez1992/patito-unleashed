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
            $data = array(
                'cuenta' => $cuenta,
                'cliente' => $cuenta->usuario,
                'sucursalesFrecuentes' =>Sucursal::all(),
                'reputacionCliente' => '6.5',
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
                'sucursalesFrecuentes' => NULL,
                'reputacionCliente' => '6.5',
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
                    'historialTickets' => Ticket::where('cliente_id', '=', $cliente->id)->where('estado', '!=', Constantes::NuevoTicket())->get(),
                    'cuenta' => $cuenta,
                );
            return view('cliente/tickets-box')->with($data);
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
                                        <div class='row'>
                                            <div class='col-md-12 col-sm-12 col-xs-12'><strong>N° Actual: </strong><strong>{$ticket->servicio->letra}{$ticket->servicio->numero_actual}</strong></div>
                                            <div class='col-md-12 col-sm-12 col-xs-12'><span class='text-danger'>10 </span><span class='text-danger'> minutos restantes</span></div>
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

                $ticket->fecha = '2017-11-30';
                $ticket->hora = '21:24:47';
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
                                    <div class='col-md-12 col-sm-12 col-xs-12'><i class='fa fa-ticket fa-fw'></i><strong class='text-uppercase'>{$servicioAux->letra}{$ticket->numero} </strong><strong>(<i class='fa fa-clock-o fa-fw'></i> </strong><strong>14:00:03 </strong><strong class='no-padding'>) </strong></div>
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
