<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operario extends Model
{
    public function cuenta(){
    	return $this->belongsTo('App\Cuenta');
    }

    public function servicio(){
    	return $this->belongsTo('App\Servicio');
    }

    public function cubiculo(){
    	return $this->belongsTo('App\Cubiculo');
    }
}
