@extends('adminlte::page')

@section('title', 'Grupos')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('grupos.index') }}" class="">Grupos</a></li>
    </ol>

    <h1>Grupos <a href="{{ route('grupos.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Grupo</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('grupos.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grupos as $grupo)
                    <tr>
                        <td>
                            {{ $grupo->foto }}
                        </td>
                        <td>
                            {{ $grupo->name }}
                        </td>
                        <td>
                            {{ $grupo->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('grupos.edit', $grupo->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('grupos.show', $grupo->id)}}" class="btn btn-warning">Ver</a>
                            <a href="{{route('grupos.subgrupos', $grupo->id)}}" class="btn btn-warning">Sub-Grupos</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $grupos->appends($filters)->links() !!}
            @else
                {!! $grupos->links() !!}
            @endif

        </div>
    </div>
@stop
