@extends('adminlte::page')

@section('title', "Detalhe do Tipo Serviços {{ $servico->name }}")

@section('content_header')
    <h1>Detalhes do Tipo Serviços <b>{{ $servico->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $servico->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $servico->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar a Permissão: {{ $servico->name }}</button>
        </form>
    </div>
@stop
