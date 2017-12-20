<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operario extends Model
{
    //protected $table = 'operarios';
    //public $timestamps = false;

    public function cuenta(){
        return $this->belongsTo('App\Cuenta');
    }

     public static function getCuenta($id)
     {
     	$cuenta= Cuenta::find($id);
     	return $cuenta;
     }

     public static function getServicio($id)
     {
     	$servicio= Servicio::find($id);
     	return $servicio;
     }
     public static function getCubiculos($id)
     {
        $cubiculo=Cubiculo::where("servicio_id","=",$id)->get();
        return $cubiculo;
     }
     public static function getCubiculo($id)
     {
        $cubiculo=Cubiculo::find($id);
        return $cubiculo;
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

    public function cubiculo(){
    	return $this->belongsTo('App\Cubiculo');
    }
}
