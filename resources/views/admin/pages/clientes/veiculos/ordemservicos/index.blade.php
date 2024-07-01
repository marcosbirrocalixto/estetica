@extends('adminlte::page')

@section('title', "Ordens de serviço do veículo {$veiculo->placa}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Serviços</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('ordemservicos.veiculo.create', $veiculo->id) }}" class="active">Veículos </a></li>
    </ol>

    <h1>Adicionar ordem de serviço ao {{ $veiculo->placa }}  <a href="{{ route('ordemservicos.veiculo.create', $veiculo->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Ordens de serviço ao veículo</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Ordem Serviço</th>
                        <th>Veículo</th>
                        <th>Data entrada</th>
                        <th>Data Prevista</th>
                        <th>Data Encerrada</th>
                        <th style="width: 350px">Ações</th>
                    </tr>
                 </thead>
                <tbody>
                    @foreach ($ordemservicos as $ordemservico)
                    <tr>
                        <td>
                            {{ $ordemservico->id }}
                        </td>
                        <td>
                            {{ $veiculo->placa }}
                        </td>
                        <td>
                            {{ date( 'd/m/Y H:i' , strtotime($ordemservico->dataentrada))}}
                        </td>
                        <td>
                            {{ date( 'd/m/Y H:i' , strtotime($ordemservico->dataprogramada))}}
                        </td>
                        @if( isset($ordemservico->dataencerrada) )
                            <td>{{ date( 'd/m/Y H:i' , strtotime($ordemservico->dataencerrada)) }}
                        @else
                            <td></td>
                        @endif
                        <td style="width: 50px">
                            <a href="{{route('veiculos.cliente.edit', [$ordemservico->id, $veiculo->id])}}" class="btn btn-info">Edit</a>
                            <a href="{{route('veiculos.cliente.show', [$ordemservico->id, $veiculo->id])}}" class="btn btn-warning">Ver</a>
                            <a href="{{route('ordemservicos.servicos', $ordemservico->id)}}" class="btn btn-primary">Serviços</a>
                            <a href="{{route('ordemservicos.veiculo.executar', $ordemservico->id)}}" class="btn btn-primary">Executar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $ordemservicos->appends($filters)->links() !!}
            @else
                {!! $ordemservicos->links() !!}
            @endif

        </div>
    </div>
@stop
