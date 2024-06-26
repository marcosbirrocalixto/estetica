@extends('adminlte::page')

@section('title', "Veículos")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">clientes</a></li>
    </ol>

    <h1>Veículos </h1>
@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('veiculos.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Cliente</th>
                        <th style="width: 250px">Ações</th>
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
                        <td>
                            {{ $veiculo->cliente->name }}
                        </td>
                        <td style="width: 50px">
                            <a href="{{route('veiculos.cliente.edit', [$veiculo->cliente->id, $veiculo->id])}}" class="btn btn-info">Edit</a>
                            <a href="{{route('veiculos.cliente.show', [$veiculo->cliente->id, $veiculo->id])}}" class="btn btn-warning">Ver</a>
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
