@extends('layouts.app')

@section('content')

    {{-- {{ dd($cartCollection) }}} --}}
    <div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Tienda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carrito</li>
            </ol>
        </nav>
        @if (session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        {{-- @if (count($errors) > 0)
            @foreach ($errors0 > all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif --}}
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <br>
                @if (\Cart::getTotalQuantity() > 0)
                    <h4>{{ \Cart::getTotalQuantity() }} Producto(s) en el carrito</h4><br>
                @else
                    <h4>No hay productos en su carrito</h4><br>
                    <a href="/" class="btn btn-dark">Continue en la tienda</a>
                @endif

                @foreach ($cartCollection as $item)
                    {{-- {{dd($item->attributes['costo_disenio_asistido'])}} --}}
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="{{ $item->attributes->imagen_path }}" class="img-thumbnail" width="200"
                                height="200">
                        </div>
                        <div class="col-lg-5">
                            <p>
                                {{ $item->name }}<br>
                                <b>Precio unitario: </b>${{ $item->price }}<br>

                                {{-- @if ($item->attributes['disenio_estado'])
                                    <b>El costo del diseño asistido:</b>
                                    <span class="help-icon" data-toggle="tooltip" data-placement="right"
                                        title="Diseño asistido: donde usted como cliente sube un diseño inicial y nosotros lo completamos">
                                        <i class="fa fa-question-circle" aria-hidden="true"></i>


                                    </span>
                                @else
                                    <b>El costo del diseño completo:</b>
                                    <span class="help-icon" data-toggle="tooltip" data-placement="right"
                                        title="Diseño completo: nosotros nos encargamos de todo el diseño para usted">
                                        <i class="fa fa-question-circle" aria-hidden="true"></i>

                                    </span>
                                @endif --}}
                                <br>
                                {{-- ${{ $item->attributes['costo_disenio'] }} --}}

                                <br>
                                <b>SubTotal:
                                {{-- </b>${{ \Cart::get($item->id)->getPriceSum() + $item->attributes['costo_disenio'] }}<br> --}}
                            </b>${{ \Cart::get($item->id)->getPriceSum()}} <br>

                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                        <input type="number" class="form-control form-control-sm"
                                            value="{{ $item->quantity }}" id="quantity" name="quantity"
                                            style="width: 70px; margin-right: 10px;" min="1" max="500" required
                                            value="1">
                                        <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i
                                                class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if (count($cartCollection) > 0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Borrar Carrito</button>
                    </form>
                @endif
            </div>
            @if (count($cartCollection) > 0)
                <div class="col-lg-5">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total: </b>${{ \Cart::getTotal() + $costo }}</li>
                        </ul>
                    </div>
                    <hr>


                    <form action="{{ route('procesarPedido.procesar') }}" method="post">
                        @csrf <label for="fechaEntrega" class="font-weight-bold">Fecha requerida para la entrega del
                            pedido:</label>
                        {{-- <input type="date" id="fechaEntrega" name="fechaEntrega" class="form-control" required
                            max="2030-01-01"> --}}
                        @error('fechaEntrega')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        <a href="/" class="btn btn-dark">Continue en la tienda</a>
                        <button type="submit" class="btn btn-success">Continuar compra</button>
                        <br>
                        <br>
                        <a href="/mercado" class="btn btn-primary">Pagar con Mercado Pago</a>
                    </form>


                    <br>
                </div>
            @endif
        </div>
        <br><br>
    </div>



@endsection
@section('css')
@endsection
@section('js')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>


<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("{{ env('MERCADO_PAGO_PUBLIC_KEY') }}");

    document.getElementById('checkout-btn').addEventListener('click', function() {
        const cantidad = parseInt(document.getElementById('quantity').value, 10);
        // const nombre = document.getElementById('phone').value;

        const nombre = 'exe'
        const telefono = document.getElementById('phone').value;
        const direccion = document.getElementById('address').value;

        if (!cantidad || !telefono || !direccion) {
            Swal.fire({
                title: 'Error!',
                text: 'Por favor, completa todos los campos del formulario.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        const orderData = {
            product: [{
                id: document.getElementById('product_id').value,
                title: document.querySelector('.product-name').innerText,
                description: 'Descripción del producto', // Puedes ajustar esto si tienes más información
                currency_id: "USD",
                quantity: cantidad,
                unit_price: parseFloat(document.getElementById('product_price').value),
            }],
            name: nombre,
            surname: '', // Si tienes un campo de apellido, añádelo aquí
            email: '', // Agrega el correo electrónico si es necesario
            phone: telefono,
            address: direccion,
        };

        // console.log('Datos del pedido:', orderData);

        fetch('/create-preference', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify(orderData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(preference => {
                if (preference.error) {
                    throw new Error(preference.error);
                }
                mp.checkout({
                    preference: {
                        id: preference.id // Asegúrate de que esta línea sea correcta
                    },
                    autoOpen: true
                });
                console.log('Respuesta de la preferencia:', preference);
            })
            .catch(error => console.error('Error al crear la preferencia:', error));
    });
</script>

@endsection
