<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperarioController extends Controller
{
    public function servicio(){
    	return view('operario/servicio');
    }
}
