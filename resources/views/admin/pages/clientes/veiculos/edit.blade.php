@extends('adminlte::page')

@section('title', "Editar Veículo {$veiculo->placa}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.show', $cliente->id) }}">{{$cliente->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('veiculos.cliente.index', $cliente->id) }}">Veículos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('veiculos.cliente.edit', [$cliente->id, $veiculo->id]) }}" class="active">Editar</a></li>
    </ol>

    <h1>Editar Veículo {{ $veiculo->placa }} <a href="{{ route('clientes.create')}}"></a>  </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('veiculos.cliente.update', [$cliente->id, $veiculo->id])}}" class="form" method="post">
                @method('PUT')
                @include('admin.pages.clientes.veiculos._partials.form')
            </form>
        </div>
    </div>
@endsection
