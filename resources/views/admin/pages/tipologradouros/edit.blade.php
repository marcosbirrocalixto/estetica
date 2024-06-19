@extends('adminlte::page')

@section('title', "Editar Tipo Logradouro {$tipologradouro->name}")

@section('content_header')
    <h1>Editar Tipo Logradouro <strong>{{ $tipologradouro->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tipologradouros.update', $tipologradouro->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.tipologradouros._partials.form')
          </form>
        </div>
    </div>
@stop
