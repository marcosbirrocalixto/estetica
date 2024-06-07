@extends('adminlte::page')

@section('title', "Detalhe do Unidade {{ $unidade->code }}")

@section('content_header')
    <h1>Detalhes do Unidade <b>{{ $unidade->code }} - {{ $unidade->description }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $unidade->code }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $unidade->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('unidades.destroy', $unidade->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar a Permissão: {{ $unidade->name }}</button>
        </form>
    </div>
@stop
