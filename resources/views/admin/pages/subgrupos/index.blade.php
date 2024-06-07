@extends('adminlte::page')

@section('title', 'Sub-Grupos')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('subgrupos.index') }}" class="">Sub-Grupos</a></li>
    </ol>

    <h1>Sub-Grupos <a href="{{ route('subgrupos.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Sub-Grupos</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('subgrupos.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descrição</th>
                        <th>Espécie</th>
                        <th style="width: 250px">Ações</th>
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
                        <td>
                            {{ $subgrupo->especie }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('subgrupos.edit', $subgrupo->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('subgrupos.show', $subgrupo->id)}}" class="btn btn-warning">Ver</a>
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
