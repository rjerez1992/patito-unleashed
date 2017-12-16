<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operario extends Model
{
    protected $table = 'operarios';
    public $timestamps = false;

     public static function Cuenta($id)
     {
     	$cuenta= Cuenta::find($id);
     	return $cuenta;
     }

     public static function Servicio($id)
     {
     	$servicio= Servicio::find($id);
     	return $servicio;
     }
     public static function Cubiculos($id)
     {
        $cubiculo=Cubiculo::where("servicio_id","=",$id)->get();
        return $cubiculo;
     }
     public static function Cubiculo($id)
     {
        $cubiculo=Cubiculo::find($id);
        return $cubiculo;
     }


     public static function Sucursal($id)
     {
     	$servicio= Servicio::find($id);
     	$sucursal= Sucursal::find($servicio->sucursal_id);
     	return $sucursal;
     }

}
