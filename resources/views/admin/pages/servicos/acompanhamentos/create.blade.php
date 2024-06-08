@extends('adminlte::page')

@section('title', "Adicionar Novo Acompanhamento ao Serviço {$servico->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.index') }}">Serviços</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.show', $servico->id) }}">{{$servico->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('acompanhamentos.servico.index', $servico->id) }}">Acompanhamento</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('acompanhamentos.servico.create', $servico->id) }}" class="active">Novo Acompanhamento</a></li>
    </ol>

    <h1>Adicionar Novo Acompanhamento ao Serviço {{ $servico->name }} <a href="{{ route('servicos.create')}}"></a>  </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('acompanhamentos.servico.store', $servico->id)}}" class="form" method="post">
                @include('admin.pages.servicos.acompanhamentos._partials.form')
            </form>
        </div>
    </div>
@endsection
