<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    public function sucursales(){
    	return $this->hasMany('App\Sucursal');
    }

    public function servicios()
    {
        return $this->hasManyThrough('App\Servicio', 'App\Sucursal');
    }

    public function managers(){
    	return $this->hasMany('App\Manager');
    }

}
