@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $servico->name ?? old('name')}} ">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{ $servico->description ?? old('description')}} ">
</div>
<div class="form-group">
    <label>Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $servico->price ?? old('price') }}">
</div>
<div class="form-group">
    <label>Tempo Previsto:</label>
    <input type="text" name="tempoPrevisto" class="form-control" placeholder="Tempo Previsto:" value="{{ $servico->tempoPrevisto ?? old('tempoPrevisto') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
