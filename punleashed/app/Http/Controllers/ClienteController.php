<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Constantes;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function profile()
    {
        if (Auth::user()!=NULL)
        {
            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;
            if ($cliente && $cuenta->tipo==Constantes::Cliente())
            {
                $reputacionCliente='6.5';
                $sucursalesFrecuentes=collect([]);
                $id_perfil = $cliente->id;
                return view('cliente/user-profile',compact('cuenta','cliente','sucursalesFrecuentes','reputacionCliente'));
            }
        }
        return redirect('/');
    }

    public function institucion()
    {
        if (Auth::user()!=NULL)
        {
            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;
            $sucursales=collect([]);
            if ($cliente && $cuenta->tipo==Constantes::Cliente())
            {
                $nameInstitucion='Santander Chile S.A.';
                $runInstitucion='123.456.789-0';
                $descInstitucion='Santander Chile es de los primeros bancos en apoyar una universidad estatal que no posee un casino de calidad.';
                $imageInstitucion='https://pbs.twimg.com/profile_images/468879197025226752/MJ5hJowM.png';
                return view('cliente/institucion-profile',compact('sucursales','nameInstitucion','runInstitucion','descInstitucion','imageInstitucion'));
            }
        }
        return redirect('/');
    }

    public function sucursal()
    {
        $nameInstitucion='Santander Chile S.A.';
        $nameSucursal='Santander Talca #346';
        $dirSucursal='1 Sur #346, Talca, Región del Maule, Chile-0';
        $descSucursal='Santander Chile es de los primeros bancos en apoyar una universidad estatal que no posee un casino de calidad.';
        $servicios=collect([]);
        $imageSucursal='https://pbs.twimg.com/profile_images/468879197025226752/MJ5hJowM.png';
        if (Auth::user()!=NULL)
        {
            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;
            if ($cliente && $cuenta->tipo==Constantes::Cliente())
            {
                return view('cliente/sucursal-profile',compact('servicios','nameInstitucion','nameSucursal','dirSucursal','descSucursal','imageSucursal'));
            }
        }
        return view('cliente/sucursal-profile',compact('servicios','nameInstitucion','nameSucursal','dirSucursal','descSucursal','imageSucursal'));
    }

    public function tickets()
    {
        if (Auth::user()!=NULL)
        {
            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;
            if ($cliente && $cuenta->tipo==Constantes::Cliente())
            {
                $ticketsActivos = collect([]);
                $historialTickets = collect([]);
                return view('cliente/tickets-box',compact('cliente','ticketsActivos','historialTickets'));
            }
        }
        return redirect('/');

    }
}
