@extends('adminlte::page')

@section('title', "Adicionar Novo Detalhe ao Acompanhamento {$acompanhamento->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.index') }}">Serviços</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.show', $acompanhamento->id) }}">{{$acompanhamento->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('acompanhamentos.servico.index', $acompanhamento->id) }}">Acompanhamento</a></li>
    </ol>

    <h1>Adicionar Novo Detalhe ao Acompanhamento {{ $acompanhamento->name }} <a href="{{ route('servicos.create')}}"></a>  </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('detalhes.acompanhamento.store', $acompanhamento->id)}}" class="form" method="post">
                @include('admin.pages.servicos.acompanhamentos.detalhes._partials.form')
            </form>
        </div>
    </div>
@endsection
