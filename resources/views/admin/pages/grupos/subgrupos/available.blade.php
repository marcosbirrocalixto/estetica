@extends('adminlte::page')

@section('title', "Sub-grupos Disponíveis do Grupo {$grupo->name}")

@section('content_header')
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>--}}
        <li class="breadcrumb-item active"><a href="{{ route('grupos.index') }}" class="">Perfis</a></li>
    </ol>

    <h1>Sub-grupos disponíveis do Grupo <b>{{$grupo->name}}</b></h1>

    @include('admin.includes.alerts')

@stop



@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('grupos.subgrupos.available', $grupo->id)}}" method="POST" class="form form-inline">
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
                        <th>Código</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('grupos.subgrupos.attach', $grupo->id)}}" method="post">
                        @csrf

                        @foreach ($subgrupos as $subgrupo)
                        <tr>
                            <td>
                                <input type="checkbox" name="subgrupos[]" value="{{ $subgrupo->id }}">
                            </td>
                            <td>
                                {{ $subgrupo->codigo }}
                            </td>
                            <td>
                                {{ $subgrupo->description }}
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
                {!! $subgrupos->appends($filters)->links() !!}
            @else
                {!! $subgrupos->links() !!}
            @endif

        </div>
    </div>
@stop
