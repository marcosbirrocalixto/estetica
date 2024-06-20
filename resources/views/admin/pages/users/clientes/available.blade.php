@extends('adminlte::page')

@section('title', "Clientes Disponíveis para o usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" class="">Perfis</a></li>
    </ol>

    <h1>Clientes Disponíveis para o usuário <b>{{$user->name}}</b></h1>

    @include('admin.includes.alerts')

@stop



@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('users.clientes.available', $user->id)}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Palavra de pesquisa" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('users.clientes.attach', $user->id)}}" method="post">
                        @csrf

                        @foreach ($clientes as $cliente)
                        <tr>
                            <td>
                                <input type="checkbox" name="clientes[]" value="{{ $cliente->id }}">
                            </td>
                            <td>
                                {{ $cliente->name }}
                            </td>
                            <td>
                                {{ $cliente->email }}
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="300">
                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
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
