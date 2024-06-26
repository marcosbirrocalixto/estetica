@include('admin.includes.alerts')

@csrf

<div class="container">
    <div class="row">
        <div class="form-group col-3">
            <label>Placa:</label>
            <input type="hidden" name="veiculo_id" class="form-control" placeholder="id" readonly value="{{ $veiculo->id ?? old('id')}} ">
            <input type="text" name="placa" class="form-control" placeholder="Placa" readonly value="{{ $veiculo->placa ?? old('placa')}} ">
        </div>
        <div class="form-group col-3">
                <label>Cliente:</label>
                <input type="hidden" name="cliente_id" class="form-control" placeholder="Cliente" readonly value="{{ $veiculo->cliente->id ?? old('id')}} ">
                <input type="text" name="cliente_name" class="form-control" placeholder="Cliente" readonly value="{{ $veiculo->cliente->name ?? old('name')}} ">
        </div>


        <div class="form-group col-3">
                <label>Usuário:</label>
                <input type="hidden" name="user_id" class="form-control" placeholder="Usuário" readonly value="{{ $user->id ?? old('id')}} " >
                <input type="text" name="usuario_name" class="form-control" placeholder="Usuário" readonly value="{{ $user->name ?? old('name')}} " >
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="form-group col-3">
            <label>Entrada Oficina:</label>
            <input type="datetime-local" name="dataentrada" id="dataentrada" class="form-control">
        </div>
        <div class="form-group col-3">
            <label>Previsão Entrega:</label>
            <input type="datetime-local" name="dataprogramada" id="dataprogramada" class="form-control">
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="form-group col-3">
            <label>KM Inicial:</label>
            <input type="number" name="kminicial" id="kminicial" class="form-control">
        </div>
        <div class="form-group col-3">
            <label>Combustível:</label><br>
            <select name="combustivel" id="cars">
                <option value="25">25%</option>
                <option value="50">50%</option>
                <option value="75">75%</option>
                <option value="100">100%</option>
            </select>
        </div>
    </div>
</div>

<label>Observação:</label><p>
    <textarea id="observacao" name="observacao" rows="4" cols="50">

    </textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
