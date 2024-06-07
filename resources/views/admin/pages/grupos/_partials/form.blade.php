@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $grupo->name ?? old('name')}} ">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="description" class="form-control" placeholder="Nome" value="{{ $grupo->description ?? old('description')}} ">
</div>
<div class="form-group">
    <label>Foto</label>
    <input type="file" name="foto" class="form-control" value="{{ $grupo->foto ?? old('foto')}} ">
</div>
<div class="form-group">
    <label for="active">Status</label>
    @if ( isset($grupo) and $grupo->ativo == 'A' )
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
