@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $cliente->name ?? old('name')}} ">
</div>
<div class="form-group">
    <label>E-mail:</label>
    <input type="text" name="email" class="form-control" placeholder="E-mail" value="{{ $cliente->email ?? old('email')}} ">
</div>
@if ($cliente->id ?? '')
<div class="form-group">
    <label for="tipopessoa_id">Tipo Usuário</label>
    <select class="form-control" name="tipopessoa_id">
        @foreach ( $tipopessoas as $tipopessoa )
            @if ($cliente->tipopessoa_id == $tipopessoa->id )
                <option selected value="{{ $tipopessoa->id }}">{{ $tipopessoa->name }}</option>
            @else
                <option value="{{ $tipopessoa->id }}">{{ $tipopessoa->name }}</option>
            @endif
        @endforeach
    </select>
</div>
@else
<div class="form-group">
    <label for="tipopessoa_id">Tipo Pessoa</label>
    <select class="form-control" name="tipopessoa_id">
        @foreach ( $tipopessoas as $tipopessoa )
            <option value="{{ $tipopessoa->id }}">{{ $tipopessoa->name }}</option>
        @endforeach
    </select>
</div>
@endif
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
