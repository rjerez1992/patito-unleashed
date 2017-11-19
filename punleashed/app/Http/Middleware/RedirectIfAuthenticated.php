<?php

namespace App\Http\Middleware;

use Closure;
use App\Constantes;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
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
            if ($tipo == Constantes::Admin()){
                return redirect('admin/dashboard');
            }
        } 
        /*if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }*/

        return $next($request);
    }
}
