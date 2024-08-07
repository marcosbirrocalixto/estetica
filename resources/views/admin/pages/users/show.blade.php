@extends('adminlte::page')

@section('title', "Detalhe do Perfil {{ $user->name }}")

@section('content_header')
    <h1>Detalhes do Perfil <b>{{ $user->name }}</b></h1>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $user->name }}
                </li>
                <li>
                    <strong>E-mail: </strong> {{ $user->email }}
                </li>
            </ul>

        @include('admin.includes.alerts')

        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Usuário: {{ $user->name }}</button>
        </form>
    </div>
@stop
