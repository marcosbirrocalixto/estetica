@extends('adminlte::page')

@section('title', "Sub-grupos do Grupo {$grupo->name}")

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('grupos.index') }}" class="">Grupos</a></li>
    </ol>

    <h1>Sub-grupos do Grupo <b>{{$grupo->name}}</b></h1>

    <a href="{{ route('grupos.subgrupos.available', $grupo->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Sub-grupo</a>
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
                    @foreach ($subgrupos as $subgrupo)
                    <tr>
                        <td>
                            {{ $subgrupo->codigo }}
                        </td>
                        <td>
                            {{ $subgrupo->description }}
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
                {!! $subgrupos->appends($filters)->links() !!}
            @else
                {!! $subgrupos->links() !!}
            @endif

        </div>
    </div>
@stop
