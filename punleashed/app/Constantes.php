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
        //TODO:Agregar una imagen t.png  a /img/  
        //Todas las  imagenes que se suban deberiamos guardarlas ahi 
        return 't.png';
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

    public static function NuevoTicket(){
        return 'Pendiente';
    }

    public static function TicketAtendido(){
        return 'Atendido';
    }

    public static function TicketCancelado(){
        return 'Cancelado';
    }

    public static function TicketInasistente(){
        return 'Inasistente';
    }

    public static function Mensaje($key){
        $mensaje = array(
            'cuenta_creada_exito' => 'El usuario ha sido creado de manera exitosa',
            'cuenta_eliminada_exito' => 'El usuario ha sido eliminado de manera exitosa',
            'cuenta_editada_exito' => 'El usuario ha sido editado de manera exitosa',
            );
        return $mensaje[$key];
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
