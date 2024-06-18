@extends('adminlte::page')

@section('title', "Editar Detalhe {$detalhe->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.index') }}">Serviços</a></li>
        <li class="breadcrumb-item"><a href="{{ route('detalhes.acompanhamento.index', $acompanhamento->id) }}">Detalhes</a></li>
    </ol>

    <h1>Editar Detalhe {{ $detalhe->name }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('detalhes.acompanhamento.update', [$acompanhamento->id, $detalhe->id])}}" class="form" method="post">
                @method('PUT')
                @include('admin.pages.servicos.acompanhamentos.detalhes._partials.form')
            </form>
        </div>
    </div>
@endsection
