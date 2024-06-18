@extends('adminlte::page')

@section('title', 'Cadastrar Tipo Pessoa - CNPJ/CPF')

@section('content_header')
    <h1>Cadastrar Novo Tipo Pessoa - CNPJ/CPF</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tipopessoas.store')}}" class="form" method="post">
                @include('admin.pages.tipopessoas._partials.form')
            </form>
        </div>
    </div>
@stop
