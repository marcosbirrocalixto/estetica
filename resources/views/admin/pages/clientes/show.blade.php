@extends('adminlte::page')

@section('title', "Detalhe do Tipo Usuário {{ $tipousuario->name }}")

@section('content_header')
    <h1>Detalhes do Tipo Usuário <b>{{ $tipousuario->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $tipousuario->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $tipousuario->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('tipousuarios.destroy', $tipousuario->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Tipo Usuário: {{ $tipousuario->name }}</button>
        </form>
    </div>
@stop
