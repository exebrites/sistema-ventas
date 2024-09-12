@extends('layouts.app')
<link rel="stylesheet" href="/css/app.css">


@section('content')
    <div class="card">
        <div class="card-body">
            <br><br>

            <div style="display: flex; justify-content: center;">
                @if ($busqueda->count() > 0)
                    @foreach ($busqueda as $producto)
                        <div class="card" style="width: 18rem; margin: 5px;">
                            {{-- <img src="{{ $producto->image_path }}" class="card-img-top" alt="..."> --}}
                            <div class="card-body">
                                <img src="{{ $producto->image_path }}" class="card-img-top mx-auto"
                                    style="height: 150px; width: 150px;display: block;" alt="{{ $producto->image_path }}">
                                <br>
                                <a href="{{ route('producto.detalle', ['id' => $producto->id]) }}">
                                    <h6 class="card-title">{{ $producto->name }}</h6>
                                </a>
                                <p>Precio:$ {{ $producto->price }}</p>
                             
                            </div>
                        </div>
                    @endforeach
                @else
                    <p style="text-align: center;">No se encontraron resultados</p>
                @endif
            </div>

        </div>
    </div>
@endsection
