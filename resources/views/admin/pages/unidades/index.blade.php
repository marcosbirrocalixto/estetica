@extends('adminlte::page')

@section('title', 'Unidade')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('unidades.index') }}" class="">Permissões</a></li>
    </ol>

    <h1>Unidade <a href="{{ route('unidades.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Unidade</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('unidades.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unidades as $unidade)
                    <tr>
                        <td>
                            {{ $unidade->code }}
                        </td>
                        <td>
                            {{ $unidade->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('unidades.edit', $unidade->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('unidades.show', $unidade->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $unidades->appends($filters)->links() !!}
            @else
                {!! $unidades->links() !!}
            @endif

        </div>
    </div>
@stop
