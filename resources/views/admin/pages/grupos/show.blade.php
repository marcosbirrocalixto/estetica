@extends('adminlte::page')

@section('title', "Detalhe do Grupo {{ $grupo->name }}")

@section('content_header')
    <h1>Detalhes do Grupo <b>{{ $grupo->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $grupo->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $grupo->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Grupo: {{ $grupo->name }}</button>
        </form>
    </div>
@stop
