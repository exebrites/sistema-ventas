@extends('layouts.app')
@section('content')
    <br>
    <br><br>
    <div class="card">
        <div class="card-body">
            <h5>Informacion personal</h5>
            {{-- {{ dd($cliente) }} --}}
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Correo</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $cliente[0]->id }}</td>
                        <td>{{ $cliente[0]->dni }}</td>
                        <td>{{ $cliente[0]->nombre }}</td>
                        <td>{{ $cliente[0]->apellido }}</td>
                        <td>{{ $cliente[0]->telefono }}</td>
                        <td>{{ $cliente[0]->correo }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
