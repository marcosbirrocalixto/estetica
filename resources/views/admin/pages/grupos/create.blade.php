@extends('adminlte::page')

@section('title', 'Cadastrar Novo Grupo')

@section('content_header')
    <h1>Cadastrar Novo Grupo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('grupos.store')}}" class="form" method="post" enctype="multpart/form-data">
                @include('admin.pages.grupos._partials.form')
            </form>
        </div>
    </div>
@stop
