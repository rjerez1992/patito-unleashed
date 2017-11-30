<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cubiculo extends Model
{
    //
    public function servicio(){
    	return $this->hasOne('App\Servicio');
    }

}
