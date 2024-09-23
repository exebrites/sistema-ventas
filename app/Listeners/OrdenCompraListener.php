<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\Oferta;
use App\Models\Pedido;
use App\Models\Demanda;
use App\Models\Material;
use App\Events\OrdenCompra;
use App\Models\StockVirtual;
use App\Models\DetalleDemanda;
use App\Models\RegistroPedidoDemanda;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\Rules\Exists;

class OrdenCompraListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrdenCompra  $event
     * @return void
     */
    public function handle(OrdenCompra $event)
    {

        $EN_CONFIRMACION = 'en-confirmacion';
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
        $ultimaDemanda = Demanda::where('estado', $EN_CONFIRMACION)->latest()->first();
        // retorna la ultima demanda que no se haya enviado a los proveedores 
        // luego de eso si existe alguna significa que hay que actualizar la orden de compra con los nuevos pedidos que ingresaron mas los que ya estaban en esa orden de compra
        // en caso que no exista una ultima orden de compra lo que hay que hacer es crear una 
        $fecha_cierre = env('FECHA_CIERRE');
        $fecha_cierre = Carbon::parse($fecha_cierre);
        //    se establece una fecha de cierre con la variable de entorno FECHA_CIERRE en el archivo .env
        // dd($ultimaDemanda);

        $ultimaOferta = Oferta::where('estado', 'aceptada')->latest()->first(); //acá
        // $this->actualizar_stock_virtual();
        if ($ultimaDemanda) {
            // dd('demanda para actualizar ');
            $pedidos = Pedido::pedidosSinOrden();
            if (count($pedidos) == 0) {
                return "pedidos vacio";
            } else {
                // dd('Hay pedidos sin orden de compra asociados');
                $lista = Pedido::listaMateriales($pedidos);
                // dd($lista);
                $materiales_orden_compra = [];
                foreach ($ultimaDemanda->detalleDemandas as $key => $detalle) {
                    $materiales_orden_compra[] = [
                        'id' => $detalle->materiales_id,
                        'cantidad' => $detalle->cantidad
                    ];
                }
                // dd($materiales_orden_compra);

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
                //objetivo 
                // Crear una orden de compra teniendo en cuenta el stock previsto
                // dd("oferta aceptada");
                $pedidos = Pedido::pedidosSinOrden();
                $listaMaterilesNecesarios = Pedido::listaMateriales($pedidos);
                if ($listaMaterilesNecesarios === null) {
                    dd("lista vacia");
                }
                // stock previsto = stock virtual + Oferta
                $stock_previsto = [];
                foreach ($ultimaOferta->detalleOferta as  $detalle) {
                    $cantidadOferta = $detalle->cantidad;
                    $material_stock_virtual = StockVirtual::where('material_id', $detalle->material_id)->first();
                    $material_stock_virtual->cantidad = $material_stock_virtual->cantidad + $cantidadOferta;
                    $stock_previsto[]  = $material_stock_virtual;
                }
                $demanda = Demanda::create([
                    'estado' => 'en-confirmacion',
                    'fecha_cierre' => $fecha_cierre,
                ]);
                //objetivo :
                // realizar la comparacion entre stock previsto y lista de materiales 
                foreach ($listaMaterilesNecesarios as $materialLista) {
                    //busco en el array de stock previsto el material que coincide con la lista de materiales necesarios
                    //y lo guardo en la variable $material_stock_previsto
                    //si no existe el material en el array de stock previsto, la variable $material_stock_previsto sera null
                    $material_stock_previsto = collect($stock_previsto)->firstWhere('material_id', $materialLista['id']);
                    $virtual_stock = StockVirtual::where('material_id', $materialLista['id'])->first();
                    if (!$material_stock_previsto) {

                        $comparacion =    $virtual_stock->cantidad - $materialLista['cantidad'];
                    } else {
                        $comparacion  = $material_stock_previsto->cantidad - $materialLista['cantidad'];
                    }
                    if ($comparacion >= 0) {

                        $virtual_stock->update([
                            'cantidad' => $virtual_stock->cantidad - $materialLista['cantidad'],
                        ]);
                    } else {

                        $virtual_stock->update([
                            'cantidad' => $comparacion,
                        ]);

                        $detalle = DetalleDemanda::create([
                            'demandas_id' => $demanda->id,
                            'materiales_id' => $materialLista['id'],
                            'cantidad' =>  -$comparacion
                        ]);
                    }
                }
                if ($demanda->detalleDemandas->count() > 0) {
                    $pedidos = config('pedidos');
                    foreach ($pedidos as $key => $id) {
                        RegistroPedidoDemanda::create([
                            'pedido_id' => $id,
                            'demanda_id' => $demanda->id
                        ]);
                    }
                } else {
                    $demanda->delete();
                }
            } else {
                // dd("No hay demanda ni Oferta aceptada");
                $listaMaterilesNecesarios = Pedido::listaMateriales(Pedido::pedidosSinOrden());

                if ($listaMaterilesNecesarios != null) {
                    // dd('5');
                    $demanda = Demanda::create([
                        'estado' =>  $EN_CONFIRMACION,
                        'fecha_cierre' => $fecha_cierre,
                    ]);
                    session()->flash('message', 'Se ha creado una nueva orden de compra');
                    $pedidos = config('pedidos');
                    foreach ($pedidos as $id) {
                        RegistroPedidoDemanda::create([
                            'pedido_id' => $id,
                            'demanda_id' => $demanda->id
                        ]);
                    }

                    // dd($listaMaterilesNecesarios);
                    // dd('demanda y registro');
                    foreach ($listaMaterilesNecesarios as $material) {
                        $Materialstock = Material::find($material['id']);
                        if (($Materialstock->stock - $material['cantidad']) < 0) {
                            $detalle = DetalleDemanda::create([
                                'demandas_id' => $demanda->id,
                                'materiales_id' => $material['id'],
                                'cantidad' =>  - ($Materialstock->stock - $material['cantidad']),
                            ]);
                        }
                        // dd('detalle demanda');
                        $virtual_stock = StockVirtual::where('material_id', $material['id'])->first();
                        $virtual_stock->update([
                            'cantidad' => $virtual_stock->cantidad - $material['cantidad']
                        ]);
                        // dd('sv');
                    }
                }
            }
        }
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
    }
}
