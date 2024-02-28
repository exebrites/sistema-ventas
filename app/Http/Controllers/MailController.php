<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Mail\PagoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    function pago(Request $request)
    {
        $id = $request->id;
        $total = $request->total;

        $user_id = Auth::user()->id;
        $correo = User::where('id', $user_id)->value('email');
        $cliente = Cliente::where('correo', $correo)->first();
        $cliente_id = $cliente->id;

        $estado = $request->estado;
        // $correo = Cliente::where('id', $idCliente)->value('correo');
        // dd($correo);
        // Mail::to($correo)->send(new PagoMailable($id, $total));
        return view('checkout', ['estado' => $estado, 'id' => $id]);
        // return view('emails.Pago');
    }
    function comprobante(Request $request)
    {
        $imagen =  $request->file('comprobante')->store('public');
        $url = Storage::url($imagen);

        return $url;
    }


    /**
     Codigo comentado Revisar
     public function pago(Request $request)
{
    // Recibe un objeto de solicitud ($request) que contiene datos del formulario

    // Obtiene el ID, el total y el estado de la solicitud
    $id = $request->id;
    $total = $request->total;
    $estado = $request->estado;

    // Obtiene el ID del cliente autenticado
    $idCliente = Auth::user()->id;

    // Obtiene el correo del cliente basado en su ID
    $correo = Cliente::where('id', $idCliente)->value('correo');

    // Envía un correo electrónico al cliente utilizando la clase Mail y el mailable PagoMailable
    Mail::to($correo)->send(new PagoMailable($id, $total));

    // Retorna la vista 'checkout' con el estado y el ID
    return view('checkout', ['estado' => $estado, 'id' => $id]);
}

     */
}
