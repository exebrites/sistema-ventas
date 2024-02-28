@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Listado de clientes</h1>
@stop

@section('content')
{{-- {{dd($cliente)}} --}}
<div class="card">
    <div class="card-header">
       
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>APELLIDO</th>
                    <th>TELEFONO</th>
                    <th>CORREO</th>

                    <th colspan="2"></th> 
                </tr>
                
            </thead>
            <tbody>
     {{-- /*implementar para el listado de clientes*/ --}}

                
                     {{-- {{dd($cliente);}}   --}}
                    <tr>
                       
                        <td> {{$cliente->id}} </td>
                       
                        {{-- <td> {{$cliente->dni}}</td>
                        <td> {{$cliente->nombre}} </td>
                       
                        <td> {{$cliente->apellido}}</td>
                        <td> {{$cliente->telefono}} </td>
                       
                        <td> {{$cliente->correo}}</td> --}}

                        <td>  </td>
                       
                        <td> {{$cliente->name}}</td>
                        <td>  </td>
                       
                        <td> </td>
                    
                       
                        <td> {{$cliente->email}}</td>
                
                    </tr>
               
            </tbody>
        </table>
    </div>
    <a href="{{route('pedidos.index')}}">Volver atras</a>

</div>
   
@stop
