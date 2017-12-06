<?php

namespace App\Http\Middleware;

use App\Constantes;
use Closure;

class FiltroUsuarios
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipoRequerido)
    {       
        $usuario = $request->user();
        if ($usuario==NULL){
            return redirect('/ingresar');
        }

        $tipo =  $usuario->tipo;

        if ($tipo != $tipoRequerido){
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
            if ($tipo == Constantes::Admin()){
                return redirect('admin/dashboard');
            }
        }

        return $next($request);
    }
}
