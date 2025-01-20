<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{

    public function index (){
        $info =  config('contacto');
        return view('contacto.index',compact('info'));
    }
}
