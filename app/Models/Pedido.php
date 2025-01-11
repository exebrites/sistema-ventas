<?php

namespace App\Models;

use App\Models\Estado;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Entrega;

class Pedido extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    use HasFactory;


    protected $table = "pedidos";
    protected $fillable = ['clientes_id', 'productos_id', 'disenios_id', 'fecha_inicio', 'fecha_entrega', 'estado_id', 'disenio_estado', 'cantidad', 'costo_total'];
    public function scopeActivo($query)
    {
        //11 estado cancelado
        $pedidos =  $query->where('estado_id', '!=', 11)->get();
        return $pedidos->sortBy('estado_id');
    }
    public function scopePedidosCliente($query, $cliente)
    {
        return $query->where('clientes_id', $cliente->id)->orderBy('id', 'desc')->get();
    }
    // funciones protegidas
    // el nombre del accesors en calmeCase igual al nombre del atributo
    protected function getFechaEntregaAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
    protected function getFechaInicioAttribute($fecha_inicio)
    {
        if ($fecha_inicio != null) {
            return Carbon::parse($fecha_inicio)->format('d-m-Y');
        }
    }

    public function entrega()
    {
        return $this->hasMany(Entrega::class, 'pedido_id', '');
    }

    public function diferenciaDias()
    {
        $hoy = Carbon::now();
        // Define la fecha específica
        $fechaEspecifica = Carbon::parse($this->fecha_inicio);
        // Calcula la diferencia en días, horas y minutos
        $diferencia = $hoy->diff($fechaEspecifica);
        // Imprime el resultado
        return $diferencia->days . "Dias-" . $diferencia->h . "hora-" . $diferencia->i . "min";
    }
    public function scopeNuevo($query)
    {
        return $query->where('estado', 'nuevo');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', '');
    }
    public function getPedidoNuevo($id)
    {


        $fecha_hoy = Carbon::today();
        $creacion = $this->find($id)->value('created_at');

        $creacion = Carbon::parse($creacion->format('Y-m-d'));
        $fecha = $fecha_hoy->eq($creacion);

        return $fecha;
    }
    public function getTotal()
    {
        $total = 0;

        foreach ($this->detallePedido as $detalle) {
            $total += $detalle->subtotal;
        }

        return $total;
    }

    //COMIENZO DE RELACIONES
    public function pedidoDemanda()
    {
        return $this->hasOne(registroPedidoDemanda::class, 'pedido_id', '');
    }
    public function detallePedido()
    {
        return $this->hasMany('\App\Models\DetallePedido', 'pedido_id', '');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id', 'id');
    }
    public function disenio()
    {
        return $this->belongsTo('\App\Models\Disenio', 'disenios_id', 'id');
    }
    public function comprobante()
    {
        return $this->hasOne('\App\Models\Comprobante', 'pedido_id', '');
    }
    //FIN DE RELACIONES

    public  function listaMaterialesPedidosProducto()
    {


        // la idea es traer la lista de materiales de cada producto y unificarlas en una sola lista para el pedido

        // tendras un array donde ir almacenando el valor final lo que seria el array C que esta vacio en un principio

        // luego tenes que ir trayendo la lista de materiales de cada producto enbase  a su proporcion

        // la primera vez se asignan todos los materiales del primero producto al array C

        // ya la segunda vez se van comparando y actualizando el array C en base a la existencia y cantidad

        // y generar una sumatoria de los materiales utilizados
        // como fin tnees que tener la lista total de materiales utlizados en el pedido


        // conocer la lista de materiales total que se utiliza en el pedido

        // acceder al pedido a los diferentes productos

        $detalles = $this->detallePedido;
        // dump($detalles);
        // Inicializa el array resultante C
        $arrayC = [];
        foreach ($detalles as $key => $detalle) {
            $cantidad = $detalle->cantidad;
            // dump($detalle->producto_id);
            $producto = $detalle->producto;
            $proporcion = $producto->proporcionCantidad($cantidad);
            $arrayA = $proporcion;

            // Combina los elementos de A y B en C
            foreach ($arrayA as $elementoA) {
                $idA = $elementoA['id'];
                $cantidadA = $elementoA['cantidad'];

                // Verifica si el elemento ya existe en C
                if (isset($arrayC[$idA])) {
                    // Si existe, suma las cantidades
                    $arrayC[$idA]['cantidad'] += $cantidadA;
                } else {
                    // Si no existe, agrega el elemento a C
                    $arrayC[$idA] = ['id' => $idA, 'cantidad' => $cantidadA];
                }
            }
        }

        // un pedido tendra varios productos por ende una lista de materiales para cada uno donde los materiales se pueden repetir en varios productos
        // lo que quiero es tener una lista unifica de todos los materiales que necesito para este pedido en particular.

        // Convierte el array asociativo C a un array indexado si es necesario
        // $arrayC = array_values($arrayC);


        return $arrayC;
    }
    public function listaMaterialesPedidos()
    {
        // la idea es traer la lista de materiales de cada producto y unificarlas en una sola lista para el pedido

        // tendras un array donde ir almacenando el valor final lo que seria el array C que esta vacio en un principio

        // luego tenes que ir trayendo la lista de materiales de cada producto enbase  a su proporcion

        // la primera vez se asignan todos los materiales del primero producto al array C

        // ya la segunda vez se van comparando y actualizando el array C en base a la existencia y cantidad

        // y generar una sumatoria de los materiales utilizados
        // como fin tnees que tener la lista total de materiales utlizados en el pedido


        // conocer la lista de materiales total que se utiliza en el pedido

        // acceder al pedido a los diferentes productos

        $detalles = $this->detallePedido;
        // dump($detalles);
        // Inicializa el array resultante C
        $arrayC = [];
        foreach ($detalles as $key => $detalle) {
            $cantidad = $detalle->cantidad;
            // dump($detalle->producto_id);
            $producto = $detalle->producto;
            $proporcion = $producto->proporcionCantidad($cantidad);
            $arrayA = $proporcion;

            // Combina los elementos de A y B en C
            foreach ($arrayA as $elementoA) {
                $idA = $elementoA['id'];
                $cantidadA = $elementoA['cantidad'];

                // Verifica si el elemento ya existe en C
                if (isset($arrayC[$idA])) {
                    // Si existe, suma las cantidades
                    $arrayC[$idA]['cantidad'] += $cantidadA;
                } else {
                    // Si no existe, agrega el elemento a C
                    $arrayC[$idA] = ['id' => $idA, 'cantidad' => $cantidadA];
                }
            }
        }

        // un pedido tendra varios productos por ende una lista de materiales para cada uno donde los materiales se pueden repetir en varios productos
        // lo que quiero es tener una lista unifica de todos los materiales que necesito para este pedido en particular.

        // Convierte el array asociativo C a un array indexado si es necesario
        $arrayC = array_values($arrayC);

        // acceso
        // contiene todos los numeros de pedidos que fueron utilizados para crear la lista de materiales
        $nrosPedidos = config('pedidos');
        // return $this->id;
        $pedido_id = $this->id;
        // agregar al array nro

        array_push($nrosPedidos, $pedido_id);

        // agregar a config/pedidos

        config(['pedidos' => $nrosPedidos]);

        return $arrayC;
    }

    public static function pedidosSinOrden()
    {
        //preproduccion
        $estado = 6;
        $pedidos = Pedido::where('estado_id', $estado)->get();
        // return $pedidos;
        $resultados = Pedido::join('registro_pedido_demandas', 'pedidos.id', '=', 'registro_pedido_demandas.pedido_id')->select('pedidos.*', 'registro_pedido_demandas.*')->get();

        // return $resultados;


        // filtra los pedidos que tienen una orden de compra
        $resultadoBusqueda = $pedidos;
        foreach ($resultados as $key => $resultado) {
            # code...

            $id = $resultado->pedido_id;
            $estadoBuscado = $id;
            $resultadoBusqueda = $resultadoBusqueda->filter(function ($resultadoBusqueda) use ($estadoBuscado) {
                return $resultadoBusqueda->id !== $estadoBuscado;
            });
        }
        return $resultadoBusqueda;
    }

    public  static function  listaMateriales($pedidos)
    {
        $arrayPedidos = $pedidos;
        $arrayC = [];
        // dd($arrayPedidos);
        foreach ($arrayPedidos as $key => $pedido) {
            // dump($pedido);
            $arrayA = $pedido->listaMaterialesPedidos();


            //*Registrar la lista de materiales por pedido

            //validar la comparacion con stock(?)


            foreach ($arrayA as $elementoA) {
                $idA = $elementoA['id'];
                $cantidadA = $elementoA['cantidad'];

                // Verifica si el elemento ya existe en C
                if (isset($arrayC[$idA])) {
                    // Si existe, suma las cantidades
                    $arrayC[$idA]['cantidad'] += $cantidadA;
                } else {
                    // Si no existe, agrega el elemento a C
                    $arrayC[$idA] = ['id' => $idA, 'cantidad' => $cantidadA];
                }
            }
        }
        // dd($arrayC);
        // dd("fin");
        return $arrayC;
    }
}
