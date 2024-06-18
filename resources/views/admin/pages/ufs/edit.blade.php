@extends('adminlte::page')

@section('title', "Editar UF {$uf->name}")

@section('content_header')
    <h1>Editar UF <strong>{{ $uf->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ufs.update', $uf->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.ufs._partials.form')
          </form>
        </div>
    </div>
@stop
