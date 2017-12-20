<?php

namespace App;

use App\Constantes;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //protected $table = 'servicios';
    //public $timestamps = false;

    public function sucursal(){
    	return $this->belongsTo('App\Sucursal');
    }

    public function cubiculos(){
        return $this->hasMany('App\Cubiculo');
    }

    public static function getCubiculo($id)
    {
    	$cubiculos = Cubiculo::where("servicio_id","=",$id)->get();
    	return $cubiculos->count();
    }

    public static function getOperario($id)
    {
    	$operarios = Operario::where("servicio_id","=",$id)->get();
    	
    	return $operarios->count();
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

    public function tickets(){
    	return $this->hasMany('App\Ticket');
    }
}
 