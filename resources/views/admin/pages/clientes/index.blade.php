@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('clientes.index') }}" class="">Clientes</a></li>
    </ol>

    <h1>Clientes <a href="{{ route('clientes.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Cliente</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('clientes.search')}}" method="POST" class="form form-inline">
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
                        <th>CNPJ/CPF</th>
                        <th style="width: 350px">Ações</th>
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
                        <td>
                            {{ $cliente->cnpj_cpf }}
                        </td>
                        <td style="width: 50px">
                            <a href="{{route('clientes.edit', $cliente->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('clientes.show', $cliente->id)}}" class="btn btn-warning">Ver</a>
                            <a href="{{route('clientes.index', $cliente->id)}}" class="btn btn-primary">Usuário</a>
                            <a href="{{route('veiculos.cliente.index', $cliente->id)}}" class="btn btn-primary">Veículos</a>
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
