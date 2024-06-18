@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Sigla:</label>
    <input type="text" name="sigla" class="form-control" placeholder="Sigla" value="{{ $uf->sigla ?? old('sigla')}} ">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{ $uf->description ?? old('description')}} ">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
