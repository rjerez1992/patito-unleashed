<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constantes extends Model
{
    public static function Cliente(){
    	return '0';
    }

    public static function Operario(){
    	return '5';    	
    } 

    public static function Manager(){
    	return '10';    	
    }

    public static function Admin(){
        return '50';
    }

    public static function NoEspecificado(){
        return 'No especificado';
    }

    /* Cantidad maxima de tickets para un cliente nuevo */
    public static function MaxTickets(){
        return '5'; 
    }

    /* Ruta a la imagen por defecto del sistema */
    public static function ImagenDefecto(){
        //TODO: Poner imagen y especificar ruta.
        return '/';
    }

    public static function NuevaInstitucion(){
        return 'Nueva institucion';
    }

    public static function NuevaSucursal(){
        return 'Nueva sucursal';
    }

    public static function NuevoCubiculo(){
        return 'Nuevo cubiculo';
    }

    public static function CubiculoVacio(){
        return 'Desocupado';
    }

    public static function Textual($value){
    	if ($value == '0'){
    		return 'Cliente';
    	}
    	if ($value == '5'){
    		return 'Operario';
    	}
    	if ($value == '10'){
    		return 'Manager';
    	}
        if ($value == '50'){
            return 'Administrador';
        }
    }
}
