<?php

namespace App;

use App\Constantes;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //
    public function sucursal(){
    	return $this->belongsTo('App\Sucursal');
    }

    public function cubiculos(){
    	return $this->hasMany('App\Cubiculo');
    }

    public function tickets(){
    	return $this->hasMany('App\Ticket');
    }

    public function ticketCliente($idCliente)
    {
    	$tickets = $this->tickets;
       	foreach ($tickets as $ticket) {
    		if($ticket->cliente_id==$idCliente && $ticket->estado==Constantes::NuevoTicket())
    		{
    			return $ticket;
    		}
    	}
    	return NULL;
    }
}
