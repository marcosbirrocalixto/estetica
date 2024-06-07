@extends('adminlte::page')

@section('title', 'Cadastrar Novo Unidade')

@section('content_header')
    <h1>Cadastrar Novo Unidade</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('unidades.store')}}" class="form" method="post">
                @include('admin.pages.unidades._partials.form')
            </form>
        </div>
    </div>
@stop
