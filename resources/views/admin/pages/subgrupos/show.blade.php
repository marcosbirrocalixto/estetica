@extends('adminlte::page')

@section('title', "Detalhe do Sub-Grupo {{ $subgrupo->codigo }}")

@section('content_header')
    <h1>Detalhes do Sub-Grupo <b>{{ $subgrupo->codigo }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $subgrupo->codigo }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $subgrupo->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('subgrupos.destroy', $subgrupo->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Sub-Grupo: {{ $subgrupo->name }}</button>
        </form>
    </div>
@stop
