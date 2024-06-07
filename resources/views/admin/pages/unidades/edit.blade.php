@extends('adminlte::page')

@section('title', "Editar Unidade {$unidade->code}")

@section('content_header')
    <h1>Editar Unidade <strong>{{ $unidade->code }} - {{ $unidade->description }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('unidades.update', $unidade->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.unidades._partials.form')
          </form>
        </div>
    </div>
@stop
