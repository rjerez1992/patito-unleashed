<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    //
    public function sucursales(){
    	return $this->hasMany('App\Sucursal');
    }

}
