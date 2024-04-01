<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtroFecha(Request $request)
    {

        // validaciones 
        // return $request;
        $operacion = $request->operacion;
        $fechaDesde = $request->fdesde;
        $fechaHasta = $request->fhasta;

        if (($operacion == null) && ($fechaDesde == null) && ($fechaHasta == null)) {
            return redirect()->route('auditoria.index');
        }
        if (($operacion != null) && ($fechaDesde != null) && ($fechaHasta != null)) {
            $fechaDesde = Carbon::parse($fechaDesde);
            $fechaHasta =  Carbon::parse($fechaHasta);
            if ($fechaDesde->gt($fechaHasta)) {
                // La fecha desde no puede ser mayor a la fecha hasta.

                return redirect()->back()->withErrors(['fecha_desde' => 'La fecha desde no puede ser mayor a la fecha hasta.']);
            }
            $audits = Audit::whereBetween('created_at', [$fechaDesde, $fechaHasta])->orderBy('created_at', 'desc')->get();
            $audits = $audits->filter(function ($audit) use ($operacion) {
                return $audit->event === $operacion;
            });
            return view('audits.index', compact('audits'));
        }


        // que pasa si se filtra solo por fechas 
        if ($operacion == null) {
            # code...
            $fechaDesde = Carbon::parse($fechaDesde);
            $fechaHasta =  Carbon::parse($fechaHasta);
            if ($fechaDesde->gt($fechaHasta)) {
                // La fecha desde no puede ser mayor a la fecha hasta.
                // return "fechas";
                return redirect()->back()->withErrors(['fecha_desde' => 'La fecha desde no puede ser mayor a la fecha hasta.']);
            }
            $audits = Audit::whereBetween('created_at', [$fechaDesde, $fechaHasta])->orderBy('created_at', 'desc')->get();
            return view('audits.index', compact('audits'));
        }


        if ($operacion != null) {
            # code...
            $audits  = audit::orderBy('created_at', 'desc')->get();
            $audits = $audits->filter(function ($audit) use ($operacion) {
                return $audit->event === $operacion;
            });
            return view('audits.index', compact('audits'));
        }
    }
    public function index()
    {
        // $user = User::first();
        $audits = Audit::orderBy('created_at', 'desc')->get();

        // dd($audits);
        return view('audits.index', compact('audits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
