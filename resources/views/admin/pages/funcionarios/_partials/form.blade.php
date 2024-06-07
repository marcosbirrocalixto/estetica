@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $funcionario->name ?? old('name')}} ">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="description" class="form-control" placeholder="Nome" value="{{ $funcionario->description ?? old('description')}} ">
</div>
<div class="form-group">
    <label>Endereço:</label>
    <input type="text" name="adress" class="form-control" placeholder="Endereço" value="{{ $funcionario->adress ?? old('adress')}} ">
</div>
<div class="form-group">
    <label>Foto</label>
    <input type="file" name="image" class="form-control" value="{{ $funcionario->image ?? old('image')}} ">
</div>
<div class="form-group">
    <label for="active">Status</label>
    @if ( isset($funcionario) and $funcionario->active == 'A' )
        <select class="form-control" name="active">
            <option selected value="A">ATIVO</option>
            <option value="I">INATIVO</option>
        </select>
    @else
        <select class="form-control" name="active">
            <option selected value="A">ATIVO</option>
            <option value="I">INATIVO</option>
        </select>
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
