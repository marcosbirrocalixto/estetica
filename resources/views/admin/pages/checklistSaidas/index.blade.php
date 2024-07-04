@extends('adminlte::page')

@section('title', 'Checklist Saida')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('checklistSaidas.index') }}" class="">Checklist Saida</a></li>
    </ol>

    <h1>Checklist Saida <a href="{{ route('checklistSaidas.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Checklist Saida</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('checklistSaidas.search')}}" method="POST" class="form form-inline">
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
                    @foreach ($checklistSaidas as $checklistSaida)
                    <tr>
                        <td>
                            {{ $checklistSaida->name }}
                        </td>
                        <td style="width: 5px">
                            <a href="{{route('checklistSaidas.edit', $checklistSaida->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('checklistSaidas.show', $checklistSaida->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $checklistSaidas->appends($filters)->links() !!}
            @else
                {!! $checklistSaidas->links() !!}
            @endif

        </div>
    </div>
@stop
