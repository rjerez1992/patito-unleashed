<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function profile()
    {
        $nameCliente='Reinaldo Jerez Contreras';
        $rutCliente='18.254.324-7';
        $emailCliente='tu_rexiiito@hotmail.com';
        $imageCliente='https://pbs.twimg.com/profile_images/468879197025226752/MJ5hJowM.png';
        $dirCliente='14 1/2 Sur con 5 oriente, #4097 Talca, Región del Maule';
        $reputacionCliente='6.5';
        $maxTicketsCliente='5';
        return view('cliente/user-profile',compact('nameCliente','rutCliente','emailCliente','imageCliente','dirCliente','reputacionCliente','maxTicketsCliente'));
    }

    public function institucion()
    {
        $nameInstitucion='Santander Chile S.A.';
        $runInstitucion='123.456.789-0';
        $descInstitucion='Santander Chile es de los primeros bancos en apoyar una universidad estatal que no posee un casino de calidad.';
        $imageInstitucion='https://pbs.twimg.com/profile_images/468879197025226752/MJ5hJowM.png';
        return view('cliente/institucion-profile',compact('nameInstitucion','runInstitucion','descInstitucion','imageInstitucion'));
    }

    public function sucursal()
    {
        $nameInstitucion='Santander Chile S.A.';
        $nameSucursal='Santander Talca #346';
        $dirSucursal='1 Sur #346, Talca, Región del Maule, Chile-0';
        $descSucursal='Santander Chile es de los primeros bancos en apoyar una universidad estatal que no posee un casino de calidad.';
        $imageSucursal='https://pbs.twimg.com/profile_images/468879197025226752/MJ5hJowM.png';
        return view('cliente/sucursal-profile',compact('nameInstitucion','nameSucursal','dirSucursal','descSucursal','imageSucursal'));
    }

    public function tickets()
    {
        $imageSucursal='https://pbs.twimg.com/profile_images/468879197025226752/MJ5hJowM.png';
        return view('cliente/tickets-box',compact('imageSucursal'));
    }
}
