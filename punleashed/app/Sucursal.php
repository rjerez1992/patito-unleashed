<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    //protected $table = 'sucursals'; (No es necesario, eloquent lo infiere)
    //public $timestamps = false;

    public function servicios(){
    	return $this->hasMany('App\Servicio');
    }

    public function institucion(){
    	return $this->belongsTo('App\Institucion');
    }

    //Modificado en todos los archivos.
    public static function getServicios($id)
    {
        $Servicios=Servicio::where('sucursal_id','=',$id)->get(); 
        return $Servicios;

    }
      
}
