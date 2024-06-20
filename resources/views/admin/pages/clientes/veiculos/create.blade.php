@extends('adminlte::page')

@section('title', "Adicionar Novo Veículo ao Cliente {$cliente->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.show', $cliente->id) }}">{{$cliente->placa}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('veiculos.cliente.index', $cliente->id) }}">Veículo</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('veiculos.cliente.create', $cliente->id) }}" class="active">Novo Veículo</a></li>
    </ol>

    <h1>Adicionar Novo Veículo ao Cliente {{ $cliente->name }} <a href="{{ route('veiculos.cliente.create', $cliente->id)}}"></a>  </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('veiculos.cliente.store', $cliente->id)}}" class="form" method="post">
                @include('admin.pages.clientes.veiculos._partials.form')
            </form>
        </div>
    </div>
@endsection
