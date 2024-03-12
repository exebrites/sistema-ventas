<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Oferta;
use App\Models\Pedido;
use App\Models\Demanda;
use App\Models\Material;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Models\DetalleDemanda;
use App\Models\DetalleOferta;
use App\Models\MaterialProveedor;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroPedidoDemanda;
use App\Models\StockVirtual;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use League\CommonMark\Extension\CommonMark\Parser\Inline\EscapableParser;
use Spatie\Permission\Models\Role;


class DemandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $demandas = Demanda::find(20);
        $demandas = Demanda::all();
        $demandas = $demandas->sortByDesc('id');
        $ofertas = Oferta::all();
        // dd($ofertas);
        foreach ($demandas as $key => $demanda) {
            $fecha =  Carbon::parse($demanda->fecha_cierre);
            $demanda->fecha_cierre = $fecha;
        }
        return view('demanda.index', compact('demandas', 'ofertas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request;
        $reponer = $request->all();

        $reponer = array_filter($reponer, function ($item) {
            return $item['reposicion'] === '1';
        });
        // return $reponer;
        // dd($reponer[3]);
        $proveedores = [];
        // {"id":3,"proveedor_id":3,"material_id":3,"precio_actual":3000,"precio_actualizado":123,"created_at":null,"updated_at":null}

        /** 
         * Si tenes que reponer los materiales 3 y 5 entonces
         * buscas los detalles donde estan relacionados con los proveedores luego
         * buscas la informacion de cada proveedor y la pasas a $proveedores
         */
        foreach ($reponer as $key => $value) {
            $mp = MaterialProveedor::where('material_id', $key)->get();
            // return $mp;
            foreach ($mp as  $value) {
                // // return $value;
                $p = Proveedor::find($value->proveedor_id);
                $proveedores[$value->proveedor_id] = $p;

                // {"id":3,"nombre_empresa":"proveedor3","nombre_contacto":"proveedor3","cuit":"1231312","telefono":"12312312","correo":"proveedor3@gmail.com"


                // return $p;
            }
        }
        // dd($proveedores);
        // return $proveedores;
        return view('demanda.create', compact('reponer', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $demanda = $request->all();


        // return $demanda;
        $string = $demanda['materiales'];
        // Dividir la cadena en base al símbolo de pipe
        // $i = 6;
        // dd($string);
        // Almacenar la demanda de manteriales
        $demanda = Demanda::create([
            'FK' => 6,
            'nombre' => "tupapa",
            'cantidad' => 2
        ]);
        foreach ($string as $key => $value) {

            $datos = explode('|', $value);

            DetalleDemanda::create([
                'demandas_id' => $demanda->id,
                'materiales_id' => $datos[0],
                'cantidad' => $datos[2]
            ]);
        }


        return redirect()->route('demandas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        $user = Auth::user();
        $proveedor = Proveedor::where('correo', $user->email)->first();
        // $ofertas = Oferta::where('proveedor_id', $user->id)->get();
        // $oferta_id = 1;
        // $ofertas = Oferta::find($oferta_id);
        $demanda = Demanda::find($id);

        $fecha =  Carbon::parse($demanda->fecha_cierre);
        $demanda->fecha_cierre = $fecha->format('d-m-Y');
        $fecha =  Carbon::parse($demanda->created_at);
        // dd($fecha->format('d-m-Y'));
        $demanda->created_at = $fecha->format('d-m-Y');
        $proveedoresAsociados = $demanda->demandaProveedor;

        $ofertas = Oferta::where('demanda_id', $demanda->id)->get();

        foreach ($ofertas as $key => $oferta) {
            $fecha =  Carbon::parse($oferta->fecha_entrega);
            // dd($fecha->format('d-m-Y'));
            $oferta->fecha_entrega = $fecha->format('d-m-Y');
        }

        return view('demanda.show', compact('demanda', 'proveedor', 'proveedoresAsociados', 'ofertas'));
    }
    public function showProveedor($id)
    {
        $user = Auth::user();
        $proveedor = Proveedor::where('correo', $user->email)->first();
        $demanda = Demanda::find($id);
        // return view('demanda.show_proveedor',  compact('demanda', 'proveedor'));
        return view('demanda.show_proveedor', compact('demanda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demanda = Demanda::find($id);
        $fecha =  Carbon::parse($demanda->fecha_cierre);
        $demanda->fecha_cierre = $fecha;
        return view('demanda.edit', compact('demanda'));
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
        // return $request;
        $demanda = Demanda::find($request->id);
        // Convierte la fecha al formato de Carbon
        $fecha = Carbon::parse($request->f_cierre);


        // La idea es actualizar la fecha pero solo aquellas que sean un dia mas de la fecha actual



        if ($fecha->isPast()) {
            // nose se puede actualizar  a esa fecha porque es viejak
            return redirect()->route('demandas.edit', $request->id)->with('error', 'No se puede actualizar a esa fecha porque ya pasó ');
        } else {
            // fecha actualizada correctamente
            $demanda->update([
                'fecha_cierre' => $fecha
            ]);
            return redirect()->route('demandas.index')->with('success', 'Fecha actualizada correctamente.');;
        }
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


    public function comprar(Request $request)
    {
        $materiales = $request->all()['materiales'];
        return $materiales;
    }
    public function OrdenCompra()
    {
        // bien ahora la idea es crear la orden de comprar
        // para eso hay que crear cada detalle
        // el detalle es como el renglon un material tanta cantidad una sola vez
        // se crea y se modifica hasta que se confirme la orden de comprar
        // tambien necesito poner un estado de confirmacion a la orden de compra para luego cerrar y  pasar a la cotizacion
        // si se agregan nuevo pedidos hay que modificar la orden de comprar
        // siempre y cuando no se confirme la orden de coompra
        // en caso de confirmacion y hay nuevos pedidos hay que crear una nueva orden de compra
        // una orden de compra que luego se envia al proveedor 

        // En el caso de tener una oferta aceptada hay que calcular el stock y la lista de materiales sobre el stock virtual
        $demanda = null;
        $ultimaDemanda = Demanda::where('estado', 'en-confirmacion')->latest()->first();
        // retorna la ultima demanda que no se haya enviado a los proveedores 
        // luego de eso si existe alguna significa que hay que actualizar la orden de compra con los nuevos pedidos que ingresaron mas los que ya estaban en esa orden de compra
        // en caso que no exista una ultima orden de compra lo que hay que hacer es crear una 
        $fecha_cierre = env('FECHA_CIERRE');
        $fecha_cierre = Carbon::parse($fecha_cierre);
        //    se establece una fecha de cierre con la variable de entorno FECHA_CIERRE en el archivo .env
        // dd($ultimaDemanda);

        $ultimaOferta = Oferta::where('estado', 'aceptada')->latest()->first();
        if ($ultimaDemanda) {
            // dd('1');
            $pedidos = Pedido::pedidosSinOrden();
            if (count($pedidos) == 0) {
                return "pedidos vacio";
            } else {
                // dd('1.2');
                $lista = Pedido::listaMateriales($pedidos);
                // dd($lista);
                $materiales_orden_compra = [];
                foreach ($ultimaDemanda->detalleDemandas as $key => $detalle) {
                    $materiales_orden_compra[] = [
                        'id' => $detalle->materiales_id,
                        'cantidad' => $detalle->cantidad
                    ];
                }


                $resultado = Demanda::combinar($lista, $materiales_orden_compra);

                $materiales_orden_compra = $resultado;
                // dd($materiales_orden_compra);
                // dd('1.3');
                foreach ($materiales_orden_compra as $key => $material) {
                    $virtual_stock = StockVirtual::where('material_id', $material['id'])->first();
                    $virtual_stock->update([
                        'cantidad' => -$material['cantidad']
                    ]);
                }

                foreach ($materiales_orden_compra as $key => $material) {
                    $verificar = DetalleDemanda::where('demandas_id', $ultimaDemanda->id)
                        ->where('materiales_id',  $material['id'])
                        ->exists();
                    if ($verificar) {
                        // dd('1.3.1');
                        $pedidos = config('pedidos');
                        foreach ($pedidos as $key => $id) {
                            RegistroPedidoDemanda::create([
                                'pedido_id' => $id,
                                'demanda_id' => $ultimaDemanda->id
                            ]);
                        }
                        DetalleDemanda::where('demandas_id', $ultimaDemanda->id)
                            ->where('materiales_id',  $material['id'])
                            ->update(['cantidad' => $material['cantidad']]);
                    } else {
                        // dd('1.3.2');
                        DetalleDemanda::create(
                            [
                                'demandas_id' => $ultimaDemanda->id,
                                'materiales_id' => $material['id'],
                                'cantidad' => $material['cantidad']

                            ]
                        );
                    }
                }
            }
            // dd("fin");
        } else {
            if ($ultimaOferta) {

                // dd($ultimaOferta);
                $pedidos = Pedido::pedidosSinOrden();
                $listaMaterilesNecesarios = Pedido::listaMateriales($pedidos);
                // dd([$pedidos, $listaMaterilesNecesarios, $ultimaOferta->detalleOferta[0]]);

                if ($listaMaterilesNecesarios != null) {
                    // dd('3');
                    $arrayMateriales = [];
                    foreach ($listaMaterilesNecesarios as $key => $material) {
                        $virtual_stock = StockVirtual::where('material_id', $material['id'])->first();
                        $materialOferta = $ultimaOferta->detalleOferta()->where('material_id', $material['id'])->first();
                        if ($materialOferta != null) {
                            $arrayMateriales[$key] = [
                                'id' => $material['id'],
                                'cantidad' => $materialOferta->cantidad + $virtual_stock->cantidad - $material['cantidad']
                            ];
                        } else {
                            $arrayMateriales[$key] = [
                                'id' => $material['id'],
                                'cantidad' =>  $virtual_stock->cantidad - $material['cantidad']
                            ];
                        }
                    }
                    // dd($arrayMateriales);                    
                    // dd('crear orden de compra');
                    $demanda = Demanda::create([
                        'estado' => 'en-confirmacion',
                        'fecha_cierre' => $fecha_cierre,
                    ]);
                    foreach ($arrayMateriales as $key => $material) {
                        if ($material['cantidad'] >= 0) {
                            // dd('actualizar stock virtual');
                            $virtual_stock = StockVirtual::where('material_id', $material['id'])->first();
                            $virtual_stock->update([
                                'cantidad' => $material['cantidad']
                            ]);
                        } else {
                            // dd('Agregar material');
                            $detalle = DetalleDemanda::create([
                                'demandas_id' => $demanda->id,
                                'materiales_id' => $material['id'],
                                'cantidad' =>  -$material['cantidad']
                            ]);
                            $virtual_stock = StockVirtual::where('material_id', $material['id'])->first();
                            $virtual_stock->update([
                                'cantidad' =>  $material['cantidad']
                            ]);
                        }
                    }
                    if ($demanda->detalleDemandas->count() > 0) {
                        // dd('detalles asociados');
                        $pedidos = config('pedidos');
                        foreach ($pedidos as $key => $id) {
                            RegistroPedidoDemanda::create([
                                'pedido_id' => $id,
                                'demanda_id' => $demanda->id
                            ]);
                        }
                    } else {
                        // dd('eliminar orden de compra');
                        $demanda->delete();
                        // dd('eliminacion con exito');
                    }
                }
            } else {
                // dd('4');
                $pedidos = Pedido::pedidosSinOrden();
                $listaMaterilesNecesarios = Pedido::listaMateriales($pedidos);
                // dd(
                //     [$pedidos, $listaMaterilesNecesarios]
                // );
                if ($listaMaterilesNecesarios != null) {
                    // dd('5');
                    $demanda = Demanda::create([
                        'estado' => 'en-confirmacion',
                        'fecha_cierre' => $fecha_cierre,
                    ]);
                    $pedidos = config('pedidos');
                    foreach ($pedidos as $key => $id) {
                        RegistroPedidoDemanda::create([
                            'pedido_id' => $id,
                            'demanda_id' => $demanda->id
                        ]);
                    }
                    foreach ($listaMaterilesNecesarios as $key => $material) {
                        $Materialstock = Material::find($material['id']);
                        if (($Materialstock->stock - $material['cantidad']) < 0) {
                            $detalle = DetalleDemanda::create([
                                'demandas_id' => $demanda->id,
                                'materiales_id' => $material['id'],
                                'cantidad' =>  - ($Materialstock->stock - $material['cantidad']),
                            ]);
                        }
                        $virtual_stock = StockVirtual::where('material_id', $material['id'])->first();
                        $virtual_stock->update([
                            'cantidad' => $virtual_stock->cantidad - $material['cantidad']
                        ]);
                    }
                }
            }
        }
        $virtual_stock = StockVirtual::all();
        return $virtual_stock;
        // $detalle = $demanda->detalleDemandas;




        // una vez creada la orden de compra con un estado y una fecha de cierre 
        // se asocia que pedidos a esa orden de compra 
        // los pedidos estan asociados a una orden de compra para llevar registro de que orden de compra responden a que pedido

        // si la lista tiene algo signifca que es necesario reponer
        // de los materiales en stock quiero solo los que tiene diferencia negativa para asi crear la orden de compra
        // una vez asociados los pedidos
        // se crean los detalles de la orden de compra 
        // indicando los materiales y la cantidad a reponer 

        //en que caso que se tenga que crear una nueva orden de compra
        // se calcula la lista de materiales para los pedidos que no esten asociados a una orden de compra

        // lleva registro exacto de cuanto hay en stock, cuanto se solicita en total para todos los pedidos y cual es la diferencia

        // ahora, la nueva lista de materiales se tiene que calcular sobre la diferencia

        // stock tiene M1 2 
        // P1 usa M1 cantidad 2
        // el stock virtual previsto es de 0
        // cuando P2 usa M2 cantidad 5 
        // entonces 
        // stock virtual previsto es de -5
        // $pedidos = Pedido::where('estado_id', 5)->get();
        // // dd($pedidos);
        // $listaMateriales = Pedido::listaMateriales($pedidos);
        // // dd($listaMateriales);

        // $materialesStock = [];
        // foreach ($listaMateriales as $key => $mat) {
        //     # code...
        //     $material = Material::find($mat['id']);
        //     $diferencia = $material->stock  - $mat['cantidad'];
        //     $materialesStock[$key] = [
        //         'id' => $mat['id'],
        //         'nombre' => $material->nombre,
        //         'stockActual' => $material->stock,
        //         'stockSolicitado' => $mat['cantidad'],
        //         'diferenciaStock' => $diferencia,
        //     ];
        // }
        // dd($materialesStock);

        // revision de 
        // pedidos
        // listamateriales
        // materialesstock
        // REVISADO. PASA LAS PRUEBAS
        // dd($listaMaterilesNecesarios);
        // $materialesReponer = [];
        // recorre la lista de materiales necesarios
        // por cada material en la lista lo busca en la base de datos para comparar contra stock real
        // si la diferencia con stock es menor a cero es indicar que hay un faltante en stock y se agrega a la lista de materiales a reponer


        /** 
             si hay una orden de compra con una oferta aceptada que tenga los materiales solicitados se compara contra stock virtual

             sino contral stock real
         */




        // foreach ($listaMaterilesNecesarios as $key => $mat) {
        //     $material = Material::find($mat['id']);
        //     $diferencia = $materialesStock[$mat['id']]['diferenciaStock']  - $mat['cantidad'];
        //     if ($diferencia < 0) {
        //         $materialesReponer[$key] = [
        //             'id' => $mat['id'],
        //             // 'nombre' => $material->nombre,
        //             'diferenciaStock' => -$diferencia,
        //         ];
        //     }
        // }
        // dd($materialesReponer);

        // se realiza la prueba para 
        // pedidos
        // lista materiales necesarios
        // materiales reponer

        /**
              NO PASA LAS PRUEBAS. REVISION. CODIGO ENTRE ESTA PRUEBA Y LA ANTERIOR SUFRE MODIFICACIONES
         */




        // se realiza la prueba de dentro del if para 
        // materiales a reponer
        // demanda
        // pedidos 
        // register_shutdown_function
        // detalle

    }
    public function confirmarOrden($id)
    {
        $demanda = Demanda::find($id);
        $demanda->update(['estado' => 'confirmado']);
        return redirect()->route('demandas.index');
    }
}
