<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrdemServico;
use App\Models\VeiculoCliente;

class OrdemServicoController extends Controller
{
    protected $repository, $veiculo;

    public function  __construct(OrdemServico $ordemservico, VeiculoCliente $veiculo)
    {
        $this->repository = $ordemservico;
        $this->veiculo = $veiculo;
    }

    public function index($idVeiculo)
    {
        //dd($idVeiculo);

        $veiculo = $this->veiculo::with('cliente')->where('id', $idVeiculo)->first();

       // dd($veiculo);

        $ordemservicos = $this->repository::with('veiculo')
        ->where('veiculo_id', $idVeiculo)
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

        if (!$veiculo = $this->veiculo::with('cliente')->where('id', $idVeiculo)->first()) {
            return redirect()->back();
        };

        //dd($veiculo);

        return view('admin.pages.clientes.veiculos.ordemservicos.create', [
            'veiculo'   => $veiculo,
            'user'      => $user,
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

        if ($request->hasFile('image') && $request->foto->isValid()) {
            $data['foto'] = $request->foto->store('ordemservicos');
        }

        $this->repository->create($data);

        return redirect()->route('ordemservicos.index');
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
}
