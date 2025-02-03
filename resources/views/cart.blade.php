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
                            <div class="products">
                                <p id="product-id"> {{ $item->id }}</p>
                                <p id="product-name"> {{ $item->name }}</p>
                                <b>Precio unitario: </b>
                                <p id="product-price">{{ $item->price }}</p>
                                <b>Cantidad:</b>
                                <p id="product-quantity">{{ $item->quantity }}</p>
                                <b>SubTotal:
                                </b>
                                <p>
                                    ${{ \Cart::get($item->id)->getPriceSum() }}
                                </p>
                            </div>
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

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="local" id="local">
                        <label class="form-check-label" for="local">Retiro en local</label>
                    </div>
                    <div id="div1">
                        <div class="form-group">
                            <label>Dirección del lugar de entrega</label>
                            <input type="text" class="form-control" name="direccion" value="" id="direccion">
                            @error('direccion')
                                <br>
                                <small style="color:red">{{ $message }}</small>
                            @enderror

                        </div>
                        <label>Telefono de contacto</label>
                        <input type="tel" class="form-control" name="telefono" id="telefono"
                            placeholder="Ej: 3758-122331">
                        @error('telefono')
                            <br>
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label>Nombre de la persona que recibe</label>
                            <input type="text" class="form-control" name="nombre" id="personaRecepcion">
                            @error('nombre')
                                <br>
                                <small style="color:red">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label>Nota</label>
                            <textarea class="form-control" aria-label="With textarea" name="nota" id="nota">Sin comentarios</textarea>

                        </div>
                    </div>
                    {{-- <form action="{{ route('procesarPedido.procesar') }}" method="post">
                        @csrf <label for="fechaEntrega" class="font-weight-bold">Fecha requerida para la entrega del
                            pedido:</label>
                        {{-- <input type="date" id="fechaEntrega" name="fechaEntrega" class="form-control" required
                            max="2030-01-01"> --}}
                    {{-- @error('fechaEntrega')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                       
                        <br>
                        <br> --}}
                    {{-- <a href="/mercado" class="btn btn-primary">Pagar con Mercado Pago</a> --}}
                    </form>
                    <a href="/" class="btn btn-dark">Continue en la tienda</a>
                    <button type="submit" class="btn btn-success" id="miBoton">Finalizar pedido</button>
                    <div id="wallet_container"></div>
                    {{-- <button id="miBoton">Haz clic aquí</button> --}}


                    <br>
                </div>
            @endif
        </div>
        <br><br>

    </div>
    <script>
        // Obtén una referencia al checkbox
        const checkbox = document.getElementById('local');
        const div = document.getElementById('div1');


        // Agrega un evento de escucha al checkbox
        checkbox.addEventListener('click', function() {
            // Verifica si el checkbox está marcado
            if (checkbox.checked) {
                div.style.display = "none"
            } else {
                div.style.display = "block"
            }
        });
    </script>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("{{ env('MERCADO_PAGO_PUBLIC_KEY') }}");
        console.log(document.getElementById('local').checked);

        function isEmpty(str) {
            return str.trim() === '';
        }
        document.getElementById("miBoton").addEventListener("click", function() {
            // datos de entrega 

            console.log(document.getElementById('local').checked);
            document.getElementById("miBoton").disabled = true
            let datosEntrega = {
                'direccion': 'no tiene',
                'telefono': 'no tiene',
                'personaRecepcion': 'no tiene',
                'nota': 'sin notas',
                'retiroLocal': document.getElementById('local').checked,
            }
            if (!datosEntrega.retiroLocal) {
                // si es falso el retiro en local la persona debe cargar los campos
                if (isEmpty(document.getElementById('direccion').value)) {
                    alert('Por favor ingrese una direccion')
                    return
                }
                if (isEmpty(document.getElementById('telefono').value)) {
                    alert('Por favor ingrese una telefono')
                    return
                }
                if (isEmpty(document.getElementById('personaRecepcion').value)) {
                    alert('Por favor ingrese el nombre de la persona que recibe el pedido')
                    return
                }

                datosEntrega.direccion = document.getElementById('direccion').value
                datosEntrega.telefono = document.getElementById('telefono').value
                datosEntrega.personaRecepcion = document.getElementById('personaRecepcion').value
                datosEntrega.nota = isEmpty(document.getElementById('nota').value) ? 'sin notas' : document
                    .getElementById('nota').value
            }

            // datos de producto
            const productos = document.getElementsByClassName('products');
            let products = []
            Array.from(productos).forEach(producto => {

                const detalle = {
                    id: producto.children[0].textContent,
                    title: producto.children[1].textContent,
                    description: 'Descripción del producto', // Puedes ajustar esto si tienes más información
                    currency_id: "ARG",
                    quantity: parseInt(producto.children[3].textContent),
                    unit_price: parseFloat(producto.children[5].textContent),
                };
                products.push(detalle);
            });

            const orderData = {
                product: products,
                // name: nombre,
                // surname: '', // Si tienes un campo de apellido, añádelo aquí
                email: '', // Agrega el correo electrónico si es necesario
                // phone: telefono,
                // address: direccion,
                fullName: 'exe',
                datosEntrega: datosEntrega
            };

            console.log('Datos del pedido:', orderData);


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

                    mp.bricks().create("wallet", "wallet_container", {
                        initialization: {
                            preferenceId: preference.id,
                        },
                        customization: {
                            texts: {
                                valueProp: 'smart_option',
                            },
                        },
                    });


                    console.log('Respuesta de la preferencia:', preference);

                })
                .catch(error => console.error('Error al crear la preferencia:', error));




            
        });
    </script>


@endsection
@section('css')
@endsection
@section('js')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
