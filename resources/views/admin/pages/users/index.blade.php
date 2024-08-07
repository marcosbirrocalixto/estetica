@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" class="">Usuáris</a></li>
    </ol>

    <h1>Perfis  <a href="{{ route('users.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Usuário</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('users.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo</th>
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->tipousuario->name }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('users.show', $user->id)}}" class="btn btn-warning">Ver</a>
                            <a href="{{route('users.clientes', $user->id)}}" class="btn btn-info"><i class="fas fa-users">Clientes</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
            @endif

        </div>
    </div>
@stop
