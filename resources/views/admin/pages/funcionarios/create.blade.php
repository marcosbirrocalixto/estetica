@extends('adminlte::page')

@section('title', 'Cadastrar Novo Funcionário')

@section('content_header')
    <h1>Cadastrar Novo Funcionário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('funcionarios.store')}}" class="form" method="post">
                @include('admin.pages.funcionarios._partials.form')
            </form>
        </div>
    </div>
@stop
