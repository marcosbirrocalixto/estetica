@extends('adminlte::page')

@section('title', "Editar Checklist Saida {$checklistSaida->name}")

@section('content_header')
    <h1>Editar Checklist Saida <strong>{{ $checklistSaida->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('checklistSaidas.update', $checklistSaida->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.checklistSaidas._partials.form')
          </form>
        </div>
    </div>
@stop
