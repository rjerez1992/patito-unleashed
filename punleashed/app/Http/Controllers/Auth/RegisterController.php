<?php

namespace App\Http\Controllers\Auth;

use App\Cuenta;
use App\Constantes;
use App\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registro';  
    //Middleware se encarga de la redireccion

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Muestra el formulario de registro
     */
    public function registro(){
        return view('auth\register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [           
            'username' => 'required|string|max:255|unique:cuentas',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:255',
            'rut' => 'required|numeric|unique:clientes',    
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //Crea el cliente
        $cliente = new Cliente;
        $cliente->nombre = $data['name'];
        $cliente->rut = $data['rut'];

        //Crea la cuenta        
        $cuenta = Cuenta::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'tipo' => Constantes::Cliente(), 
            'password' => bcrypt($data['password']),
        ]);

        //Asigna la cuenta al cliente
        $cliente->cuenta_id = $cuenta->id;
        $cliente->save();

        return $cuenta;
    }
}
