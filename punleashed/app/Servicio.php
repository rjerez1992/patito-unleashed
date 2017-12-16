<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';
    public $timestamps = false;

    public static function Cubiculo($id)
    {
    	$cubiculos = Cubiculo::where("servicio_id","=",$id)->get();
    	return $cubiculos->count();
    }

    public static function Operario($id)
    {
    	$operarios = Operario::where("servicio_id","=",$id)->get();
    	
    	return $operarios->count();
    }
}
 