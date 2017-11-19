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
    }
}
