@extends('adminlte::page')

@section('title', "Detalhe do Tipo Logradouro {{ $tipologradouro->name }}")

@section('content_header')
    <h1>Detalhes do Tipo Logradouro <b>{{ $tipologradouro->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $tipologradouro->name }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('tipologradouros.destroy', $tipologradouro->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Tipo Logradouro: {{ $tipologradouro->name }}</button>
        </form>
    </div>
@stop
