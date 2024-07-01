@extends('adminlte::page')

@section('title', "Serviços Disponíveis da Ordem Serviço {$ordemservico->id}")

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('ordemservicos.servicos', $ordemservico->id) }}" class="">Ordens Serviços</a></li>
    </ol>

    <h1>Serviços Disponíveis da Ordem Serviço <b>{{$ordemservico->id}}</b></h1>

    @include('admin.includes.alerts')

@stop



@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('ordemservicos.servicos.available', $ordemservico->id)}}" method="POST" class="form form-inline">
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
                        <th>Funcionário</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('ordemservicos.servicos.attach', $ordemservico->id)}}" method="post">
                        @csrf

                        @foreach ($servicos as $servico)
                        <tr>
                            <td>
                                <input type="checkbox" name="servicos[]" value="{{ $servico->id }}">
                            </td>
                            <td>
                                {{ $servico->name }}
                            </td>
                            <td>
                                {{ $servico->description }}
                            </td>
                            <td>
                            <div class="form-group">
                                <select class="form-control" name="funcionarios[]">
                                    <option value=""></option>
                                    @foreach ( $funcionarios as $funcionario )
                                        <option value="{{ $funcionario->id }}">{{ $funcionario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                {!! $servicos->appends($filters)->links() !!}
            @else
                {!! $servicos->links() !!}
            @endif

        </div>
    </div>
@stop
