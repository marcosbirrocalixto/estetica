@extends('adminlte::page')

@section('title', "Grupos do sub-grupo {$subgrupo->codigo}")

@section('content_header')
    <ol class="breadcrumb">
    {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('subgrupos.index') }}" class="">Sub-grupos</a></li>
    </ol>

    <h1>Grupos do sub-grupo <b>{{$subgrupo->codigo}}</b></h1>

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
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th style="width: 50px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grupos as $grupo)
                    <tr>
                        <td>
                            {{ $grupo->name }}
                        </td>
                        <td>
                            {{ $grupo->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('grupos.subgrupo.detach', [$grupo->id, $subgrupo->id])}}" class="btn btn-warning">Desvinvular</a>
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
