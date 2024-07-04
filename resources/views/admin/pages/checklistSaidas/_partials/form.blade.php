@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $checklistSaida->name ?? old('name')}} ">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
