<?php

namespace App\Http\Controllers;

use App\Models\Disenio;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PruebaController extends Controller
{
    public function index()
    {
        // $id = 8;
        // $img = Disenio::where('id',  $id)->value('url_imagen');
        // dd($img);
        // return $img;
        $disenios=Disenio::all();
        return view('prueba', ['disenios' => $disenios]);
    }
    // public function descargar($id)
    // {
    //     $img = Disenio::where('id', $id)->value('url_imagen');
    //     $url_full = "D:\TF-SGPO\Sist-Oliva\public" . $img;
    //     // $img="D:\TF-SGPO\Sist-Oliva\public\storage/2oJ5pU6VHp7ctaYTvAznwJWbNrIUg7P2q24HyfS0.png";
    //     // return "descargar";

    //     return response()->download($url_full);
    // }
}
