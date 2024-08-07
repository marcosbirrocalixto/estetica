@extends('adminlte::page')

@section('title', 'Cadastrar Tipo Logradouro')

@section('content_header')
    <h1>Cadastrar Novo Tipo Logradouro</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tipologradouros.store')}}" class="form" method="post">
                @include('admin.pages.tipologradouros._partials.form')
            </form>
        </div>
    </div>
@stop
