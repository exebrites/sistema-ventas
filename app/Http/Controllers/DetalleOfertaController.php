<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Oferta;
use App\Models\Demanda;
use App\Models\DetalleDemanda;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\DetalleOferta;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class DetalleOfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    public function crear($demanda_id, $oferta_id, $material_id)
    {
        // return $demanda_id;
        // return $oferta_id;
        $material = Material::find($material_id);
        $demanda = Demanda::find($demanda_id);
        $detalle = DetalleDemanda::select()->where('demandas_id',$demanda_id)->where('materiales_id',$material_id)->first();
        // dd($detalle);
        return view('oferta.create_detalle', compact('demanda_id', 'oferta_id', 'material','detalle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $demanda = Demanda::find($request->demanda_id);
        $oferta = Oferta::find($request->oferta_id);

        $detalleOferta = DetalleOferta::where('oferta_id',$oferta->id)->where('material_id',$request->material_id)->first();
        if($detalleOferta){
            return back()->withErrors(['material' => 'El material ya se ha agregado a esta oferta']);
        }
        
        DetalleOferta::create([
            'oferta_id' => $oferta->id,
            'material_id' => $request->material_id,
            'nombre' => $request->material,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio
        ]);
        // return redirect()->route('demandas.showProveedor', $demanda_id)->with('success', 'Se agregó correctamente el material');
        return view('oferta.detalle_oferta', compact('demanda', 'oferta'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $oferta = Oferta::find($id);
        $fecha =  Carbon::parse($oferta->fecha_entrega);
        // dd($fecha->format('d-m-Y'));
        $oferta->fecha_entrega = $fecha->format('d-m-Y');
        // dd($ofertas);
        return view('oferta.show_detalle_oferta', compact('oferta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalle = DetalleOferta::find($id);
        return view('oferta.edit_detalle', compact('detalle'));
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
        $detalle_id = $request->detalle_id;
        $detalle = DetalleOferta::find($detalle_id);
        $oferta = $detalle->oferta;
        $demanda = $oferta->demanda;
        // dd($demanda);
        $detalle->update([
            // 'oferta_id' => $oferta->id,
            'nombre' => $request->material,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio
        ]);
        return view('oferta.detalle_oferta', compact('demanda', 'oferta'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $detalle = DetalleOferta::find($id);
            $oferta = $detalle->oferta;
            // return $detalle;
            // return $oferta;
            $demanda = $oferta->demanda;
            // return $demanda;    
            if ($detalle) {
                $detalle->delete();
                // Acciones adicionales después de la eliminación (si es necesario)
                return view('oferta.detalle_oferta', compact('demanda', 'oferta'));
            } else {
                // Manejar caso en que no se encuentra el detalle con el ID dado
            }
        } catch (\Exception $e) {
            // Manejar la excepción (puedes imprimir el mensaje para depuración)
            dd($e->getMessage());
        }
    }
}
