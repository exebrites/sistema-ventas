<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use App\Models\Pedido;
use  App\Services\ShoppingCartService;
use App\Services\PedidoService;
use App\Contracts\ShoppingCartInterface;
use App\Services\ProductoService;
use App\Models\Cliente;

class MercadoPagoController extends Controller
{
    //

    public function success(ShoppingCartService $cart)
    {
        // return redirect()->route('shop')->with('success', 'Pago realizado con exito');
        $cart->clear();
        return view('success-mp');
    }
    public function pagar($id)
    {
        $pedido =  Pedido::find($id);
        return view('pagar', compact('pedido'));
    }
    public function createPaymentPreference(Request $request, PedidoService $pedidoService, ShoppingCartInterface $shoppingCart, ProductoService $productoService)
    {


        // 1 ) Creacion de pedido 
        $productosCarrito = $shoppingCart->getContent();

        // if ($productosCarrito->isEmpty()) {
        //     // return back()->withErrors(['error' => 'El carrito está vacío.']);
        // }

        // // foreach ($productosCarrito as $producto) {
        // //     $resultado = $productoService->control_stock($producto, $producto->quantity);
        // //     //posible error 
        // //     if ($resultado !== true) {
        // //         // return redirect()->back()->withErrors(['error' => $resultado]);
        // //     }
        // // }
        $cliente = Cliente::obtenerCliente(Auth::user());
        // if (!$cliente) {
        //     // return back()->withErrors(['error' => 'El usuario no está asociado a un cliente.']);
        // }
        $pedido = $pedidoService->crearPedido($cliente, $productosCarrito);


        // 2)  Creacion de preferencia con mercado pago 

        $this->authenticate();
        // Log::info('Autenticado con éxito');

        // Paso 1: Obtener la información del producto desde la solicitud JSON
        $product = $request->input('product'); // Asumiendo que envías un campo 'product' con los datos

        if (empty($product) || !is_array($product)) {
            return response()->json(['error' => 'Los datos del producto son requeridos.'], 400);
        }



        // Mount the array of products that will integrate the purchase amount
        // $items = array($product1, $product2);

        // Paso 2: Información del comprador (esto puedes obtenerlo desde el usuario autenticado) 
        // $payer = [
        //     "name" => $request->input('name', 'asd'), // Puedes obtener el nombre del request o usar un valor predeterminado
        //     "surname" => $request->input('surname', 'asd'),
        //     "email" => $request->input('email', 'uaasd@example.com'),
        // ];
        $payer = [
            "name" => 'exe', // Puedes obtener el nombre del request o usar un valor predeterminado
            "surname" => 'brites',
            "email" => 'exe@gmail.com',
        ];

        // Paso 3: Crear la solicitud de preferencia 
        $requestData = $this->createPreferenceRequest($product, $payer);

        // Paso 4: Crear la preferencia con el cliente de preferencia 
        $client = new PreferenceClient();

        try {
            $preference = $client->create($requestData);
            // dd($preference);
            return response()->json([
                'id' => $preference->id,
                'init_point' => $preference->init_point,
                // 'operation_type' => $preference->operation_type,
                // 'items' => $preference->items,
                // 'payer' => $preference->payer,
                'back_urls' => $preference->back_urls,
                // 'client_id' => $preference->client_id,
                // 'additional_info' => $preference->additional_info,
                'preference' => $preference
            ]);
        } catch (MPApiException $e) {

            // dd($error);
            // return response()->json([
            //     'error' => $error->getApiResponse()->getContent(),
            // ], 500);
            echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
            echo "Content: ";
            var_dump($e->getApiResponse()->getContent());
            echo "\n";
        } catch (Exception $e) {
            // dd($e);
            // return response()->json([
            //     'error' => $e->getMessage(),
            // ], 500);
            echo $e->getMessage();
        }
    }


    // Autenticación con Mercado Pago 
    protected function authenticate()
    {
        $mpAccessToken = config('services.mercadopago.token');
        if (!$mpAccessToken) {
            throw new Exception("El token de acceso de Mercado Pago no está configurado.");
        }
        MercadoPagoConfig::setAccessToken($mpAccessToken);
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }

    // Función para crear la estructura de preferencia 
    protected function createPreferenceRequest($items, $payer): array
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1

        ];

        $backUrls = [

            'success' => route('mercadopago.success'),
            'failure' => route('mercadopago.failed')

        ];

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "TIENDA ONLINE",
            "external_reference" => "12345678",
            "expires" => false,
            "auto_return" => 'approved',

        ];
        return $request;
    }
}
