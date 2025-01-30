<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    {{-- swet alert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Styles -->
    <style>
        .product-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-details {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .product-image {
            flex: 1;
            position: relative;
            aspect-ratio: 16 / 9;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 1rem;
        }

        .product-info {
            flex: 1;
        }

        .product-name {
            font-size: 2rem;
            font-weight: bold;
            color: #1a202c;
            /* Gray-900 */
        }

        .product-price {
            font-size: 1.5rem;
            color: #1a202c;
            /* Gray-900 */
        }

        .product-specs {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .spec-label {
            font-weight: 600;
        }

        .color-box {
            display: inline-block;
            width: 1.5rem;
            height: 1.5rem;
            border: 1px solid #4a5568;
            /* Gray-600 */
            border-radius: 50%;
        }

        .order-form {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 500;
            color: #4a5568;
            /* Gray-700 */
        }

        input {
            padding: 0.5rem;
            border: 1px solid #cbd5e0;
            /* Gray-300 */
            border-radius: 0.375rem;
        }

        .btn-submit {
            padding: 0.75rem;
            background-color: #4f46e5;
            /* Indigo-600 */
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #4338ca;
            /* Indigo-700 */
        }

        .btn-pay {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            background-color: #38a169;
            /* Green-400 */
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        .btn-pay:hover {
            background-color: #2f855a;
            /* Green-700 */
        }

        .icon-credit-card {
            margin-right: 0.5rem;
        }
    </style>
</head>
<div class="product-container px-36">
    <div class="product-details">

        <div class="product-info">
            {{-- <h1 class="product-name">Calzado Deportivo Multicolor</h1>
            <div class="product-price" id="product-price">$29.99</div> --}}
            <hr />
            <p>costo a pagar {{ $pedido->costo_total }}</p>
            <form action="#" method="POST" class="order-form">
                @csrf

                <div class="order-list">

                    <div class="order-item">
                        <h2>Pedido N°: {{ $pedido->id }}</h2>
                        <p id ="client-name-surname"><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}
                            {{ $pedido->cliente->apellido }}
                        </p>
                        <p><strong>Estado:</strong> {{ $pedido->estado->descripcion }}</p>
                        <p><strong>Costo Total:</strong> ${{ $pedido->costo_total }}</p>
                        <h4>Detalles del Pedido:</h4>
                        <ul>
                            @foreach ($pedido->detallesPedido as $detalle)
                                <li>
                                    <input type="hidden" id="product_id" value="{{ $detalle->producto->id }}">
                                    {{-- <input type="hidden" name="product_price"
                                        value="{{ $detalle->producto->precio }}"> --}}
                                    <strong>Precio</strong>
                                    <p id="product_price">{{ $detalle->producto->precio }}</p>

                                    <strong>Producto:</strong>
                                    <p id="product-name">{{ $detalle->producto->nombre }}</p> -
                                    <strong>Cantidad:</strong>
                                    <p id="product-quantity">{{ $detalle->cantidad }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>


                <button class="btn-submit" id="checkout-btn" type="button">
                    <span class="icon-credit-card text-center">💳</span>Pagar
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("{{ env('MERCADO_PAGO_PUBLIC_KEY') }}");

    document.getElementById('checkout-btn').addEventListener('click', function() {
 
        const productId = document.getElementById('product_id').value;

        const fullName = document.getElementById('client-name-surname').textContent;

        const productName = document.getElementById('product-name').textContent;
        const productPrice = parseFloat(document.getElementById('product_price').textContent);

        const quantity = parseInt(document.getElementById('product-quantity').textContent);

        let products = []


        $item = document.querySelectorAll('li')
        $item.forEach($i => {
            const detalle = {
                id: $i.children[0].value,
                title: $i.children[4].textContent,
                description: 'Descripción del producto', // Puedes ajustar esto si tienes más información
                currency_id: "ARG",
                quantity: parseInt($i.children[6].textContent),
                unit_price: parseFloat($i.children[2].textContent),
            };
            products.push(detalle);
        })

        const orderData = {
            product: products,
            // name: nombre,
            // surname: '', // Si tienes un campo de apellido, añádelo aquí
            email: '', // Agrega el correo electrónico si es necesario
            // phone: telefono,
            // address: direccion,
            fullName: fullName
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

</html>
