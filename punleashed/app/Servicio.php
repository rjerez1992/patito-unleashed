<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //
    public function sucursal(){
    	return $this->hasOne('App\Sucursal');
    }
}
