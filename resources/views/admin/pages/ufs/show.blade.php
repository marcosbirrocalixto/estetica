@extends('adminlte::page')

@section('title', "Detalhe do UF {{ $uf->sigla }}")

@section('content_header')
    <h1>Detalhes do UF <b>{{ $uf->sigla }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Sigla: </strong> {{ $uf->sigla }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $uf->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('ufs.destroy', $uf->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o UF: {{ $uf->sigla }}</button>
        </form>
    </div>
@stop
