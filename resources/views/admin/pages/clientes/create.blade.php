@extends('adminlte::page')

@section('title', 'Cadastrar cliente')

@section('content_header')
    <h1>Cadastrar cliente''</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('clientes.store')}}" class="form" method="post">
                @include('admin.pages.clientes._partials.form')
            </form>
        </div>
    </div>
@stop
