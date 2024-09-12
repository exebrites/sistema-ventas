<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\Material;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\DetallePedido;
use App\Events\HolaMundoEvento;
use Illuminate\Validation\Rule;
use App\Models\RegistroMaterial;
use Illuminate\Support\Facades\Mail;
use App\Events\RegistroMaterialEvent;
use App\Mail\ReposicionStockMailable;
use App\Models\Oferta;
use App\Models\Recepcion;
use App\Models\StockVirtual;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Config;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiales = Material::all();
        foreach ($materiales as $key => $material) {
            $fecha =  Carbon::parse($material->fecha_adquisicion);
            $material->fecha_adquisicion = $fecha->format('d-m-Y');
        }
        return view('material.index', compact('materiales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return   $request;
        try {

            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                // 'descripcion'=>['required',,
                'cod' => ['required', 'string', 'max:50', Rule::unique('materiales', 'cod_interno')],
                'stock' => ['numeric', 'min:1'],
                'f_adquisicion' => ['required', 'date'],
                'f_vencimiento' => ['date'],
                'precio_compra' => ['required', 'numeric', 'min:0', 'max:100000'],
            ]);
        } catch (ValidationException $e) {
            // dd($e);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $material = Material::create([
            'nombre' => strtoupper($request->nombre),
            'descripcion' => $request->descripcion,
            'cod_interno' => $request->cod,
            'stock' => $request->stock,
            // 'unidad_medida' => $request->medida,
            'fecha_adquisicion' => $request->f_adquisicion,
            'fecha_vencimiento' => Carbon::now()->addYears(10)->format('Y-m-d'),
            // 'notas' => null,
            'precio_compra' => $request->precio_compra

        ]);
        // dd($material);
        // event(new RegistroMaterialEvent($material));
        StockVirtual::actualizar_stock_virtual();
        return redirect()->route('materiales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
        return view('material.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::find($id);
        return view('material.edit', compact('material'));
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


        try {

            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                // 'descripcion'=>['required',,
                'cod' => ['required', 'string', 'max:50', Rule::unique('materiales', 'cod_interno')->ignore($request->id)],
                'stock' => ['numeric', 'min:1'],
                'f_adquisicion' => ['required', 'date'],
                'f_vencimiento' => ['date'],
                'precio_compra' => ['required', 'numeric', 'min:0', 'max:100000'],
            ]);
        } catch (ValidationException $e) {
            // dd($e);
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // 'notas' => $request->notas,
        Material::find($request->id)->update([
            'nombre' => strtoupper($request->nombre),
            'descripcion' => $request->descripcion,
            'cod_interno' => $request->cod,
            'stock' => $request->stock,
            // 'unidad_medida' => $request->medida,
            'fecha_adquisicion' => $request->f_adquisicion,
            // 'fecha_vencimiento' => $request->f_vencimiento,
            // 'notas' => null,
            'precio_compra' => $request->precio_compra

        ]);
        StockVirtual::actualizar_stock_virtual();
        return redirect()->route('materiales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $material = Material::find($id);
        $material->delete();

        return redirect()->route('materiales.index');
    }
    /**
     * REPONER STOCK
     * Se utilizan estas funciones cuando queres reponer stock de materiales
     * Por ejemplo: tengo 5 materiales X y quiero cambiar a 10 materiales X
     */
    public function stock($id)
    {

        $material = Material::find($id);
        $fecha =  Carbon::parse($material->fecha_adquisicion);
        $material->fecha_adquisicion = $fecha->format('d-m-Y');
        return view('material.actualizar_stock', compact('material'));
    }
    public function stock_update(Request $request)
    {

        $material = Material::find($request->material_id);
        $material->update([
            'stock' => $material->stock + $request->cantidadStock,
            'f_adquisicion' => $request->fechaReposicion
        ]);
        return view('material.actualizar_stock', compact('material'));
    }

    /**
     * FIN REPONER STOCK
     */



    //  ($id, $cantidad)
    public function materiales_necesarios($id)
    {
        $detallePedido = DetallePedido::find($id);
        return view('material.materiales_necesarios', compact('detallePedido'));
    }
    public function generar_material(Request $request)
    {
        //recepciona el ID de cada material con la cantidad solicitada

        $ListaPedido = $request->cantidades;
        //filtra los nulos
        $datosFiltrados = array_filter($ListaPedido, function ($valor) {
            return $valor !== null;
        });
        $materiales = Material::all();
        $coleccion = [];

        //en base a las claves  trae el material correspondiente, coloca las coincidencia dentro del array asociativo, donde cada clave es 
        //el id del material, y determina si son para reponer o los materiales. 
        foreach ($datosFiltrados as $key => $value) {
            $material = $materiales->find($key);


            // si 20 - 1 <= 0 => reposicion =  false
            // si 50 - 100 <= 0 =>  reposicion = true
            if (($material->stock - $value) <= 0) {
                // reposcion
                $coleccion[$key] = [
                    'nombre' => $material->nombre,
                    'cantidad_solicitada' => $value,
                    'Cantidad_disponible' => $material->stock,
                    'reposicion' => true
                ];
            } else {
                // no hace falta reponer
                $coleccion[$key] = [
                    'nombre' => $material->nombre,
                    'cantidad_solicitada' => $value,
                    'Cantidad_disponible' => $material->stock,
                    'reposicion' => false
                ];
            }
        }
        $datos = $coleccion;
        //filtra en datosFiltrados solo aquellos que son para reponer
        $datosFiltrados = array_filter($datos, function ($item) {
            return $item['reposicion'] === true;
        });
        //enviar al correo del proveedro. PARAMETRIZAR
        // Mail::to('exe@gmail.com')->send(new ReposicionStockMailable($datosFiltrados));

        return view('material.lista_materiales', ['datos' => $datos]);
    }

    public function listarProductos()
    {
        $productos = Producto::all();
        return view('material.listaProductos', compact('productos'));
    }

    public function verStock()
    {
        $pedidos = Pedido::where('estado_id', 5)->get();
        $listaMateriales = Pedido::listaMateriales($pedidos);
        // return $listaMateriales;
        $materialesStock = [];
        foreach ($listaMateriales as $key => $mat) {
            # code...
            $material = Material::find($mat['id']);
            $diferencia = $material->stock  - $mat['cantidad'];
            $materialesStock[$key] = [
                'id' => $mat['id'],
                'nombre' => $material->nombre,
                'stockActual' => $material->stock,
                'stockSolicitado' => $mat['cantidad'],
                'diferenciaStock' => $diferencia,
            ];
        }
        // return $materialesStock;
        return view('material.lista_materiales', compact('materialesStock'));
    }


    public function recepcion($id)
    {
        $oferta = Oferta::find($id);

        return view('material.recepcion', compact('oferta'));
    }
    public function entradaMateriales(Request $request)
    {

        //1. RECEPCION Y ACTUALIZACION DE STOCK 
        $datos = $request->all();

        // Acceder a los datos
        $materialIds = $datos['material_id'];
        $nombres = $datos['nombre'];
        $cantidades = $datos['cantidad'];
        $precios = $datos['precio'];
        $entradas = $datos['entrada'];



        // dd([$materialIds, $nombres, $cantidades, $precios, $entradas, $materialStock = Material::find($materialIds[0])]);
        // Ahora puedes procesar o almacenar estos datos según tus necesidades
        foreach ($materialIds as $key => $materialId) {
            // Accede a los datos asociados

            // $material_id = $materialIds[0];
            $cantidad = $cantidades[$key];
            Recepcion::create([
                'material_id' => $materialId,
                'cantidad' => $cantidad
            ]);
        }
        return redirect()->route('asignacion')->with('success', 'Se agregó correctamente los materiales a stock');
    }
}
