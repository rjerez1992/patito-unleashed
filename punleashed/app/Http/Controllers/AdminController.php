<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Cliente;
use App\Constantes;
use App\Cubiculo;
use App\Cuenta;
use App\Institucion;
use App\Manager;
use App\Operario;
use App\Servicio;
use App\Sucursal;
use App\Ticket;
use Session;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /*
	 * Obtiene estadisticas simples y las entrega a la vista del dashboard para admins
	 */
    public function dashboard(){
    	$cuenta = Auth::user();
    	$admin = $cuenta->usuario;
 
    	$data = array(
    		'nombre' => $admin->nombre,
    		'total_instituciones' => Institucion::count(),
    		'total_sucursales' => Sucursal::count(),
    		'total_servicios' => Servicio::count(),
    		'total_cubiculos' => Cubiculo::count(),
    		'total_managers' => Manager::count(),
    		'total_operarios' => Operario::count(),
    		'total_clientes' => Cliente::count(),
    		'total_tickets' => Ticket::count(), 
    		'semana_instituciones' => Institucion::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
    		'semana_sucursales' => Sucursal::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
    		'semana_servicios' => Servicio::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
    		'semana_cubiculos' => Cubiculo::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
    		'semana_managers' => Manager::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
    		'semana_operarios' => Operario::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
    		'semana_clientes' => Cliente::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
    		'semana_tickets' => Ticket::where('created_at', '>=', Carbon::now()->startOfWeek())->count(),
    		);

    	return view('admin/dashboard')->with($data);
    }

    /*
	 * Muestra los usuarios
	 */
    public function usuarios($tipoUsuario){
    	$lista = NULL;   
    	$adminActive = "";
    	$managerActive = "";
    	$operarioActive = "";
    	$clienteActive = "";

    	if ($tipoUsuario == 'admins'){
			$lista = Admin::orderBy('id', 'desc')->simplePaginate(15);
			$adminActive = "active";
    	}
        else if ($tipoUsuario == 'managers'){
			$lista = Manager::orderBy('id', 'desc')->simplePaginate(15);
			$managerActive = "active";
    	}
    	else if ($tipoUsuario == 'operarios'){
			$lista = Operario::orderBy('id', 'desc')->simplePaginate(15);
			$operarioActive = "active";
    	}
    	else if ($tipoUsuario == 'clientes'){
    		$lista = Cliente::orderBy('id', 'desc')->simplePaginate(15);
    		$clienteActive = "active";
    	}
    	else{
    		abort(404);
    	}
        
        $data = array(
        	'tipoUsuario' => $tipoUsuario,
        	'lista' => $lista,  
        	'adminActive' => $adminActive,      
        	'managerActive' => $managerActive, 
        	'operarioActive' => $operarioActive, 
        	'clienteActive' => $clienteActive,	
    	);

    	return view('admin/lista-usuarios')->with($data);
    }

    /*
	 * Muestra el FORMULARIO para agregar un usuario
	 */
    public function agregar($tipoUsuario){ 
        $previousURL = url()->previous();
    	$adminActive = "";
    	$managerActive = "";
    	$operarioActive = "";
    	$clienteActive = "";
    	$instituciones = NULL;

    	if ($tipoUsuario == 'admins'){
			$adminActive = "active";
    	}
        else if ($tipoUsuario == 'managers'){
			$managerActive = "active";
			$instituciones = Institucion::all();
    	}
    	else if ($tipoUsuario == 'operarios'){
			$operarioActive = "active";
			$instituciones = Institucion::all();
    	}
    	else if ($tipoUsuario == 'clientes'){
    		$clienteActive = "active";
    	}
    	else{
    		abort(404);
    	}
        
        $data = array(
        	'tipoUsuario' => $tipoUsuario,        	
        	'adminActive' => $adminActive,      
        	'managerActive' => $managerActive, 
        	'operarioActive' => $operarioActive, 
        	'clienteActive' => $clienteActive,	
        	'instituciones' => $instituciones,
            'previousURL' => $previousURL,
    	);

    	return view('admin/agregar-usuarios')->with($data);
    }

    /*
	 * Crea un usuario a partir de un post request
	 */
    public function crear(Request $request, $tipoUsuario){
    	//Valida las entradas
    	$this->validate($request, [
	        'username' => 'required|string|max:255|unique:cuentas',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:255',     
	    ]);  

    	//Valida el rut para los no-administradores
	    if($tipoUsuario!='admins'){
	    	$this->validate($request, [	          
	            'rut' => 'required|numeric|unique:'.$tipoUsuario,
		    ]); 
	    }  

    	//Crea la cuenta
	    $cuenta = new Cuenta;
	    $cuenta->username = $request->username;
	    $cuenta->password = $request->password;
	    $cuenta->save();

	    $usuario = NULL;

	    //Crea el usuario dependiendo el tipo
	    if ($tipoUsuario=='clientes'){	    	
	    	$usuario = new Cliente;
	    	$usuario->rut = $request->rut;
	    }
    	else if($tipoUsuario=='operarios'){
    		$usuario = new Operario;    
    		$usuario->rut = $request->rut;
    		$usuario->servicio_id = $request->servicio;		
    	}
		else if($tipoUsuario=='managers'){
			$usuario = new Manager;
			$usuario->rut = $request->rut;
			$usuario->institucion_id = $request->institucion;
		}
		else if($tipoUsuario=='admins'){
			$usuario = new Admin;			
		}
		else{
			//En caso de obtener el parametro mal, elimina la cuenta y aborta
			$cuenta->delete();
			abort(404);
		}

		$usuario->nombre = $request->name;
		$usuario->cuenta_id = $cuenta->id;
		$usuario->save();

		//Entrega un mensaje de vuelta
		Session::flash('msg', Constantes::Mensaje('cuenta_creada_exito'));
		Session::flash('status-ok', true);
    	return back();  	
    }

    /*
     * Elimina un usuario dado un id y un tipo
     */
    public function eliminar(Request $request, $tipoUsuario){

    	if (!is_numeric($request->hiddenId)){
    		abort(404);
    	}

    	//Buscamos el usuario
    	$usuario = NULL;

	    //Crea el usuario dependiendo el tipo
	    if ($tipoUsuario=='clientes'){	    	
	    	$usuario = Cliente::find($request->hiddenId);
	    }
    	else if($tipoUsuario=='operarios'){
    		$usuario = Operario::find($request->hiddenId);	
    	}
		else if($tipoUsuario=='managers'){
			$usuario = Manager::find($request->hiddenId);
		}
		else if($tipoUsuario=='admins'){
			$usuario = Admin::find($request->hiddenId);			
		}
		else{
			//En caso de obtener el parametro mal
			abort(404);
		}

		//En caso que no se encuentre el usuario con ese id
		if ($usuario == NULL){
			abort(404);
		}

		$cuenta = $usuario->cuenta;
		//$cuenta->usuario->delete();
		$cuenta->delete();

    	//Entrega un mensaje de vuelta
		Session::flash('msg', Constantes::Mensaje('cuenta_eliminada_exito'));
		Session::flash('status-ok', true);
    	return back();
    }

    public function preEdicion($tipoUsuario, $id){

        $usuario = NULL;

        $adminActive = "";
        $managerActive = "";
        $operarioActive = "";
        $clienteActive = "";
        $instituciones = NULL;

        if ($tipoUsuario == 'admins'){
            $usuario = Admin::find($id);
            $adminActive = "active";
        }
        else if ($tipoUsuario == 'managers'){
            $managerActive = "active";
            $usuario = Manager::find($id);
            $instituciones = Institucion::all();
        }
        else if ($tipoUsuario == 'operarios'){
            $operarioActive = "active";
            $usuario = Operario::find($id);
            $instituciones = Institucion::all();
        }
        else if ($tipoUsuario == 'clientes'){
            $clienteActive = "active";
            $usuario = Cliente::find($id);
        }
        else{
            //En caso  que el tipo  de  usuario sea incorrecto
            abort(404);
        }

        //En caso que no se encuentre el usuario con ese id
        if ($usuario == NULL){
            abort(404);
        }

        $cuenta = $usuario->cuenta;

        $data = array(
                'tipoUsuario' => $tipoUsuario,
                'usuario' => $usuario,
                'cuenta' => $cuenta,      
                'adminActive' => $adminActive,      
                'managerActive' => $managerActive, 
                'operarioActive' => $operarioActive, 
                'clienteActive' => $clienteActive,
                'instituciones' =>  $instituciones,
            );

        return view('admin/editar-usuarios')->with($data);
    }

    public function editar(Request $request, $tipoUsuario){
    	//TODO: FIX: Debería primero validar el ID, luego buscar la cuenta y el usuario. En caso que el rut y el username del request sean distintos al anterior, validarlos nuevamente. Sino dejar pasar, porque ahora está dejando pasar ruts y usernames repetidos.
    	//Valida las entradas
    	$this->validate($request, [
	        'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'name' => 'required|string|max:255',    
            'usuarioId' => 'required|numeric', 
	    ]);  

    	//Valida el rut para los no-administradores
	    if($tipoUsuario!='admins'){
	    	$this->validate($request, [	          
	            'rut' => 'required|numeric', //Debería ser unique
		    ]); 
	    }  

    	//Busca el usuario con el id ingresado
    	$usuario = NULL;

    	if ($tipoUsuario == 'admins'){
            $usuario = Admin::find($request->usuarioId);
        }
        else if ($tipoUsuario == 'managers'){
            $usuario = Manager::find($request->usuarioId);
        }
        else if ($tipoUsuario == 'operarios'){
            $usuario = Operario::find($request->usuarioId);
        }
        else if ($tipoUsuario == 'clientes'){
            $usuario = Cliente::find($request->usuarioId);
        }
        else{
            //En caso  que el tipo  de  usuario sea incorrecto
            abort(404);
        }

        //Si no encuentra el usuario
        if ($usuario==NULL){abort(404);}

	    //Busca la cuenta asociada y actualzia
	    $cuenta = $usuario->cuenta;

	    $cuenta->username = $request->username;
	    if($request->password != NULL && $request->password != ""){ 
	    	$cuenta->password = bcrypt($request->password);
	    }
    	$cuenta->save();

    	//Luego actualiza los datos de usuario
    	$usuario->nombre = $request->name;

    	if($request->has('rut')){ $usuario->rut = $request->rut; }
    	if($request->has('institucion')){ $usuario->institucion_id = $request->institucion; }
    	if($request->has('servicio')){ $usuario->servicio_id = $request->servicio; }

    	$usuario->save();

		//Entrega un mensaje de vuelta
		Session::flash('msg', Constantes::Mensaje('cuenta_editada_exito'));
		Session::flash('status-ok', true);
    	return back();
    }

     public function editarCliente(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|string|max:255',    
            'usuarioId' => 'required|numeric', 
        ]);  
        $usuario = Manager::find($id);

        $usuario->nombre = $request->name;
        $usuario->rut = $request->rut; 
        $usuario->save();

        $user=\Auth::user();

        $cliente=Manager::where('cuenta_id', $user->id)->first();
        $Institucion=Institucion::where('manager', $cliente->id)->first();

        if ($Institucion!=null) {
            $Sucursales=Sucursal::where('institucion_id', $Institucion->id)->get();
        }
        else{
            $Sucursales=null;
        }

        
        return view('manager/dashboard')->with('user', $user)->with('cliente', $cliente)
                                 ->with('Sucursales', $Sucursales)   
                                 ->with('Institucion', $Institucion); 
    }

    /* Lista las instituciones */
    public function instituciones(){
        //Busca las instituciones
        //Retorna

        $instituciones = Institucion::orderBy('id', 'desc')->simplePaginate(15);

        $data =  array(
                'instituciones' => $instituciones,
            );

        return view('admin/lista-instituciones')->with($data);
    }

    /* Muestra el FORMULARIO para agregar  una institucion */
    public function agregarInstitucion(){
        return view('admin/agregar-institucion');
    }

    /* Crea una institucion a partir de un  post */
    public function  crearInstitucion(Request $request){
     
        //Valida las entradas
        $this->validate($request, [
            'username' => 'required|string|max:255|unique:cuentas',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string|max:255',
            'rut' => 'required|numeric|unique:managers',
            'nombreInstitucion' => 'required|string|max:255', //Ver como hacer el  unique aqui
            'run' => 'required|numeric|unique:institucions',     
        ]);  

        //Crea la institucion
        $institucion = new Institucion;
        $institucion->nombre  = $request->nombreInstitucion;
        $institucion->run = $request->run;
        
        $institucion->save();

        //Crea la cuenta de manager
        $cuenta = new Cuenta;
        $cuenta->username = $request->username;
        $cuenta->password = bcrypt($request->password);
        $cuenta->tipo = Constantes::Manager();
        $cuenta->save();

        //Crea el manager
        $manager = new  Manager;
        $manager->institucion_id =  $institucion->id;
        $manager->cuenta_id = $cuenta->id;
        $manager->rut = $request->rut;
        $manager->nombre = $request->name;

        $manager->save();

        //Entrega un mensaje de vuelta
        Session::flash('msg', Constantes::Mensaje('institucion_creada_exito'));
        Session::flash('status-ok', true);
        return back();
    }

    /* Muestra el FORMULARIO de edicion de institucion  */
    public function  preEdicionInstitucion($id){

        //Busca la institucion
        $institucion = Institucion::find($id);

        if ($institucion==NULL){
            abort(404);
        }

        $data = array(
                'institucion' => $institucion,
            );

        return  view('admin/editar-instituciones')->with($data);
    }

    public function editarInstitucion(Request $request){
        //TODO: FIX: Debería primero validar el ID, luego buscar la cuenta y el usuario. En caso que el rut y el username del request sean distintos al anterior, validarlos nuevamente. Sino dejar pasar, porque ahora está dejando pasar ruts y usernames repetidos. (Misma idea para esto);
        //Valida las entradas
        $this->validate($request, [
            'institucionId' => 'required|numeric',
            'name' => 'required|string|max:255',
            'run' => 'required|numeric',
            'descripcion' => 'required|string|max:1024',    
        ]);  

        //Busca la institucion
        $institucion = Institucion::find($request->institucionId);

        if ($institucion==NULL){
            abort(404);
        }

        $institucion->nombre = $request->name;
        $institucion->run = $request->run;
        $institucion->descripcion = $request->descripcion;
        $institucion->save();

        //Entrega un mensaje de vuelta
        Session::flash('msg', Constantes::Mensaje('cuenta_editada_exito'));
        Session::flash('status-ok', true);
        return back();
    }

    /* Elimina una institucion */
    public function eliminarInstitucion(Request $request){

        if (!is_numeric($request->hiddenId)){
            abort(404);
        }

        //Buscamos la institucion
        $institucion = Institucion::find($request->hiddenId);

        //Eliminamos (cascade debería eliminar todo lo relacionado)
        $institucion->delete();

        //Entrega un mensaje de vuelta
        Session::flash('msg', Constantes::Mensaje('institucion_eliminada_exito'));
        Session::flash('status-ok', true);
        return back();
    }


}

