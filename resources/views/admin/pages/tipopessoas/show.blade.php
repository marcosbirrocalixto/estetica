@extends('adminlte::page')

@section('title', "Detalhe do Tipo Pessoa - CNPJ/CPF {{ $tipopessoa->name }}")

@section('content_header')
    <h1>Detalhes do Tipo Pessoa - CNPJ/CPF <b>{{ $tipopessoa->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $tipopessoa->name }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('tipopessoas.destroy', $tipopessoa->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Tipo Pessoa - CNPJ/CPFp: {{ $tipopessoa->name }}</button>
        </form>
    </div>
@stop
