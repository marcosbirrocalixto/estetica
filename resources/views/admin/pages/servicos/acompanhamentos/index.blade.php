@extends('adminlte::page')

@section('title', "Aconpanhamentos do Serviço {$servico->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.index') }}">Serviços</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.show', $servico->id) }}">{{$servico->name}}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('acompanhamentos.servico.index', $servico->id) }}" class="active">Aconpanhamentos </a></li>
    </ol>

    <h1>Adicionar Acompanhamentos ao {{ $servico->name }}  <a href="{{ route('acompanhamentos.servico.create', $servico->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Acompanhamentos ao Serviço</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width: 50px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($acompanhamentos as $acompanhamento)
                    <tr>
                        <td>
                            {{ $acompanhamento->name }}
                        </td>
                        <td style="width: 5px">
                            <a href="{{route('acompanhamentos.servico.edit', [$servico->id, $acompanhamento->id])}}" class="btn btn-info">Edit</a>
                        </td>
                        <td style="width: 5px">
                            <a href="{{route('acompanhamentos.servico.show', [$servico->id, $acompanhamento->id])}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $acompanhamentos->appends($filters)->links() !!}
            @else
                {!! $acompanhamentos->links() !!}
            @endif

        </div>
    </div>
@stop
