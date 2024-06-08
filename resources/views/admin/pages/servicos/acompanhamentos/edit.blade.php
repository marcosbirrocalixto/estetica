@extends('adminlte::page')

@section('title', "Editar Acompanhamento {$acompanhamento->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.index') }}">Serviços</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicos.show', $servico->id) }}">{{$servico->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('acompanhamentos.servico.index', $servico->id) }}">Acompanhamentos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('acompanhamentos.servico.edit', [$servico->id, $acompanhamento->id]) }}" class="active">Editar</a></li>
    </ol>

    <h1>Editar Detalhe {{ $acompanhamento->name }} <a href="{{ route('servicos.create')}}"></a>  </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('acompanhamentos.servico.update', [$servico->id, $acompanhamento->id])}}" class="form" method="post">
                @method('PUT')
                @include('admin.pages.servicos.acompanhamentos._partials.form')
            </form>
        </div>
    </div>
@endsection
