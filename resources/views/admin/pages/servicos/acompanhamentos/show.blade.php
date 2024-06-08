@extends('adminlte::page')
do detalhe
@section('title', "Detalhes  {$acompanhamento->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.index') }}">Serviços</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.show', $servico->id) }}">{{$servico->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('acompanhamentos.servico.index', $servico->id) }}">Acompanhamentos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('acompanhamentos.servico.show', [$servico->id, $acompanhamento->id]) }}" class="active">Detalhes</a></li>
    </ol>

    <h1>Detalhes do Acompanhamento {{ $acompanhamento->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $acompanhamento->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $acompanhamento->description }}
                </li>
            </ul>
        </div>
        <div class="car-footer">
        <form action="{{ route('acompanhamentos.servico.delete', [$servico->id, $acompanhamento->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o detalhe: {{ $acompanhamento->name }}</button>
        </form>
        </div>
    </div>
@endsection
