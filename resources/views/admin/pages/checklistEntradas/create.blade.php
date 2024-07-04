@extends('adminlte::page')

@section('title', 'Cadastrar Novo Checklist Entrada')

@section('content_header')
    <h1>Cadastrar Novo Checklist Entrada</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('checklistEntradas.store')}}" class="form" method="post">
                @include('admin.pages.checklistEntradas._partials.form')
            </form>
        </div>
    </div>
@stop
