<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\AcompanhamentoServico;
use App\Http\Requests\StoreUpdateAcompanhamentoServicoRequest;

class AcompanhamentoServicoController extends Controller
{
    protected $repository, $servico;

    public function __construct(AcompanhamentoServico $acompanhamentoServico, Servico $servico)
    {
        $this->repository = $acompanhamentoServico;
        $this->servico = $servico;
    }

    public function index($idServico)
    {
        //dd($idServico);
        if (!$servico = $this->servico->where('id', $idServico)->first()) {
            return redirect()->back();
        };

        //$acompanhamentos = $servico->acompanhamentos();
        $acompanhamentos = $servico->acompanhamentos()->paginate();

        return view('admin.pages.servicos.acompanhamentos.index', [
            'servico'      => $servico,
            'acompanhamentos'   => $acompanhamentos,
        ]);
    }

    public function create($idServico)
    {
        if (!$servico = $this->servico->where('id', $idServico)->first()) {
            return redirect()->back();
        };

        return view('admin.pages.servicos.acompanhamentos.create', [
            'servico'      => $servico,
        ]);
    }

    public function store(StoreUpdateAcompanhamentoServicoRequest $request, $idServico)
    {
        if (!$servico = $this->servico->where('id', $idServico)->first()) {
            return redirect()->back();
        };

        //dd($request->all());
        //$data['servico_id'] = $servico->id;
        //$this->repository->create($data);

        $servico->acompanhamentos()->create($request->all());

        return redirect()->route('acompanhamentos.servico.index', [
            'id'      => $servico->id,
        ]);
    }

    public function edit($idServico, $idAcompanhamento)
    {
        $servico   = $this->servico->where('id', $idServico)->first();
        $acompanhamento = $this->repository->find($idAcompanhamento);

        if (!$servico || !$acompanhamento) {
            return redirect()->back();
        };

        return view('admin.pages.servicos.acompanhamentos.edit', [
            'servico'      => $servico,
            'acompanhamento'    => $acompanhamento,
        ]);
    }

    public function update(StoreUpdateAcompanhamentoServicoRequest $request, $idServico, $idAcompanhamento)
    {
        $servico   = $this->servico->where('id', $idServico)->first();
        $acompanhamento = $this->repository->find($idAcompanhamento);

        if (!$servico || !$acompanhamento) {
            return redirect()->back();
        };

        $acompanhamento->update($request->all());

        return redirect()->route('acompanhamentos.servico.index', [
            'id'      => $servico->id,
        ]);
    }

    public function show($idServico, $idAcompanhamento)
    {
        $servico   = $this->servico->where('id', $idServico)->first();
        $acompanhamento = $this->repository->find($idAcompanhamento);

        if (!$servico || !$acompanhamento) {
            return redirect()->back();
        };

        return view('admin.pages.servicos.acompanhamentos.show', [
            'servico'      => $servico,
            'acompanhamento'    => $acompanhamento,
        ]);
    }

    public function delete($idServico, $idAcompanhamento)
    {
        $servico   = $this->servico->where('id', $idServico)->first();
        $acompanhamento = $this->repository->find($idAcompanhamento);

        if (!$servico || !$acompanhamento) {
            return redirect()->back();
        };

        $acompanhamento->delete();

        return redirect()->route('acompanhamentos.servico.index', [
            'id'      => $servico->id,
        ])
        ->with('message', 'Registro deletado com sucesso!');
    }
}
