@extends('adminlte::page')

@section('title', 'Cadastrar Novo Tipo Serviço')

@section('content_header')
    <h1>Cadastrar Novo Tipo Serviço</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tiposervicos.store')}}" class="form" method="post">
                @include('admin.pages.tiposervicos._partials.form')
            </form>
        </div>
    </div>
@stop
