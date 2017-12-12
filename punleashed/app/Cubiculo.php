<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cubiculo extends Model
{
    //
    public function servicio(){
    	return $this->belongsTo('App\Servicio');
    }

    public function operario(){
    	return $this->hasOne('App\Operario');
    }
}
