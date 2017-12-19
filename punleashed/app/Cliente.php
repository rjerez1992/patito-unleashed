<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function tickets(){
    	return $this->hasMany('App\Ticket');
    }
    public function ticketsActivos(){
    	return $this->hasMany('App\Ticket')->where('estado', '=', Constantes::NuevoTicket());
    }

    public function cuenta(){
    	return $this->belongsTo('App\Cuenta');
    }
}
