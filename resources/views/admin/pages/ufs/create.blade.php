@extends('adminlte::page')

@section('title', 'Cadastrar Novo UF')

@section('content_header')
    <h1>Cadastrar Novo UF</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ufs.store')}}" class="form" method="post">
                @include('admin.pages.ufs._partials.form')
            </form>
        </div>
    </div>
@stop
