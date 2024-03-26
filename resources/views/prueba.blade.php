@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>prueba </h1>
@stop
{{-- {{ dd($pedido) }} --}}

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- {{ dd($pedido[0]->detallePedido[0]->producto->name) }} --}}
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [{{ $pedido[0]->detallePedido[0]->producto->name }}],
                datasets: [{
                    label: 'Productos vendidos',
                    data: [12, 1, 3, 5],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    {{-- 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <canvas id="miGrafico"></canvas>

    <script>
        var ctx = document.getElementById('miGrafico').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Cancelados', 'No Cancelados'],
                datasets: [{
                    label: 'Pedidos',
                    data: [20, 80],
                    backgroundColor: [
                        'red',
                        'green',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script> --}}



@endsection
@section('css')


@endsection
@section('js')


@endsection
