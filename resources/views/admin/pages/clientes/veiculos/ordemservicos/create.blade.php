@extends('adminlte::page')

@section('title', "Adicionar Ordem Serviço ao Veículo {$veiculo->placa}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('veiculos.cliente.index', $veiculo->cliente->id) }}">Veículo</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('veiculos.cliente.create', $veiculo->cliente->id) }}" class="active">Novo Veículo</a></li>
    </ol>

    <h1>Adicionar Ordem Serviço ao Veículo {{ $veiculo->placa }} <a href="{{ route('ordemservicos.veiculo.create', $veiculo->id)}}"></a>  </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ordemservicos.veiculo.store', $veiculo->id)}}" class="form" method="post">
                @include('admin.pages.clientes.veiculos.ordemservicos._partials.form')
            </form>
        </div>
    </div>
@endsection
