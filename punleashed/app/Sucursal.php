<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursals';
    public $timestamps = false;

    public static function Servicios($id)
    {
        $Servicios=Servicio::where('sucursal_id','=',$id)->get(); 
        return $Servicios;

    }
      
}
