<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cubiculo extends Model
{

    //protected $table = 'cubiculos';
    //public $timestamps = false;

     public static function getServicio($id)
     {
     	$servicio= Servicio::find($id);
     	return $servicio;
     }

     public static function getSucursal($id)
     {
     	$servicio= Servicio::find($id);
     	$sucursal= Sucursal::find($servicio->sucursal_id);
     	return $sucursal;
     }

    public function servicio(){
    	return $this->belongsTo('App\Servicio');
    }

    public function operario(){
    	return $this->hasOne('App\Operario');
    }

}
