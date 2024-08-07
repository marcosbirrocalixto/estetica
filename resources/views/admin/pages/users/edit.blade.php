@extends('adminlte::page')

@section('title', "Editar Perfil {$user->name}")

@section('content_header')
    <h1>Editar Perfil <strong>{{ $user->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.users._partials.form')
          </form>
        </div>
    </div>
@stop
