@extends('adminlte::page')

@section('title', 'Cadastrar Novo Tipo Usuário')

@section('content_header')
    <h1>Cadastrar Novo Tipo Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tipousuarios.store')}}" class="form" method="post">
                @include('admin.pages.tipousuarios._partials.form')
            </form>
        </div>
    </div>
@stop
