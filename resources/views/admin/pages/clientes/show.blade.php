@extends('adminlte::page')

@section('title', "Detalhe do Cliente {{ $cliente->name }}")

@section('content_header')
    <h1>Detalhes do Cliente <b>{{ $cliente->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $cliente->name }}
                </li>
                <li>
                    <strong>E-mail: </strong> {{ $cliente->email }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Cliente: {{ $cliente->name }}</button>
        </form>
    </div>
@stop
