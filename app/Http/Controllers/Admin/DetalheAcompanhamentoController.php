<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcompanhamentoServico;
use App\Models\DetalheAcompanhamento;
use App\Http\Requests\StoreUpdateDetalheAcompanhamentoRequest;

class DetalheAcompanhamentoController extends Controller
{
    protected $repository, $acompanhamentoServico;

    public function __construct(DetalheAcompanhamento $detalhe, AcompanhamentoServico $acompanhamento)
    {
        $this->repository = $detalhe;
        $this->acompanhamento = $acompanhamento;
    }

    public function index($idAcompanhamento)
    {
        //dd($idAcompanhamento);
        if (!$acompanhamento = $this->acompanhamento->where('id', $idAcompanhamento)->first()) {
            return redirect()->back();
        };

        //dd($acompanhamento);

        $detalhes = $acompanhamento->detalhes()->paginate();

        return view('admin.pages.servicos.acompanhamentos.detalhes.index', [
            'acompanhamento'      => $acompanhamento,
            'detalhes'   => $detalhes,
        ]);
    }

    public function create($idAcompanhamento)
    {
        if (!$acompanhamento = $this->acompanhamento->where('id', $idAcompanhamento)->first()) {
            return redirect()->back();
        };

        return view('admin.pages.servicos.acompanhamentos.detalhes.create', [
            'acompanhamento'      => $acompanhamento,
        ]);
    }

    public function store(StoreUpdateDetalheAcompanhamentoRequest $request, $idAcompanhamento)
    {
        if (!$acompanhamento = $this->acompanhamento->where('id', $idAcompanhamento)->first()) {
            return redirect()->back();
        };

        $acompanhamento->detalhes()->create($request->all());

        return redirect()->route('detalhes.acompanhamento.index', [
            'id'      => $acompanhamento->id,
        ]);
    }

    public function edit($idAcompanhamento, $idDetalhe)
    {
        $acompanhamento   = $this->acompanhamento->where('id', $idAcompanhamento)->first();
        $detalhe = $this->repository->find($idDetalhe);

        if (!$acompanhamento || !$detalhe) {
            return redirect()->back();
        };

        return view('admin.pages.servicos.acompanhamentos.detalhes.edit', [
            'acompanhamento'      => $acompanhamento,
            'detalhe'    => $detalhe,
        ]);
    }

    public function update(StoreUpdateDetalheAcompanhamentoRequest $request, $idAcompanhamento, $idDetalhe)
    {
        $acompanhamento   = $this->acompanhamento->where('id', $idAcompanhamento)->first();
        $detalhe = $this->repository->find($idDetalhe);

        if (!$acompanhamento || !$detalhe) {
            return redirect()->back();
        };

        $detalhe->update($request->all());

        return redirect()->route('detalhes.acompanhamento.index', [
            'id'      => $acompanhamento->id,
        ]);
    }

    public function show($idAcompanhamento, $idDetalhe)
    {
        $acompanhamento   = $this->acompanhamento->where('id', $idAcompanhamento)->first();
        $detalhe = $this->repository->find($idDetalhe);

        if (!$acompanhamento || !$detalhe) {
            return redirect()->back();
        };

        return view('admin.pages.servicos.acompanhamentos.detalhes.show', [
            'acompanhamento'      => $acompanhamento,
            'detalhe'    => $detalhe,
        ]);
    }

    public function delete($idAcompanhamento, $idDetalhe)
    {
        $acompanhamento   = $this->acompanhamento->where('id', $idAcompanhamento)->first();
        $detalhe = $this->repository->find($idDetalhe);

        if (!$acompanhamento || !$detalhe) {
            return redirect()->back();
        };

        $detalhe->delete();

        return redirect()->route('detalhes.acompanhamento.index', [
            'id'      => $acompanhamento->id,
        ])
        ->with('message', 'Registro deletado com sucesso!');
    }
}
