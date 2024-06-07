@extends('adminlte::page')

@section('title', "Detalhe do Tipo Serviços {{ $tiposervico->name }}")

@section('content_header')
    <h1>Detalhes do Tipo Serviços <b>{{ $tiposervico->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $tiposervico->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $tiposervico->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('tiposervicos.destroy', $tiposervico->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar a Permissão: {{ $tiposervico->name }}</button>
        </form>
    </div>
@stop
