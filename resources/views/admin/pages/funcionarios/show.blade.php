@extends('adminlte::page')

@section('title', "Detalhe do Funcionário {{ $funcionario->name }}")

@section('content_header')
    <h1>Detalhes do Funcionário <b>{{ $funcionario->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $funcionario->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $funcionario->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Funcionário: {{ $funcionario->name }}</button>
        </form>
    </div>
@stop
