<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Constantes;

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
            if ($cliente && $cuenta->tipo==Constantes::Cliente())
            {
                $nameInstitucion='Santander Chile S.A.';
                $runInstitucion='123.456.789-0';
                $descInstitucion='Santander Chile es de los primeros bancos en apoyar una universidad estatal que no posee un casino de calidad.';
                $imageInstitucion='https://pbs.twimg.com/profile_images/468879197025226752/MJ5hJowM.png';
                return view('cliente/institucion-profile',compact('nameInstitucion','runInstitucion','descInstitucion','imageInstitucion'));
            }
        }
        return redirect('/');
    }

    public function sucursal()
    {
        if (Auth::user()!=NULL)
        {
            $cuenta = Auth::user();
            $cliente = $cuenta->usuario;
            if ($cliente && $cuenta->tipo==Constantes::Cliente())
            {
                $nameInstitucion='Santander Chile S.A.';
                $nameSucursal='Santander Talca #346';
                $dirSucursal='1 Sur #346, Talca, Región del Maule, Chile-0';
                $descSucursal='Santander Chile es de los primeros bancos en apoyar una universidad estatal que no posee un casino de calidad.';
                $imageSucursal='https://pbs.twimg.com/profile_images/468879197025226752/MJ5hJowM.png';
                return view('cliente/sucursal-profile',compact('nameInstitucion','nameSucursal','dirSucursal','descSucursal','imageSucursal'));

            }
        }
        return redirect('/');
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
