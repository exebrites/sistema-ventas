<?php

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Mail\prueba;
use App\Models\User;
use App\Models\Oferta;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Disenio;
use App\Models\Material;
use App\Models\Producto;
use Barryvdh\DomPDF\PDF;
use App\Models\Proveedor;
use App\Mail\PagoMailable;
use App\Mail\EstadoMailable;
use App\Models\StockVirtual;
use GuzzleHttp\Psr7\Request;
use App\Mail\DisenoRealizado;
use App\Models\DetalleOferta;
use App\Models\MaterialProveedor;
use App\Models\DetallePresupuesto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\RegistroPedidoDemanda;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Mail\UsuarioProveedorMailable;
use Illuminate\Routing\RouteRegistrar;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CartController;
use App\Http\Controllers\fileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BocetoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DemandaController;
use App\Http\Controllers\DisenioController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutContorller;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TuPedidoController;
use App\Http\Controllers\UsuariosController;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RegDemandaProveedor;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\ComprobanteController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\DetalleOfertaController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\DetalleProductoController;
use Symfony\Component\VarDumper\Caster\RedisCaster;
use App\Http\Controllers\MaterialProveedorController;
use App\Http\Controllers\DetallePresupuestoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoriaController;
use App\Mail\PedidoCancelado;
use App\Models\Demanda;
use App\Models\Pregunta;
use App\Models\Recepcion;
use App\Models\Respuesta;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('/demandas', DemandaController::class);
// Route::group(['middleware' => 'role:proveedor'], function () {
//     Route::resource('/demandas', DemandaController::class);
// });
Route::resource('/ofertas', OfertaController::class);
Route::get('/showproveedor{id}', [DemandaController::class, 'showProveedor'])->name('demandas.showProveedor');

Route::resource('/detalleoferta', DetalleOfertaController::class);
Route::get('/listado_ofertas', [OfertaController::class, 'listado_ofertas'])->name('listaOfertas');

Route::get('/finalizar_oferta/{id}', [OfertaController::class, 'finalizar_oferta'])->name('finalizar_oferta');
route::get('/confirmar_oferta/{id}', [OfertaController::class, 'confirmarOferta'])->name('confirmarOferta');
route::get('/detalleofertas/{demanda_id}/{oferta_id}/{material_id}', [DetalleOfertaController::class, 'crear'])->name('detalleofertas.crear');
route::get('/ofertascrear/{id}', [OfertaController::class, 'crear'])->name('ofertas.crear');

Route::resource('/respuestas', RespuestaController::class);

// Route::group(['middleware' => 'role:empresa'], function () {


// Route::resource('/demandas', DemandaController::class);
route::post('/grafico', [GraficoController::class, 'graficoBarra'])->name('grafico');
route::get('/grafico', [GraficoController::class, 'index'])->name('graficoIndex');
route::get('/grafico/clientes', [GraficoController::class, 'indexCliente'])->name('indexCliente');
route::post('/grafico/clientes', [GraficoController::class, 'graficoCliente'])->name('graficoCliente');
route::resource('/categorias', CategoriaController::class);
Route::resource('/disenios', DisenioController::class); //ver diseños para revisar con el cliente
Route::post('/descargar', [DisenioController::class, 'descargar'])->name('disenios_descargar');
Route::put('/actualizardisenio', [DisenioController::class, 'actualizar_disenio'])->name('actualizar_disenio');
Route::resource('/materiales', MaterialController::class);
route::get('/materiales/recepcion/{id}', [MaterialController::class, 'recepcion'])->name('recepcion');
route::post('/materiales/entrada/', [MaterialController::class, 'entradaMateriales'])->name('entradaMateriales');
Route::get('/stock{id}', [MaterialController::class, 'stock'])->name('materiales.stock');
Route::put('/actualizar_stock/{id}', [MaterialController::class, 'stock_update'])->name('materiales.stock_update');
Route::get('/materiales_necesarios/{id}', [MaterialController::class, 'materiales_necesarios'])->name('materiales_necesarios');
Route::post('/generar_materiales', [MaterialController::class, 'generar_material'])->name('generar_material');
Route::resource('/historialMateriales', MaterialProveedorController::class);
route::get('bocetos/show/{id}', [BocetoController::class, 'show'])->name('showBoceto');
route::post('/descargar_boceto', [BocetoController::class, 'descargar_boceto'])->name('descargar_boceto');
Route::resource('/proveedores', ProveedorController::class);
Route::get('/pago', [MailController::class, 'pago'])->name('pago');
Route::post('/comprobante', [MailController::class, 'comprobante'])->name('comprobante');
Route::resource('/comprobantes', ComprobanteController::class)->except([
    'store'  // Excluye la ruta POST automática generada por el resource
]);
// Route::resource('/ofertas', OfertaController::class);
Route::resource('entrega', EntregaController::class)->except([
    'store'  // Excluye la ruta POST automática generada por el resource
]);

Route::resource('/detalleproducto', DetalleProductoController::class);
Route::get('/detalleproducto/{id}', [DetalleProductoController::class, 'crear_detalle_producto'])->name('crear_detalle_producto');
Route::get('/detalleproducto/{producto_id}/{material_id}', [DetalleProductoController::class, 'editar'])->name('detalleproducto.editar');
Route::delete('/detalleproducto/{producto_id}/{material_id}', [DetalleProductoController::class, 'eliminar'])->name('detalleproducto.eliminar');

Route::resource('pedidos', PedidoController::class);
Route::resource('productos', ProductoController::class);
Route::resource('/preguntas', PreguntaController::class);
Route::resource('/bocetos', BocetoController::class)->except([
    'create',
    'show'  // Excluye la ruta POST automática generada por el resource
]);
Route::resource('clientes', ClienteController::class);
route::get('/recepcionpdf/{id}', [PdfController::class, 'generarPDF'])->name('pdfRecepcion');
route::get('/pdf', [PdfController::class, 'index'])->name('pdf');
route::get('/welcome', [InicioController::class, 'inicio'])->name('pag.inicio');
route::resource('/contacto', ContactoController::class);
Route::get('/ordenCompra', [DemandaController::class, 'ordenCompra'])->name('ordenCompra');
Route::get('/ordenCompra/confirmarOrden/{id}', [DemandaController::class, 'confirmarOrden'])->name('confirmar');
Route::resource('/detallepedidos', DetallePedidoController::class);


Route::post('/comprar', [DemandaController::class, 'comprar'])->name('comprar');
// });

// Route::group(['middleware' => 'role:admin'], function () {
// Rutas que requieren ser admin y empresa
Route::resource('roles', RoleController::class);
Route::resource('permisos', PermisosController::class);
route::get('roles/asociar/{id}', [RoleController::class, 'editRol'])->name('editRol');
route::put('roles/asociar/{id}', [RoleController::class, 'updateRol'])->name('updateRol');
Route::post('/roles/{roleId}/remove-permission', [RoleController::class, 'remover'])->name('remover');
Route::get('/users/{userId}/assign-multiple-roles-form', [UsuariosController::class, 'showAssignMultipleRolesForm'])->name('usuarios.showAssignMultipleRolesForm');
Route::post('/users/{userId}/assign-multiple-roles', [UsuariosController::class, 'assignMultipleRoles'])->name('usuarios.assignMultipleRoles');
Route::post('/users/{userId}/remove-multiple-roles', [UsuariosController::class, 'removeMultipleRoles'])->name("removerRoles");
Route::resource('/auditoria', AuditoriaController::class);
Route::resource('/usuarios', UsuariosController::class);
// });
Route::post('/add_boceto', [CartController::class, 'add_boceto'])->name('cart.store_boceto');
Route::post('/procesar', [PedidoController::class, 'creacion_pedido_detalles_pedido'])->name('procesarPedido.procesar')->middleware(['auth', 'verified']);
Route::get('/pedidoCliente', [PedidoController::class, 'pedidoCliente'])->name('pedidoCliente')->middleware(['auth', 'verified']);
Route::get('/detallePedido{id}', [PedidoController::class, 'detallePedido'])->name('pedido-detallePedido');

Route::get('/checkout', [CheckoutContorller::class, 'index'])->middleware(['auth', 'verified'])->name('checkout.index');
Route::get('/checkout{id}', [CheckoutContorller::class, 'show'])->middleware(['auth', 'verified'])->name('checkout.show');
Route::post('comprobantes/store', [ComprobanteController::class, 'store'])->name('comprobantes.store');
Route::post('entrega/store', [EntregaController::class, 'store'])->name('entrega.store');
route::get('/show_disenio{id}', [DisenioController::class, 'show_disenio'])->name('show_disenio'); // disenio y preguntas del lado cliente
route::get('/revision_disenio/{id}', [DisenioController::class, 'revision_disenio'])->name('revision_disenio'); //envia el disenio a revision lado empresa
Route::get('/buscar', [ProductoController::class, 'buscarProducto'])->name('busqueda');
route::get('/stock', [MaterialController::class, 'verStock'])->name('ver_stock');
Route::get('/pedido/cancelar/{id}', [PedidoController::class, 'cancelarPedido'])->name('cancelarPedido');
Route::get('/pedido/confirmar/{id}', [PedidoController::class, 'confirmarPedido'])->name('confirmarPedido');
Route::get('/bocetos/{id}', [BocetoController::class, 'create'])->name('bocetos.create');
Route::get('/perfilcliente', function () {
    $email = Auth::user()->email;
    // dd($email);
    $cliente = Cliente::where('correo', $email)->get();
    // dd($cliente);
    // return $cliente;
    return view('perfil', compact('cliente'));
})->name('miperfil');



route::get('/pedidoclientes/{pedido_id}', [TuPedidoController::class, 'verpedidos'])->name('verpedidos');
route::get('/pedidoclientes/producto/{detalle_id}', [TuPedidoController::class, 'verDisenio'])->name('verdisenio');

Route::get('/', [CartController::class, 'shop'])->name('shop');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/productos{id}', [ProductoController::class, 'detalle'])->name('producto.detalle');


route::get('/reset', function () {
    // $stock = Material::all();
    // foreach ($stock as $key => $material) {
    //     $stock_v = StockVirtual::find($material->id);
    //     $stock_v->update(['cantidad' => $material->stock]);
    // }
    // return redirect()->back();
    foreach (Material::cursor() as $material) {
        // Buscar StockVirtual por ID
        $stockVirtual = StockVirtual::find($material->id);

        // Verificar si se encontró StockVirtual
        if ($stockVirtual) {
            $stockVirtual->update(['cantidad' => $material->stock]);
        } else {
            // Manejar el caso en que no se encuentre StockVirtual
            // (por ejemplo, registrar un error o crear un nuevo registro)
        }
    }

    return $stockVirtual;
});

route::resource('/registrodemandasproveedores', RegDemandaProveedor::class);
route::get('/factura/{pedido_id}', [PdfController::class, 'generarFactura'])->name('factura');
route::get('/confirmacionproveedor/{proveedor_id}/{demanda_id}', [RegDemandaProveedor::class, 'confirmacion_proveedor_orden_compra'])->name('confirmacion_proveedor_orden_compra');



route::get('/otro', function () {
    return view('otro');
});


route::post('/auditoria/filtro/fecha', [AuditoriaController::class, 'filtroFecha'])->name('filtroFecha');


// route::get('/correos', function () {
//     $correo = 'exequiel@gmail.com';
//     $disenio = Disenio::find(68);
//     $pedido =  $disenio->detallePedido->pedidos;
//     $producto = $disenio->detallePedido->producto;
//     $cliente = $pedido->cliente;
//     $empresa = config('contacto.nombre');
//     $user = User::find(1);
//     $password = "tupapi";
//     Mail::to($correo)->send(new PagoMailable($pedido->id, $pedido->costo_total));
//     Mail::to($correo)->send(new DisenoRealizado($pedido, $producto, $cliente, $empresa));
//     Mail::to($correo)->send(new EstadoMailable($pedido->estado->descripcion, $cliente->nombre, $pedido->id));
//     Mail::to($correo)->send(new UsuarioProveedorMailable($user, $password));
// });


route::get('/data', function () {
    return view('data');
});


//rutas 28-08-24

route::get('/verpedido/{estado}', [InicioController::class, 'ver_pedido'])->name('ver_pedido');
route::get('/veroferta/{estado}', [InicioController::class, 'ver_oferta'])->name('ver_oferta');
route::get('/verpedidoboceto', [InicioController::class, 'ver_pedido_boceto'])->name('ver_pedido_boceto');
route::get('/verrevision', [InicioController::class, 'ver_pedido_disenio_revision'])->name('ver_pedido_disenio_revision');
route::get('/verpedidodisenioaprobado', [InicioController::class, 'ver_pedido_disenio_aprobado'])->name('ver_pedido_disenio_aprobado');

route::get('/virtual', function () {
    StockVirtual::actualizar_stock_virtual();
})->name('virtual');

route::get('/asignacion', function () {

    $demanda = Demanda::find(177);
    $ofertas = $demanda->oferta;
    $registros = $demanda->demandaPedido;
    $pedidos  = [];
    foreach ($registros as $reg) {
        # code...
        $pedidos[] = $reg->pedido;
    }
    $recepciones = Recepcion::all();
    return view('material.asignacionMateriales', compact('demanda', 'pedidos', 'ofertas', 'recepciones'));
})->name('asignacion');



route::get('/pedido_pdf/{pedido}', [PdfController::class, 'generarPDFDespacho'])->name('generarPDFDespacho');
route::get('/compararStock/{pedido}', [MaterialController::class, 'ver_stock'])->name('ver_stock');

Route::post('/actualizarStock/{producto}', [ProductoController::class, 'actualizarStock'])->name('actualizarStock');
require __DIR__ . '/auth.php';
