@extends('adminlte::page')

@section('title', "Editar Tipo Pessoa - CNPJ/CPF {$tipopessoa->name}")

@section('content_header')
    <h1>Editar Tipo Pessoa - CNPJ/CPF - CNPJ/CPF <strong>{{ $tipopessoa->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tipopessoas.update', $tipopessoa->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.tipopessoas._partials.form')
          </form>
        </div>
    </div>
@stop
