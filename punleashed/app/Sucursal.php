<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{    
    public function servicios(){
    	return $this->hasMany('App\Servicio');
    }

    //TODO: Soy yo o esta mal esta wea?
    public function institucion(){
    	return $this->hasOne('App\Institucion');
    }

}
