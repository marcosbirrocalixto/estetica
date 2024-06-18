@extends('adminlte::page')

@section('title', 'Tipo Pessoa - CNPJ/CPF')

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('tipopessoas.index') }}" class="">Tipo Pessoa - CNPJ/CPF</a></li>
    </ol>

    <h1>Tipo Pessoa - CNPJ/CPF  <a href="{{ route('tipopessoas.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Tipo Pessoa - CNPJ/CPF</a></h1>

@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('tipopessoas.search')}}" method="POST" class="form form-inline">
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
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipopessoas as $tipopessoa)
                    <tr>
                        <td>
                            {{ $tipopessoa->name }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('tipopessoas.edit', $tipopessoa->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('tipopessoas.show', $tipopessoa->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tipopessoas->appends($filters)->links() !!}
            @else
                {!! $tipopessoas->links() !!}
            @endif

        </div>
    </div>
@stop
