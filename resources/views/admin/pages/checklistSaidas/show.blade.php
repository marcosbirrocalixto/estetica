@extends('adminlte::page')

@section('title', "Detalhe do Checklist Saida {{ $checklistEntrada->name }}")

@section('content_header')
    <h1>Detalhes do Checklist Saida <b>{{ $checklistEntrada->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $checklistEntrada->name }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('checklistEntradas.destroy', $checklistEntrada->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Checklist Entrada: {{ $checklistEntrada->name }}</button>
        </form>
    </div>
@stop
