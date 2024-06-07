@extends('adminlte::page')

@section('title', "Editar Funcionárioo {$funcionario->name}")

@section('content_header')
    <h1>Editar Tipo Serviço <strong>{{ $funcionario->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('funcionarios.update', $funcionario->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.funcionarios._partials.form')
          </form>
        </div>
    </div>
@stop
