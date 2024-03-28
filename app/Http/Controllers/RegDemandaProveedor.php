<?php

namespace App\Http\Controllers;

use App\Models\Demanda;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Models\DemandaProveedor;

class RegDemandaProveedor extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $id;
        // $proveedores = Proveedor::all();
        // return view('demanda.demandaproveedor', compact('proveedores'));
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
        // return $request;
        $proveedores = $request['proveedores'];

        // Falta la recepcion de los diferentes proveedores donde el gerente elije
        //     implementar Select 2 


        $demanda_id = $request->demanda_id;

        foreach ($proveedores as $key => $proveedor_id) {
            DemandaProveedor::create([
                'demanda_id' => $demanda_id,
                'proveedor_id' => $proveedor_id
            ]);
        }



        return redirect()->route('demandas.show', $demanda_id)->with('success', 'Proveedores asociados con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demanda = Demanda::find($id);
        $proveedores = Proveedor::all();
        return view('demanda.demandaproveedor', compact('proveedores', 'demanda'));
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
        $reg =  DemandaProveedor::find($id);
        $reg->delete();
        return redirect()->back();
    }
}
