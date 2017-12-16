<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cubiculo extends Model
{
    protected $table = 'cubiculos';
    public $timestamps = false;

     public static function Servicio($id)
     {
     	$servicio= Servicio::find($id);
     	return $servicio;
     }

     public static function Sucursal($id)
     {
     	$servicio= Servicio::find($id);
     	$sucursal= Sucursal::find($servicio->sucursal_id);
     	return $sucursal;
     }
}
