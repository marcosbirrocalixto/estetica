@extends('adminlte::page')

@section('title', 'Serviços')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('servicos.index') }}" class="">Serviços</a></li>
    </ol>

    <h1>Serviços <a href="{{ route('servicos.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Serviço</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('servicos.search')}}" method="POST" class="form form-inline">
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
                        <th style="width: 250px">Ações</th>
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
                        R$ {{ number_format($servico->price, 2, ',', '.') }}
                        </td>
                        <td>
                            {{ $servico->tempoPrevisto }}
                        </td>
                        <td style="width: 5px">
                            <a href="{{route('servicos.edit', $servico->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('servicos.show', $servico->id)}}" class="btn btn-warning">Ver</a>
                            <a href="{{route('acompanhamentos.servico.index', $servico->id)}}" class="btn btn-primary"><i class="fa fa-cogs"></i> Acomp.</a>
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
