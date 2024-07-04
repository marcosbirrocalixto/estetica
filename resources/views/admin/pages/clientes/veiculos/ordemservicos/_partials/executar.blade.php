@include('admin.includes.alerts')

@csrf

<div class="container">
    <div class="row">
        <div class="form-group">
            <label>Placa:</label>
            <input type="hidden" name="veiculo_id" class="form-control" placeholder="id" readonly value="{{ $veiculo->id ?? old('id')}} ">
            <input type="text" name="placa" class="form-control" placeholder="Placa" readonly value="{{ $veiculo->placa ?? old('placa')}} ">
        </div>
        <div class="form-group">
                <label>Cliente:</label>
                <input type="hidden" name="cliente_id" class="form-control" placeholder="Cliente" readonly value="{{ $veiculo->cliente->id ?? old('id')}} ">
                <input type="text" name="cliente_name" class="form-control" placeholder="Cliente" readonly value="{{ $veiculo->cliente->name ?? old('name')}} ">
        </div>


        <div class="form-group">
                <label>Usuário:</label>
                <input type="hidden" name="user_id" class="form-control" placeholder="Usuário" readonly value="{{ $user->id ?? old('id')}} " >
                <input type="text" name="usuario_name" class="form-control" placeholder="Usuário" readonly value="{{ $user->name ?? old('name')}} " >
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="form-group">
        <label>Data Entrada:</label>
                <input type="hidden" name="dataentrada" class="form-control" readonly value="{{ $ordemservico->dataentrada ?? old('dataentrada')}} ">
                <input type="text" name="dataentrada" class="form-control" placeholder="Data Entrada" readonly value="{{ $ordemservico->dataentrada ?? old('dataentrada')}} ">
        </div>
        <div class="form-group">
            <label>Data programada:</label>
                <input type="hidden" name="dataprogramada" class="form-control" readonly value="{{ $ordemservico->dataprogramada ?? old('dataprogramada')}} ">
                <input type="text" name="dataprogramada" class="form-control" placeholder="Data programada" readonly value="{{ $ordemservico->dataprogramada ?? old('dataprogramada')}} ">
        </div>
        <div class="form-group">
            <label>Encerramento:</label>
            <input type="hidden" name="dataencerrada" class="form-control" readonly value="{{ $ordemservico->dataencerrada ?? old('dataencerrada')}} ">
            <input type="datetime-local" name="dataencerrada" id="dataencerrada" class="form-control" value="{{ date( 'd/m/Y H:i' , strtotime($ordemservico->dataencerrada))}}">

        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="form-group">
            <label>KM Entrega:</label>
            <input type="text" name="kmentrega" id="kmentrega" class="form-control" value="{{ $ordemservico->kmentrega }}">
        </div>
        <div class="form-group">
            <label>Combustível Entrega:</label><br>
            <select name="combustivelEntrega" id="cars">
                <option value="25">25%</option>
                <option value="50">50%</option>
                <option value="75">75%</option>
                <option value="100">100%</option>
            </select>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Serviço</th>
                        <th>Descrição</th>
                        <th>Executante</th>
                        <th>Tempo Previsto</th>
                        <th>Tempo Realizado</th>
                        <th>Valor Cobrado</th>
                        <th>Como executar</th>
                    </tr>
                 </thead>
                <tbody>
                    @foreach ($servicos as $servico)
                    <tr>
                        <td>
                        <input type="hidden" name="ordemservico_id class="form-control" readonly value="{{ $servico->idOrdemServico }} ">
                        <input type="hidden" name="servico_id[<?php echo $i;?>] class="form-control" readonly value="{{ $servico->servicoId }} ">
                            {{ $servico->nomeservico }}
                        </td>
                        <td>
                            {{ $servico->descriptionServico }}
                        </td>
                        <td>
                            <input type="hidden" name="funcionario_id[<?php echo $i;?>] class="form-control" readonly value="{{ $servico->idfuncionario }} ">
                            {{ $servico->nomefuncionario }}
                        </td>
                        <td>
                            <input type="text" name="tempoPrevisto[<?php echo $i;?>]" size="2" class="form-control" placeholder="Tempo Previsto" value="{{ $servico->tempoPrevisto ?? old('tempoPrevisto')}} ">
                        </td>
                        <td>
                            <input type="text" name="tempoRealizado[<?php echo $i;?>]" size="2" class="form-control" placeholder="Tempo Realizado" value="{{ $servico->tempoRealizado ?? old('tempoRealizado')}} ">
                        </td>
                        <td>
                            <input type="text" name="valorCobrado[<?php echo $i;?>]" size="2" class="form-control" placeholder="Valor Cobrado" value="{{ $servico->valorCobrado ?? old('valorCobrado')}} ">
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('acompanhamentos.servico.index', $servico->servicoId)}}" class="btn btn-primary" target="_blank">Acompanhamento</a>
                        </td>
                    </tr>
                    <?php
                        $i += 1;
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>
</div>

<label>Observação:</label><p>
    <textarea id="observacao" name="observacao" rows="4" cols="100" value="{{ $ordemservico->observacao ?? old('observacao')}} ">

    </textarea>
</div>

@if (!$ordemservico->dataencerrada ?? '')
<div class="container">
    <div class="row">
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                    <label>Checklist Entrada</label><p>
                    </tr>
                 </thead>
                <tbody>
                    @foreach ($checklistEntradas as $checklistEntrada)
                    <tr>
                        <td>
                            <input type="checkbox" name="checklistentrada_id[<?php echo $i;?>]" value="{{ $checklistEntrada->id }}">
                            <input type="text" name="checklistentrada_name" class="form-control" placeholder="Cheklist" readonly value="{{ $checklistEntrada->name ?? old('name')}} ">
                        </td>
                        <td>
                            <textarea id="observacao[<?php echo $i;?>]" name="observacao[<?php echo $i;?>]" rows="1" cols="20" value="{{ $checklistEntrada->name ?? old('name')}} ">
                            </textarea>
                        </td>
                        <td>
                        <fieldset>
                            <div>
                                <input type="radio" id="sim" name="sim" value="1" />
                                <label for="sim">Sim</label>
                                <input type="radio" id="nao" name="nao" value="0" />
                                <label for="sim">Não</label>
                            </div>
                        </fieldset>
                        </td>
                    </tr>
                    <?php
                        $i += 1;
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>
</div>
@else
<div class="container">
    <div class="row">
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <tr>
                    <label>Checklist Saída</label><p>
                    </tr>
                 </thead>
                <tbody>
                    @foreach ($checklistEntradas as $checklistEntrada)
                    <tr>
                        <td>
                            <input type="checkbox" name="checklistentrada_id[<?php echo $i;?>]" value="{{ $checklistEntrada->id }}">
                            <input type="text" name="checklistentrada_name" class="form-control" placeholder="Cheklist" readonly value="{{ $checklistEntrada->name ?? old('name')}} ">
                        </td>
                        <td>
                            <textarea id="observacao[<?php echo $i;?>]" name="observacao[<?php echo $i;?>]" rows="1" cols="20" value="{{ $checklistEntrada->name ?? old('name')}} ">
                            </textarea>
                        </td>
                        <td>
                        <fieldset>
                            <div>
                                <input type="radio" id="sim" name="sim" value="1" />
                                <label for="sim">Sim</label>
                                <input type="radio" id="nao" name="nao" value="0" />
                                <label for="sim">Não</label>
                            </div>
                        </fieldset>
                        </td>
                    </tr>
                    <?php
                        $i += 1;
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>
</div>
@endif

<div class="form-group">
    <button type="submit" class="btn btn-primary">Enviar</button>
</div>
