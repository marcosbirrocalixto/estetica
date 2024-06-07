@extends('adminlte::page')

@section('title', "Editar Sub-Grupo {$subgrupo->name}")

@section('content_header')
    <h1>Editar Sub-Grupo <strong>{{ $subgrupo->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('subgrupos.update', $subgrupo->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.subgrupos._partials.form')
          </form>
        </div>
    </div>
@stop
