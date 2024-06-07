@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Código:</label>
    <input type="text" name="code" class="form-control" placeholder="Código" value="{{ $unidade->code ?? old('code')}} ">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="description" class="form-control" placeholder="Nome" value="{{ $unidade->description ?? old('description')}} ">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
