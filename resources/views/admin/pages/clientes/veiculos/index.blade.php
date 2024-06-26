@extends('adminlte::page')

@section('title', "Veículos do Cliente {$cliente->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Serviços</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('veiculos.cliente.index', $cliente->id) }}" class="active">Veículos </a></li>
    </ol>

    <h1>Adicionar veículo ao {{ $cliente->name }}  <a href="{{ route('veiculos.cliente.create', $cliente->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar veiculos ao cliente</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th style="width: 400px">Ações</th>
                    </tr>
                 </thead>
                <tbody>
                    @foreach ($veiculos as $veiculo)
                    <tr>
                        <td>
                            {{ $veiculo->placa }}
                        </td>
                        <td>
                            {{ $veiculo->marca }}
                        </td>
                        <td style="width: 50px">
                            <a href="{{route('veiculos.cliente.edit', [$cliente->id, $veiculo->id])}}" class="btn btn-info">Edit</a>
                            <a href="{{route('veiculos.cliente.show', [$cliente->id, $veiculo->id])}}" class="btn btn-warning">Ver</a>
                            <a href="{{route('ordemservicos.veiculo.index', $veiculo->id)}}" class="btn btn-primary">Checklist</a>
                            <a href="{{route('ordemservicos.veiculo.index', $veiculo->id)}}" class="btn btn-primary">Ordem Serv.</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $veiculos->appends($filters)->links() !!}
            @else
                {!! $veiculos->links() !!}
            @endif

        </div>
    </div>
@stop
