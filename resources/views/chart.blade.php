@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>prueba </h1>
@stop
@section('content')


    <div class="card">
        <div class="card-header">
            <a href="javascript: history.go(-1)" class="btn btn-secondary">Volver atrás</a>

        </div>
        <div class="card-body">

            <div id="container">


            </div>

        </div>
    </div>



    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        const data = JSON.parse(`<?= $data ?>`);


        const jsonData = [];

        for (const item of data) {
            jsonData.push({
                name: item.name,
                y: item.y,
            });
        }



        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: 'Productos mas vendidos '
            },
            subtitle: {
                align: 'left',
                // text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total de ventas'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> del total<br/>'
            },

            series: [{
                name: '',
                colorByPoint: true,
                data: jsonData
            }],

        });
    </script>
@endsection
