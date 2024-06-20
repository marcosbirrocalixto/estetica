@extends('adminlte::page')

@section('title', "Clientes do usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" class="">Usuários</a></li>
    </ol>

    <h1>Clientes do usuário <b>{{$user->name}}</b></h1>

    <a href="{{ route('users.clientes.available', $user->id)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Clienteo</a>
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
                        <th>Descrição</th>
                        <th style="width: 50px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>
                            {{ $cliente->name }}
                        </td>
                        <td>
                            {{ $cliente->email }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('users.cliente.detach', [$user->id, $cliente->id])}}" class="btn btn-warning">Desvinvular</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $clientes->appends($filters)->links() !!}
            @else
                {!! $clientes->links() !!}
            @endif

        </div>
    </div>
@stop
