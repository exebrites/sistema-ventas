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
use App\Models\Compra;
use App\Models\Entrega;
use App\Services\EntregaService;
use MercadoPago\Payment;
use MercadoPago\MerchantOrder;
use App\Models\Estado;
use Hamcrest\Arrays\IsArray;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\MerchantOrder\MerchantOrderClient;

class MercadoPagoController extends Controller
{
    //
    private $notification_url;
    public function __construct()
    {
        $this->notification_url = config('services.mercadopago.notification_url') . '/api/notificar';
    }
    public function notificar(Request $request)
    {
        $this->authenticate();

        // Log::info('Notificacion de mercadopago', [$request->all()]);

        // return "ok";

        $tipo = null;
        if (isset($request["topic"])) {
            $tipo = $request["topic"];
        } elseif (isset($request["type"])) {
            $tipo = $request["type"];
        }



        // Verificion solo por payment
        switch ($tipo) {
            case "payment":
                $id = isset($request['data_id']) ? $request['data_id'] : $request['id'];
                $client = new PaymentClient();
                $payment = $client->get($id);
                if ($payment->status == 'approved') {
                    $external_reference = $payment->external_reference;
                    $compra = Compra::find($external_reference);
                    $compra->estado = true;
                    $compra->save();
                }
                
                break;
        }

        // no funca

        // verificacion de los pagos de marcadog pago atraves de las notificaciones payment y merchant_order


        // $merchant_order = null;
        // switch ($tipo) {
        //     case "payment":

        //         $id = isset($request['data_id']) ? $request['data_id'] : $request['id'];
        //         $client = new PaymentClient();
        //         $payment = $client->get($id);
        //         $payment_json = json_encode($payment);
        //         return $payment_json;
        //         // // Get the payment and the corresponding merchant_order reported by the IPN.
        //         // $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
        //         return "payment";
        //         break;
        //     case "merchant_order":

        //         $id  = $request['id'];

                // $merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
                // Log::info('Notificacion de merchant_order', ['$request["data"]["id"]']);

        //         $order = new MerchantOrderClient();

        //         $merchant_order =  $order->get($id);
        //         // return json_encode($merchant_order);
        //         // return "request";
        //         break;
        // }
 

        //verificacion de pago total y suma de los payments
        
        // $paid_amount = 0;
        // foreach ($merchant_order->payments as $payment) {
        //     if ($payment['status'] == 'approved') {
        //         $paid_amount += $payment['transaction_amount'];
        //     }
        // }
        // return $paid_amount;
        // // If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
        // if ($paid_amount >= $merchant_order->total_amount) {
        //     if (count($merchant_order->shipments) > 0) { // The merchant_order has shipments
        //         if ($merchant_order->shipments[0]->status == "ready_to_ship") {
        //             print_r("Totally paid. Print the label and release your item.");
        //         }
        //     } else { // The merchant_order don't has any shipments
        //         print_r("Totally paid. Release your item.");
        //     }
        // } else {
        //     print_r("Not paid yet. Do not release your item.");
        // }
        return http_response_code(200);
    }
    public function success(ShoppingCartService $cart)
    {
        $cart->clear();
        return view('success-mp');
    }
    public function pagar($id)
    {
        $pedido =  Pedido::find($id);
        return view('pagar', compact('pedido'));
    }
    public function createPaymentPreference(EntregaService $entregaService, Request $request, PedidoService $pedidoService, ShoppingCartInterface $shoppingCart, ProductoService $productoService)
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
        $shoppingCart->clear();

        // 2)  creacion de lugar de entrega
        $datosEntrega = $request->input('datosEntrega');
        // return response()->json($datosEntrega['direccion']);
        if (empty($datosEntrega) || !is_array($datosEntrega)) {
            return response()->json(['error' => 'Los datos del producto son requeridos.'], 400);
        }
        $entregaService->create($datosEntrega, $pedido->id);

        // 3)  Creacion de preferencia con mercado pago
        $this->authenticate();
        $product = $request->input('product'); // Asumiendo que envías un campo 'product' con los datos
        if (empty($product) || !is_array($product)) {
            return response()->json(['error' => 'Los datos del producto son requeridos.'], 400);
        }
        $payer = [
            "name" => 'exe', // Puedes obtener el nombre del request o usar un valor predeterminado
            "surname" => 'brites',
            "email" => 'exe@gmail.com',
        ];
        $requestData = $this->createPreferenceRequest($product, $payer);

        // Paso 4: Crear la preferencia con el cliente de preferencia
        $client = new PreferenceClient();
        try {
            $preference = $client->create($requestData);
            return response()->json([
                'id' => $preference->id,
                'init_point' => $preference->init_point,
                'back_urls' => $preference->back_urls,
                'preference' => $preference
            ]);
        } catch (MPApiException $e) {
            echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
            echo "Content: ";
            var_dump($e->getApiResponse()->getContent());
            echo "\n";
        } catch (Exception $e) {
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

        $compra =  new Compra();
        $compra->save();
        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "TIENDA ONLINE",
            "external_reference" => $compra->id,
            "expires" => false,
            "auto_return" => 'approved',
            "notification_url" => $this->notification_url,
        ];
        return $request;
    }
}
