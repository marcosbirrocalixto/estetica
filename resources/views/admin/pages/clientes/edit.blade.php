@extends('adminlte::page')

@section('title', "Editar Cliente {$cliente->name}")

@section('content_header')
    <h1>Editar Cliente <strong>{{ $cliente->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('clientes.update', $cliente->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.clientes._partials.form')
          </form>
        </div>
    </div>
@stop
