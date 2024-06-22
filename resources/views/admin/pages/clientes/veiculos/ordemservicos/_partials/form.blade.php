@include('admin.includes.alerts')

@csrf

<div class="container">
    <div class="row">
        <div class="form-group col-3">
            <label>Placa:</label>
            <input type="text" name="placa" class="form-control" placeholder="Placa" readonly value="{{ $veiculo->placa ?? old('placa')}} ">
        </div>
        <div class="form-group col-4">
            <label>Cliente:</label>
            <input type="text" name="name" class="form-control" placeholder="Nome" readonly value="{{ $veiculo->cliente->name ?? old('name')}} ">
        </div>
        <div class="form-group col-4">
        <label>Rcepção:</label>
            <input type="text" name="name" class="form-control" placeholder="Funcionário" readonly value="{{ $user->name ?? old('name')}} ">
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="form-group col-3">
            <label>Entrada Oficina:</label>
            <input type="datetime-local" name="dataplan" id="dataplan" class="form-control">
        </div>
        <div class="form-group col-3">
            <label>Previsão Entrega:</label>
            <input type="datetime-local" name="dataprog" id="dataprog" class="form-control">
        </div>
        <div class="form-group col-3">
            <label>Data Liberação:</label>
            <input type="datetime-local" name="dataprog" id="dataprog" class="form-control">
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="form-group col-3">
            <label>KM Inicial:</label>
            <input type="text" name="dataplan" id="dataplan" class="form-control">
        </div>
        <div class="form-group col-3">
            <label>Combustível:</label><br>
            <select name="cars" id="cars">
                <option value="volvo">25%</option>
                <option value="saab">50%</option>
                <option value="mercedes">75%</option>
                <option value="audi">100%</option>
            </select>
        </div>
        <div class="form-group col-3">
            <label>Checklist Recepção:</label>
            <input type="text" name="dataplan" id="dataplan" class="form-control">
        </div>
        <div class="form-group col-3">
            <label>Checklist Liberação:</label>
            <input type="text" name="dataplan" id="dataplan" class="form-control">
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
