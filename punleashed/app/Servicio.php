<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //
    public function sucursal(){
    	return $this->belongsTo('App\Sucursal');
    }

    public function cubiculos(){
    	return $this->hasMany('App\Cubiculo');
    }
}
