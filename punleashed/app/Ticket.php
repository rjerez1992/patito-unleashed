<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function cliente(){
    	return $this->belongsTo('App\Cliente');
    }

    public function servicio(){
    	return $this->belongsTo('App\Servicio');
    }
}
