@extends('adminlte::page')

@section('title', "Editar Grupo {$grupo->name}")

@section('content_header')
    <h1>Editar Tipo Serviço <strong>{{ $grupo->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('grupos.update', $grupo->id)}}" class="form" method="post" enctype="multpart/form-data">
                @method('PUT')

                @include('admin.pages.grupos._partials.form')
          </form>
        </div>
    </div>
@stop
