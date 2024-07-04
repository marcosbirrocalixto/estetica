@extends('adminlte::page')

@section('title', 'Cadastrar Novo Checklist Saida')

@section('content_header')
    <h1>Cadastrar Novo Checklist Saida</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('checklistSaidas.store')}}" class="form" method="post">
                @include('admin.pages.checklistSaidas._partials.form')
            </form>
        </div>
    </div>
@stop
