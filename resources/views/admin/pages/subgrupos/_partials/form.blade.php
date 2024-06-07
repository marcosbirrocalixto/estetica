@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Codigo:</label>
    <input type="text" name="codigo" class="form-control" placeholder="Código" value="{{ $subgrupo->codigo ?? old('codigo')}} ">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{ $subgrupo->description ?? old('description')}} ">
</div>
<div class="form-group">
    <label>Espécie:</label>
    <input type="text" name="especie" class="form-control" placeholder="Espécie" value="{{ $subgrupo->description ?? old('especie')}} ">
</div>
<div class="form-group">
    <label for="active">Status</label>
    @if ( isset($subgrupo) and $subgrupo->ativo == 'A' )
        <select class="form-control" name="active">
            <option selected value="A">ATIVO</option>
            <option value="I">INATIVO</option>
        </select>
    @else
        <select class="form-control" name="ativo">
            <option selected value="A">ATIVO</option>
            <option value="I">INATIVO</option>
        </select>
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
