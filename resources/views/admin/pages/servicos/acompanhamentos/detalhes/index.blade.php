@extends('adminlte::page')

@section('title', "Detalhes do Acompanhamento {$acompanhamento->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.index') }}">Serviços</a></li>
       <li class="breadcrumb-item active"><a href="{{ route('detalhes.acompanhamento.index', $acompanhamento->id) }}" class="active">Detalhes </a></li>
    </ol>

    <h1>Adicionar Detalhe ao {{ $acompanhamento->name }}  <a href="{{ route('detalhes.acompanhamento.create', $acompanhamento->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar detalhe ao acompanhamento</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th style="width: 250px">Ações</th>
                    </tr>
                 </thead>
                <tbody>
                    @foreach ($detalhes as $detalhe)
                    <tr>
                        <td>
                            {{ $detalhe->name }}
                        </td>
                        <td>
                            {{ $detalhe->description }}
                        </td>
                        <td style="width: 50px">
                            <a href="{{route('detalhes.acompanhamento.edit', [$acompanhamento->id, $detalhe->id])}}" class="btn btn-info">Edit</a>
                            <a href="{{route('detalhes.acompanhamento.show', [$acompanhamento->id, $detalhe->id])}}" class="btn btn-warning">Ver</a>
                         </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $detalhes->appends($filters)->links() !!}
            @else
                {!! $detalhes->links() !!}
            @endif

        </div>
    </div>
@stop
