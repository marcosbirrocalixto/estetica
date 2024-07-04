@extends('adminlte::page')

@section('title', 'Checklist Entrada')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('checklistEntradas.index') }}" class="">Checklist Entrada</a></li>
    </ol>

    <h1>Checklist Entrada <a href="{{ route('checklistEntradas.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Checklist Entrada</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('checklistEntradas.search')}}" method="POST" class="form form-inline">
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
                    @foreach ($checklistEntradas as $checklistEntrada)
                    <tr>
                        <td>
                            {{ $checklistEntrada->name }}
                        </td>
                        <td style="width: 5px">
                            <a href="{{route('checklistEntradas.edit', $checklistEntrada->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('checklistEntradas.show', $checklistEntrada->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $checklistEntradas->appends($filters)->links() !!}
            @else
                {!! $checklistEntradas->links() !!}
            @endif

        </div>
    </div>
@stop
