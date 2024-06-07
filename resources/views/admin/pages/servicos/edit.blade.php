@extends('adminlte::page')

@section('title', "Editar Tipo Serviço {$servico->name}")

@section('content_header')
    <h1>Editar Tipo Serviço <strong>{{ $servico->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('servicos.update', $servico->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.servicos._partials.form')
          </form>
        </div>
    </div>
@stop
