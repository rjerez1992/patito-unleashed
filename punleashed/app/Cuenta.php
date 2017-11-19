<?php

namespace App;

use App\Constantes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Cuenta extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'tipo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* Creo que no se está utilizando
    public static function Redirigir($default){
        if (Auth::user()!=NULL){
            $tipo = Auth::user()->tipo;
            if ($tipo == Constantes::Cliente()){
                //Vista de tickets actuales
                return redirect('cliente/tickets');
            }
            if ($tipo == Constantes::Operario()){
                //Vista del servicio asignado
                return redirect('operario/servicio');
            }
            if ($tipo == Constantes::Manager()){
                //Vista de datos en general
                return redirect('manager/dashboard');
            }
            if ($tipo == Constantes::Manager()){
                return redirect('admin/dashboard');
            }
        } 
        return $default;
    }*/

    public function usuario(){
        if ($this->tipo == Constantes::Cliente()){
            return $this->hasOne('App\Cliente');
        }
        if ($this->tipo == Constantes::Operario()){
            return $this->hasOne('App\Operario');
        }
        if ($this->tipo == Constantes::Manager()){
            return $this->hasOne('App\Manager');
        }
        if ($this->tipo == Constantes::Admin()){
            return $this->hasOne('App\Admin');
        }
        return null;
    }

}
