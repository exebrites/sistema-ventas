<?php

use App\Http\Controllers\AuditoriaController;
use App\Mail\prueba;
use App\Models\User;
use App\Models\Oferta;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Material;
use App\Models\Producto;
use Barryvdh\DomPDF\PDF;
use App\Models\Proveedor;
use App\Mail\PagoMailable;
use App\Models\StockVirtual;
use GuzzleHttp\Psr7\Request;
use App\Models\DetalleOferta;
use App\Models\MaterialProveedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutContorller;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuariosController;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RegDemandaProveedor;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\ComprobanteController;
use App\Http\Controllers\DetalleOfertaController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\DetalleProductoController;
use App\Http\Controllers\MaterialProveedorController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

// ------------RUTAS DEL CLIENTE----------

Route::resource('/preguntas', PreguntaController::class);
Route::resource('/respuestas', RespuestaController::class);

//RUTAS ENTREGA
Route::resource('entrega', EntregaController::class)->except([
    'store'  // Excluye la ruta POST automática generada por el resource
])->middleware('role:admin');
Route::post('entrega/store', [EntregaController::class, 'store'])->name('entrega.store');



//RUTA BOCETO
// Route::resource('/bocetos', BocetoController::class);
Route::resource('/bocetos', BocetoController::class)->except([
    'create', 'show'  // Excluye la ruta POST automática generada por el resource
]);
Route::get('/bocetos/{id}', [BocetoController::class, 'create'])->name('bocetos.create');
route::get('bocetos/show/{id}', [BocetoController::class, 'show'])->name('showBoceto');
route::post('/descargar_boceto', [BocetoController::class, 'descargar_boceto'])->name('descargar_boceto');

// Route::resource('/bocetos', BocetoController::class)->except([
//     'store'  // Excluye la ruta POST automática generada por el resource
// ])->middleware('role:admin');
// Route::post('bocetos/store', [BocetoController::class, 'store'])->name('bocetos.store');

route::get('/show_disenio{id}', [DisenioController::class, 'show_disenio'])->name('show_disenio');
route::get('/revision_disenio/{id}', [DisenioController::class, 'revision_disenio'])->name('revision_disenio');

/*RUTAS DEL ABM PEDIDOS*/
Route::resource('pedidos', PedidoController::class)->middleware('role:admin,empresa');
Route::get('/procesar', [PedidoController::class, 'procesarPedido'])->name('procesarPedido.procesar')->middleware(['auth', 'verified']);
Route::get('/pedidoCliente', [PedidoController::class, 'pedidoCliente'])->name('pedidoCliente')->middleware(['auth', 'verified']);
Route::get('/detallePedido{id}', [PedidoController::class, 'detallePedido'])->name('pedido-detallePedido');

/*RUTAS DEL ABM CLIENTE*/
Route::resource('clientes', ClienteController::class)->middleware('role:admin');




/*RUTAS DEL ABM PRODUCTO*/
Route::get('/productos{id}', [ProductoController::class, 'detalle'])->name('producto.detalle');
Route::resource('productos', ProductoController::class)->middleware('role:admin');
// Route::get('/productos/mas-vistos', [ProductoController::class, 'masVistos']);



Route::get('/', [CartController::class, 'shop'])->name('shop');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/add_boceto', [CartController::class, 'add_boceto'])->name('cart.store_boceto');

Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
route::post('/subirImagen', [CartController::class, 'subirImagen'])->name('subirImagen');



// ---FIN DE CLIENTE---


// ------------RUTAS DEL NEGOCIO----------
Route::resource('/disenios', DisenioController::class)->middleware('role:admin'); //ver diseños para revisar con el cliente
Route::post('/descargar', [DisenioController::class, 'descargar'])->name('disenios_descargar')->middleware('role:admin');
Route::put('/actualizardisenio', [DisenioController::class, 'actualizar_disenio'])->name('actualizar_disenio');
//RUTAS MATERIAL
Route::resource('/materiales', MaterialController::class)->middleware('role:admin');
route::get('/materiales/recepcion/{id}', [MaterialController::class, 'recepcion'])->name('recepcion');
route::post('/materiales/entrada/', [MaterialController::class, 'entradaMateriales'])->name('entradaMateriales');
Route::get('/stock{id}', [MaterialController::class, 'stock'])->name('materiales.stock');
Route::put('/actualizar_stock{id}', [MaterialController::class, 'stock_update'])->name('materiales.stock_update');
// Route::get('/materiales_necesarios/{id}/{cantidad?}', [MaterialController::class, 'materiales_necesarios'])->name('materiales_necesarios')->defaults('cantidad', 1);
Route::get('/materiales_necesarios/{id}', [MaterialController::class, 'materiales_necesarios'])->name('materiales_necesarios');

Route::post('/generar_materiales', [MaterialController::class, 'generar_material'])->name('generar_material');
// Route::get('/listarProductos', [MaterialController::class, 'listarProductos'])->name('listarProductos');




Route::resource('/historialMateriales', MaterialProveedorController::class)->middleware('role:admin');


//RUTAS PROVEEDOR
Route::resource('/proveedores', ProveedorController::class)->middleware('role:admin');


Route::get('/pago', [MailController::class, 'pago'])->name('pago');
Route::post('/comprobante', [MailController::class, 'comprobante'])->name('comprobante');


Route::resource('/comprobantes', ComprobanteController::class)->except([
    'store'  // Excluye la ruta POST automática generada por el resource
])->middleware('role:admin');

Route::post('comprobantes/store', [ComprobanteController::class, 'store'])->name('comprobantes.store');

/**FIN RUTAS DE MAILS
 * 
 * 
 * 
 */



/*RUTAS DEL CHECKOUT*/
Route::get('/checkout', [CheckoutContorller::class, 'index'])->middleware(['auth', 'verified'])->name('checkout.index');
Route::get('/checkout{id}', [CheckoutContorller::class, 'show'])->middleware(['auth', 'verified'])->name('checkout.show');





Route::resource('/usuarios', UsuariosController::class);

Route::resource('/ofertas', OfertaController::class);
Route::get('/finalizar_oferta', [OfertaController::class, 'finalizar_oferta'])->name('finalizar_oferta');
route::get('/confirmar_oferta/{id}', [OfertaController::class, 'confirmarOferta'])->name('confirmarOferta');

route::get('/detalleofertas/{demanda_id}/{oferta_id}/{material_id}', [DetalleOfertaController::class, 'crear'])->name('detalleofertas.crear');


Route::resource('/detalleoferta', DetalleOfertaController::class);
Route::get('/listado_ofertas', [OfertaController::class, 'listado_ofertas'])->name('listaOfertas');

Route::resource('/demandas', DemandaController::class);
route::get('/ofertascrear/{id}', [OfertaController::class, 'crear'])->name('ofertas.crear');
Route::get('/showproveedor{id}', [DemandaController::class, 'showProveedor'])->name('demandas.showProveedor');
Route::post('/comprar', [DemandaController::class, 'comprar'])->name('comprar');


Route::get('/presupuestos', function () {
    return view('presupuesto.create');
})->name('presupuestos.create');



//nuevas rutas 08-01

Route::resource('/detalleproducto', DetalleProductoController::class);
Route::get('/detalleproducto/{producto_id}/{material_id}', [DetalleProductoController::class, 'editar'])->name('detalleproducto.editar');
Route::delete('/detalleproducto/{producto_id}/{material_id}', [DetalleProductoController::class, 'eliminar'])->name('detalleproducto.eliminar');


//nuevas rutas 16-01
Route::resource('/detallepedidos', DetallePedidoController::class);

// rutas 18-01

Route::get('/perfilcliente', function () {
    $email = Auth::user()->email;
    // dd($email);
    $cliente = Cliente::where('correo', $email)->get();
    // dd($cliente);
    // return $cliente;
    return view('perfil', compact('cliente'));
})->name('miperfil');
/*RUTAS DEL PANEL DE ADMINISTRACION*/




Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


//rutas 19-01

Route::get('/buscar', [ProductoController::class, 'buscarProducto'])->name('busqueda');

route::get('/welcome', [InicioController::class, 'inicio'])->name('pag.inicio');

route::resource('/contacto', ContactoController::class);


//rutas 14-02-24
Route::get('/ordenCompra', [DemandaController::class, 'ordenCompra'])->name('ordenCompra');
Route::get('/ordenCompra/confirmarOrden/{id}', [DemandaController::class, 'confirmarOrden'])->name('confirmar');
route::get('/pdf', function () {
    $pdf = FacadePdf::loadView('prueba');
    // genera el pdf y lo previsualiza en el navegador
    // return $pdf->stream();
    // genera el pdf y lo descarga automaticamente
    return $pdf->download();
});

Route::get('/prueba', function () {

    return view('prueba');
})->name('prueba');


route::get('/stock', [MaterialController::class, 'verStock'])->name('ver_stock');

route::resource('/registrodemandasproveedores', RegDemandaProveedor::class);
route::get('/reset', function () {
    $materiales = Material::all();
    foreach ($materiales as $material) {
        $sv = StockVirtual::where('material_id', $material->id)->first();
        if ($sv) {
            $sv->update([
                // Actualiza los campos que desees del modelo StockVirtual con los datos del Material

                'cantidad' => $material->stock,
                // ... y así sucesivamente
            ]);
        } else {
            // Si no existe un StockVirtual, puedes crear uno nuevo
            StockVirtual::create([
                'material_id' => $material->id,
                'cantidad' => $material->stock,

                // ... y así sucesivamente
            ]);
        }
    }

    return StockVirtual::all();
});



Route::resource('roles', RoleController::class);
Route::resource('permisos', PermisosController::class);
route::get('roles/asociar/{id}', [RoleController::class, 'editRol'])->name('editRol');
route::put('roles/asociar/{id}', [RoleController::class, 'updateRol'])->name('updateRol');
Route::post('/roles/{roleId}/remove-permission', [RoleController::class, 'remover'])->name('remover');
Route::get('/users/{userId}/assign-multiple-roles-form', [UsuariosController::class, 'showAssignMultipleRolesForm'])->name('usuarios.showAssignMultipleRolesForm');
Route::post('/users/{userId}/assign-multiple-roles', [UsuariosController::class, 'assignMultipleRoles'])->name('usuarios.assignMultipleRoles');
Route::post('/users/{userId}/remove-multiple-roles', [UsuariosController::class, 'removeMultipleRoles'])->name("removerRoles");
Route::resource('/auditoria', AuditoriaController::class);
require __DIR__ . '/auth.php';
