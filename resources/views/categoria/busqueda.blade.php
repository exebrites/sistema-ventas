@extends('layouts.app')
<link rel="stylesheet" href="/css/app.css">


@section('content')
    <div class="card">
        <div class="card-body">
            <br><br>
            @foreach ($busqueda as $producto)
                <div class="card" style="width: 18rem;">
                    <img src="{{ $producto->image_path }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->name }}</h5>
                        <p>Precio:  {{$producto->price}}</p>
                        <a href="{{ route('producto.detalle', ['id' => $producto->id]) }}"class="btn btn-primary">Ver
                            producto</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
