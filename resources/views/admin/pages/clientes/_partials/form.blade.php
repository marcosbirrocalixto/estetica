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
<div class="form-group">
    <label>CNPJ/CPF:</label>
    <input type="text" name="cnpj_cpf" class="form-control" placeholder="CNPJ/CPF" value="{{ $cliente->cnpj_cpf ?? old('cnpj_cpf')}} ">
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
    <label>Celular:</label>
    <input type="text" name="celular" class="form-control" placeholder="Celular" value="{{ $cliente->celular ?? old('celular')}} ">
</div>
<div class="form-group">
    <label>Telefone:</label>
    <input type="text" name="telefone" class="form-control" placeholder="Telefone" value="{{ $cliente->telefone ?? old('telefone')}} ">
</div>
<div class="form-group">
    <label>Identidade:</label>
    <input type="text" name="identidade" class="form-control" placeholder="Identidade" value="{{ $cliente->identidade ?? old('identidade')}} ">
</div>
<div class="form-group">
    <label>CEP:</label>
    <input type="text" name="cep" class="form-control" placeholder="CEP" value="{{ $cliente->cep ?? old('cep')}} ">
</div>
@if ($cliente->id ?? '')
<div class="form-group">
    <label for="tipologradouro_id">Tipo Logradouro</label>
    <select class="form-control" name="tipologradouro_id">
        @foreach ( $tipologradouros as $tipologradouro )
            @if ($cliente->tipologradouro_id == $tipologradouro->id )
                <option selected value="{{ $tipologradouro->id }}">{{ $tipologradouro->name }}</option>
            @else
                <option value="{{ $tipologradouro->id }}">{{ $tipologradouro->name }}</option>
            @endif
        @endforeach
    </select>
</div>
@else
<div class="form-group">
    <label for="tipologradouro_id">Tipo Logradouro</label>
    <select class="form-control" name="tipologradouro_id">
        @foreach ( $tipologradouros as $tipologradouro )
            <option value="{{ $tipologradouro->id }}">{{ $tipologradouro->name }}</option>
        @endforeach
    </select>
</div>
@endif
<div class="form-group">
    <label>Endereço:</label>
    <input type="text" name="endereco" class="form-control" placeholder="Endereço" value="{{ $cliente->endereco ?? old('endereco')}} ">
</div>
<div class="form-group">
    <label>Número:</label>
    <input type="text" name="numero" class="form-control" placeholder="Número" value="{{ $cliente->numero ?? old('numero')}} ">
</div>
<div class="form-group">
    <label>Complemento:</label>
    <input type="text" name="complemento" class="form-control" placeholder="Complemento" value="{{ $cliente->complemento ?? old('complemento')}} ">
</div>
<div class="form-group">
    <label>Bairro:</label>
    <input type="text" name="bairro" class="form-control" placeholder="Bairro" value="{{ $cliente->bairro ?? old('bairro')}} ">
</div>
<div class="form-group">
    <label>Cidade:</label>
    <input type="text" name="cidade" class="form-control" placeholder="Cidade" value="{{ $cliente->cidade ?? old('cidade')}} ">
</div>
@if ($cliente->id ?? '')
<div class="form-group">
    <label for="uf_id">UF</label>
    <select class="form-control" name="uf_id">
        @foreach ( $ufs as $uf )
            @if ($cliente->uf_id == $uf->id )
                <option selected value="{{ $uf->id }}">{{ $uf->sigla }} - {{ $uf->description }}</option>
            @else
                <option value="{{ $uf->id }}">{{ $uf->sigla }} - {{ $uf->description }}</option>
            @endif
        @endforeach
    </select>
</div>
@else
<div class="form-group">
    <label for="uf_id">UF</label>
    <select class="form-control" name="uf_id">
        @foreach ( $ufs as $uf )
            <option value="{{ $uf->id }}">{{ $uf->sigla }} - {{ $uf->description }}</option>
        @endforeach
    </select>
</div>
@endif
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
