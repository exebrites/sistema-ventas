@extends('layouts.app')

@section('content')
    {{-- {{dd($pedido)}} --}}
    <div class="card">
        <div class="card-body">
            <br>
            <br>
            <div class="container">

                <br>
                @if (session('mensajeError'))
                    <div class="alert alert-danger">
                        {{ session('mensajeError') }}
                    </div>
                @endif
                <div class="row">


                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Tu estado de pedido es el siguiente: Pago confirmado</h5>
                                <p class="card-text">
                                    <small>
                                        El estado "Pago confirmado" indica que el pago ha sido confirmado. Ahora necesitas
                                        completar los siguientes campos para que sepamos dónde entregar el pedido.
                                    </small>
                                </p>
                                <h5>Datos de entrega</h5>
                                <form>
                                    @csrf
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="local" id="miCheckbox">
                                        <label class="form-check-label" for="miCheckbox">Retiro en local</label>
                                    </div>
                                    <div id="div1">
                                        <div class="form-group">
                                            <label>Dirección del lugar de entrega</label>
                                            <input type="text" class="form-control" name="direccion" value="">
                                            @error('direccion')
                                                <br>
                                                <small style="color:red">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <label>Telefono de contacto</label>
                                        <input type="tel" class="form-control" name="telefono"
                                            placeholder="Ej: 3758-122331">
                                        @error('telefono')
                                            <br>
                                            <small style="color:red">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label>Nombre de la persona que recibe</label>
                                            <input type="text" class="form-control" name="nombre">
                                            @error('nombre')
                                                <br>
                                                <small style="color:red">{{ $message }}</small>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label>Nota</label>
                                            <textarea class="form-control" aria-label="With textarea" name="nota">Sin comentarios</textarea>

                                        </div>
                                    </div>
                                    <input type="hidden" name="estado" value="{{ $estado->id }}" id="">
                                    <input type="hidden" name="id" value="{{ $pedido->id }}" id="">
                                    <button type="submit" id="checkout-btn" class="btn btn-primary">Finalizar
                                        pedido</button>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <br>
        <br>

    </div>

    </div>


    <script>
        // Obtén una referencia al checkbox
        const checkbox = document.getElementById('miCheckbox');
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
    <script src="/js/app.js"></script>


    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago("{{ env('MERCADO_PAGO_PUBLIC_KEY') }}");

        document.getElementById('checkout-btn').addEventListener('click', function() {
            // const cantidad = parseInt(document.getElementById('quantity').value, 10);
            // const nombre = document.getElementById('phone').value;

            console.log("hola");

            // const nombre = 'exe'
            // const telefono = document.getElementById('phone').value;
            // const direccion = document.getElementById('address').value;

            // if (!cantidad || !telefono || !direccion) {
            //     Swal.fire({
            //         title: 'Error!',
            //         text: 'Por favor, completa todos los campos del formulario.',
            //         icon: 'error',
            //         confirmButtonText: 'Aceptar'
            //     });
            //     return;
            // }

            // const orderData = {
            //     product: [{
            //         id: document.getElementById('product_id').value,
            //         title: document.querySelector('.product-name').innerText,
            //         description: 'Descripción del producto', // Puedes ajustar esto si tienes más información
            //         currency_id: "USD",
            //         quantity: cantidad,
            //         unit_price: parseFloat(document.getElementById('product_price').value),
            //     }],
            //     name: nombre,
            //     surname: '', // Si tienes un campo de apellido, añádelo aquí
            //     email: '', // Agrega el correo electrónico si es necesario
            //     phone: telefono,
            //     address: direccion,
            // };

            // console.log('Datos del pedido:', orderData);

            //     fetch('/create-preference', {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            //             },
            //             body: JSON.stringify(orderData)
            //         })
            //         .then(response => {
            //             if (!response.ok) {
            //                 throw new Error('Error en la respuesta del servidor');
            //             }
            //             return response.json();
            //         })
            //         .then(preference => {
            //             if (preference.error) {
            //                 throw new Error(preference.error);
            //             }
            //             mp.checkout({
            //                 preference: {
            //                     id: preference.id // Asegúrate de que esta línea sea correcta
            //                 },
            //                 autoOpen: true
            //             });
            //             console.log('Respuesta de la preferencia:', preference);
            //         })
            //         .catch(error => console.error('Error al crear la preferencia:', error));
        });
    </script>
@endsection
