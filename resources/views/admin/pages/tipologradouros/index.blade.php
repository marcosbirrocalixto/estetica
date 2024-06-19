@extends('adminlte::page')

@section('title', 'Tipo Logradouro')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('tipologradouros.index') }}" class="">Tipo Logradouro</a></li>
    </ol>

    <h1>Tipo Logradouro  <a href="{{ route('tipologradouros.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Tipo Logradouro</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('tipologradouros.search')}}" method="POST" class="form form-inline">
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
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipologradouros as $tipologradouro)
                    <tr>
                        <td>
                            {{ $tipologradouro->name }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('tipologradouros.edit', $tipologradouro->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('tipologradouros.show', $tipologradouro->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tipologradouros->appends($filters)->links() !!}
            @else
                {!! $tipologradouros->links() !!}
            @endif

        </div>
    </div>
@stop
