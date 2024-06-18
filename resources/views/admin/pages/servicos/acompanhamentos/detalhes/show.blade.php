@extends('adminlte::page')
do detalhe
@section('title', "Detalhes  {$detalhe->name}")

@section('content_header')
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.index') }}">Serviços</a></li>
        <li class="breadcrumb-item"><a href="{{ route('detalhes.acompanhamento.index', $acompanhamento->id) }}">Detalhes</a></li>
    </ol>

    <h1>Detalhes {{ $detalhe->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $detalhe->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $detalhe->description }}
                </li>
            </ul>
        </div>
        <div class="car-footer">
        <form action="{{ route('detalhes.acompanhamento.delete', [$acompanhamento->id, $detalhe->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar: {{ $detalhe->name }}</button>
        </form>
        </div>
    </div>
@endsection
