@extends('adminlte::page')

@section('title', 'Tipo usuários')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('tipousuarios.index') }}" class="">Tipo usuários</a></li>
    </ol>

    <h1>Tipo usuários  <a href="{{ route('tipousuarios.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Tipo usuário</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('tipousuarios.search')}}" method="POST" class="form form-inline">
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
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipousuarios as $tipousuario)
                    <tr>
                        <td>
                            {{ $tipousuario->name }}
                        </td>
                        <td>
                            {{ $tipousuario->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('tipousuarios.edit', $tipousuario->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('tipousuarios.show', $tipousuario->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tipousuarios->appends($filters)->links() !!}
            @else
                {!! $tipousuarios->links() !!}
            @endif

        </div>
    </div>
@stop
