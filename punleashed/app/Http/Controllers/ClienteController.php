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
                'sucursalesFrecuentes' =>NULL,
                'reputacionCliente' => '6.5',
            );

        return  view('cliente/user-profile')->with($data);
    }

    public function search()
    {
        $sucursales=collect([]);
        return view('cliente/search',compact('sucursales'));
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
}
