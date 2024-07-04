<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ordemservico;
use App\Models\ServicoOrdemServico;
use App\Models\Veiculo;
use App\Models\Funcionario;
use App\Models\Servico;
use App\Models\ChecklistEntrada;
use App\Http\Requests\StoreUpdateOrdemServicoRequest;
use Illuminate\Support\Facades\DB;

class OrdemServicoController extends Controller
{
    protected $repository, $veiculo, $funcionario, $servicoordemservico, $checklistEntrada;

    public function  __construct(Ordemservico $ordemservico, Veiculo $veiculo, Funcionario $funcionario, Servico $servico, ServicoOrdemServico $servicoordemservico, ChecklistEntrada $checklistEntrada)
    {
        $this->repository = $ordemservico;
        $this->veiculo = $veiculo;
        $this->funcionario = $funcionario;
        $this->servico = $servico;
        $this->servicoordemservico = $servicoordemservico;
        $this->checklistEntrada = $checklistEntrada;
    }

    public function index($idVeiculo)
    {
        //dd($idVeiculo);

        $veiculo = $this->veiculo::with('cliente')->where('id', $idVeiculo)->first();

        //dd($veiculo);

        $ordemservicos = $this->repository
        ->where('veiculo_id', $idVeiculo)
        ->orderby('id', 'desc')
        ->paginate();

        //dd($ordemservicos);

        return view('admin.pages.clientes.veiculos.ordemservicos.index', [
            'ordemservicos' => $ordemservicos,
            'veiculo'   => $veiculo,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idVeiculo)
    {
        $user = auth()->user();
        //dd($user);

        $funcionarios = $this->funcionario->get();

        if (!$veiculo = $this->veiculo::with('cliente')->where('id', $idVeiculo)->first()) {
            return redirect()->back();
        };

        //dd($veiculo);

        return view('admin.pages.clientes.veiculos.ordemservicos.create', [
            'veiculo'       => $veiculo,
            'user'          => $user,
            'funcionarios'  => $funcionarios,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateOrdemServicoRequest $request)
    {
        $data = $request->all();
        //dd($data);

        $ordem = $this->repository->create($data);
        //$id = $ordem->id;
        //dd($ordem);

        return redirect()->route('ordemservicos.veiculo.index', $ordem->veiculo_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ordemservico = $this->repository->where('id', $id)->first();

        if (!$ordemservico)
            return redirect()->back();

        return view('admin.pages.ordemservicos.show', [
            'ordemservico' => $ordemservico
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordemservico = $this->repository->where('id', $id)->first();

        if (!$ordemservico)
            return redirect()->back();

        return view('admin.pages.ordemservicos.edit', [
            'ordemservico' => $ordemservico,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateOrdemServicoRequest $request, $id)
    {
        $ordemservico = $this->repository->where('id', $id)->first();

        if (!$ordemservico)
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->foto->isValid()) {
            $data['foto'] = $request->foto->store('ordemservicos');
        }

        $ordemservico->update($data);

        return redirect()->route('ordemservicos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ordemservico = $this->repository
                ->where('id', $id)
                ->first();

        if (!$ordemservico)
            return redirect()->back();

        /*
        if ($ordemservico->count() > 0) {
            return redirect()
                    ->back()
                    ->with('error', 'Existem sub-ordemservicos vinculados ao ordemservico! Não é possível deletar!');
        }
                    */

        $ordemservico->delete();

        return redirect()->route('ordemservicos.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $ordemservicos = $this->repository->search($request->filter);

        return view('admin.pages.ordemservicos.index', [
            'ordemservicos' => $ordemservicos,
            'filters' => $filters,
        ]);
    }

    public function executar($idOrdemServico)
    {
        $user = auth()->user();
        //dd($user);

        $i = 1;

        $checklistEntradas = $this->checklistEntrada->get();

        $ordemservico = $this->repository
            ->where('id', $idOrdemServico)
            ->first();
        //dd($ordemservico);

        $servicos = DB::table('ordemservico_servico')
        ->Join('servicos', 'servicos.id', '=', 'ordemservico_servico.servico_id')
        ->Join('ordemservicos', 'ordemservicos.id', '=', 'ordemservico_servico.ordemservico_id')
        ->Join('funcionarios', 'funcionarios.id', '=', 'ordemservico_servico.funcionario_id')
        ->select('servicos.id as servicoId', 'servicos.name as nomeservico', 'servicos.description as descriptionServico', 'servicos.price', 'ordemservico_servico.tempoRealizado', 'ordemservicos.kmentrega', 'servicos.tempoPrevisto', 'ordemservicos.id as idOrdemServico', 'ordemservicos.veiculo_id as idVeiculo', 'ordemservicos.cliente_id as idCliente', 'ordemservicos.observacao', 'funcionarios.id as idfuncionario', 'funcionarios.name as nomefuncionario')
        ->where('ordemservico_servico.ordemservico_id', '=', "$idOrdemServico")
        ->get();
        //dd($servicos);

        if (empty($servicos)) {
            return redirect()->back()
                ->with('message', 'Não existem serviços selecionados para a Ordem de Servico!');;
        }

        if (!$veiculo = $this->veiculo::with('cliente')->where('id', $ordemservico->veiculo_id)->first()) {
            return redirect()->back();
        };
        //dd($veiculo);

        return view('admin.pages.clientes.veiculos.ordemservicos.executar', [
            'user'              => $user,
            'ordemservico'      => $ordemservico,
            'servicos'          => $servicos,
            'veiculo'           => $veiculo,
            'i'                 => $i,
            'checklistEntradas' => $checklistEntradas,
        ]);
    }

    public function gravarOrdemServico(Request $request, $idOrdemServico)
    {
        $user = auth()->user();

        $ordemservico = $this->repository
        ->where('id', $idOrdemServico)
        ->first();
        //dd($ordemservico);

        //dd($request->all());

        //dd($Id);
        $data['kmentrega'] = $request->kmentrega;
        $data['combustivelEntrega'] = $request->combustivelEntrega;
        $data['dataencerrada'] = $request->dataencerrada;
        //dd($data);

        $ordem = $this->repository->where('id', $idOrdemServico)->update($data);
        //$id = $ordem->id;
        //dd($ordem);

        $servicos = $this->servicoordemservico->where('ordemservico_id', $idOrdemServico)->get();
        //dd($servicos);
        $count = count($servicos);

        //dd($request->all());

        //dd($count);
        //if ($request->funcionarios[0] == null) {
        //    $i = 1;
        //} else {
        //    $i = 0;
        //}
        $i = 1;
        if ($count > 0) {
        foreach ($servicos as $servico) {
            //$funcionario = $request->funcionarios[$i];
            $tempoPrevisto = $request->tempoPrevisto[$i];
            $tempoRealizado = $request->tempoRealizado[$i];
            $valorCobrado = $request->valorCobrado[$i];
            $ordem = $this->servicoordemservico->where('id', $servico->id)->first();
            DB::table('ordemservico_servico')
            //->where('ordemservico_id', $data->ordemservico_id)
            ->where('id', $servico->id)
            ->update(
                ['tempoPrevisto' => $tempoPrevisto, 'tempoRealizado' => $tempoRealizado, 'valorCobrado' => $valorCobrado],
            );
            $i = $i + 1;
        }
        }

        return redirect()->route('ordemservicos.veiculo.index', $ordemservico->veiculo_id);
    }

}
