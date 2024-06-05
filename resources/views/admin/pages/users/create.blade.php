@extends('adminlte::page')

@section('title', 'Cadastrar Novo Perfil')

@section('content_header')
    <h1>Cadastrar Novo Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store')}}" class="form" method="post">
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop
