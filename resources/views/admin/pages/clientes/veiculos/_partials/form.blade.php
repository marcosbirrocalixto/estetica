@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Placa:</label>
    <input type="text" name="placa" class="form-control" placeholder="Placa" value="{{ $veiculo->placa ?? old('placa')}} ">
</div>
<div class="form-group">
    <label>Marca:</label>
    <input type="text" name="marca" class="form-control" placeholder="Marca" value="{{ $veiculo->marca ?? old('marca')}} ">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
