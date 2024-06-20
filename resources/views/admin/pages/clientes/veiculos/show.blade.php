@extends('adminlte::page')
do detalhe
@section('title', "Detalhes  {$veiculo->placa}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.show', $cliente->id) }}">{{$cliente->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('veiculos.cliente.index', $cliente->id) }}">veiculos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('veiculos.cliente.show', [$cliente->id, $veiculo->id]) }}" class="active">Detalhes</a></li>
    </ol>

    <h1>Detalhes do veiculo {{ $veiculo->placa }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Placa: </strong> {{ $veiculo->placa }}
                </li>
                <li>
                    <strong>Marca: </strong> {{ $veiculo->marca }}
                </li>
            </ul>
        </div>
        <div class="car-footer">
        <form action="{{ route('veiculos.cliente.delete', [$cliente->id, $veiculo->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o veículo: {{ $veiculo->placa }}</button>
        </form>
        </div>
    </div>
@endsection
