@extends('adminlte::page')

@section('title', "Serviços da Ordem Serviço {$ordemservico->id}")

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('ordemservicos.servicos', $ordemservico->id) }}" class="">Ordens Serviços</a></li>
    </ol>

    <h1>Serviços da Ordem Serviço <b>{{$ordemservico->id}}</b></h1>

    <a href="{{ route('ordemservicos.servicos.available', $ordemservico->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Serviço</a>
@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('ordemservicos.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Tempo Previsto</th>
                        <th style="width: 50px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicos as $servico)
                    <tr>
                        <td>
                            {{ $servico->name }}
                        </td>
                        <td>
                            {{ $servico->description }}
                        </td>
                        <td>
                            {{ $servico->price }}
                        </td>
                        <td>
                            {{ $servico->tempoPrevisto }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('ordemservicos.servico.detach', [$ordemservico->id, $servico->id])}}" class="btn btn-warning">Desvinvular</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $servicos->appends($filters)->links() !!}
            @else
                {!! $servicos->links() !!}
            @endif

        </div>
    </div>
@stop
