@extends('adminlte::page')

@section('title', "Editar Tipo Usuário {$tipousuario->name}")

@section('content_header')
    <h1>Editar Tipo Usuário <strong>{{ $tipousuario->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tipousuarios.update', $tipousuario->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.tipousuarios._partials.form')
          </form>
        </div>
    </div>
@stop
