@extends('adminlte::page')

@section('title')

@section('content_header')

@stop

@section('content')
    {{-- {{ dd($virtual_stock) }} --}}
    stock virtual
    <table class="table">
        <thead>
            <tr>
                <th>material id</th>
                <th>nombre</th>
                <th>cantidad </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($virtual_stock as $item)
                <tr>
                    <td>{{ $item->material_id }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->cantidad }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
