<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public function cuenta(){
    	return $this->belongsTo('App\Cuenta');
    }

    public function institucion(){
    	return $this->belongsTo('App\Institucion');
    }
}
