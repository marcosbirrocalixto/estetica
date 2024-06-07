@extends('adminlte::page')

@section('title', 'Cadastrar Novo Sub-Grupo')

@section('content_header')
    <h1>Cadastrar Novo Sub-Grupo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('subgrupos.store')}}" class="form" method="post">
                @include('admin.pages.subgrupos._partials.form')
            </form>
        </div>
    </div>
@stop
