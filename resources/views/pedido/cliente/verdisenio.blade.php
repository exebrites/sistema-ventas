@extends('layouts.app')

@section('content')
    <br>
    <br>
    <br>
    <div class="card">s
        <div class="card-body">


            @if ($detalle->disenio->disenio_estado)
              
            
            @else
                {{ 'boceto' }}
            @endif


        </div>
    </div>
@endsection
