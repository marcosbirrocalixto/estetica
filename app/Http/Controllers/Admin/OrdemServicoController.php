<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ordemservico;
use App\Models\Veiculo;
use App\Models\Funcionario;
use App\Models\Servico;
use App\Http\Requests\StoreUpdateOrdemServicoRequest;

class OrdemServicoController extends Controller
{
    protected $repository, $veiculo, $funcionario, $servicoordemservico;

    public function  __construct(Ordemservico $ordemservico, Veiculo $veiculo, Funcionario $funcionario, Servico $servico)
    {
        $this->repository = $ordemservico;
        $this->veiculo = $veiculo;
        $this->funcionario = $funcionario;
        $this->servico = $servico;
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

    public function servicos($idOrdemServico)
    {
        //dd($idOrdemServico);
        $ordemservico = $this->repository->find($idOrdemServico);
        //dd($ordemservico);

        if (!$ordemservico) {
            return redirect()->back();
        }

        $funcionarios = $this->funcionario->get();

        $servicos = $this->servico->paginate();
        //dd($servicos);

        return view('admin.pages.ordemservicos.servicos.index', [
            'ordemservico' => $ordemservico,
            'servicos' => $servicos,
            'funcionarios' => $funcionarios,
        ]);
    }
}
