@extends('adminlte::page')

@section('title', 'UF')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('ufs.index') }}" class="">UFs</a></li>
    </ol>

    <h1>UFs  <a href="{{ route('ufs.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar UF</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('ufs.search')}}" method="POST" class="form form-inline">
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
                    @foreach ($ufs as $uf)
                    <tr>
                        <td>
                            {{ $uf->sigla }}
                        </td>
                        <td>
                            {{ $uf->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('ufs.edit', $uf->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('ufs.show', $uf->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $ufs->appends($filters)->links() !!}
            @else
                {!! $ufs->links() !!}
            @endif

        </div>
    </div>
@stop
