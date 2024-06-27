<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use App\Models\Ordemservico;
use App\Models\Funcionario;
use Illuminate\Http\Request;

class ServicosOrdemServicoController extends Controller
{
    protected $ordemservico, $servico, $funcionarios;

    public function __construct(Ordemservico $ordemservico, Servico $servico, Funcionario $funcionarios)
    {
        $this->ordemservico         = $ordemservico;
        $this->servico              = $servico;
        $this->funcionario          = $funcionarios;
    }

    public function servicos($id)
    {
        //dd($idOrdemServico);
        $ordemservico = $this->ordemservico->find($id);
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

    public function ordemservicos($idServico)
    {
        if (!$servico = $this->servico->find($idServico)) {
            return redirect()->back();
        }

        $ordemservicos = $servico->ordemservicos()->paginate();

        return view('admin.pages.servicos.ordemservicos.index', [
            'ordemservicos' => $ordemservicos,
            'servico' => $servico,
        ]);
    }

    public function servicosAvailable(Request $request, $id)
    {
        if (!$ordemservico = $this->ordemservico->find($id)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $servicos = $ordemservico->servicosAvailable($request->filter);

        $funcionarios = $this->funcionario->get();

        return view('admin.pages.ordemservicos.servicos.available', [
            'ordemservico' => $ordemservico,
            'servicos' => $servicos,
            'funcionarios' => $funcionarios,
            'filters' => $filters,
        ]);
    }

    public function attachServicosOrdemServico(Request $request, $id)
    {
        //dd($id);
        if (!$ordemservico = $this->ordemservico->find($id)) {
            return redirect()->back();
        }

        $servicos = $ordemservico->servicosAvailable();

        //dd($servicos);

        if (!$request->servicos || count($request->servicos) === 0) {
            return redirect()
                    ->back()
                    ->with('info', 'É necessário selecionar pelo menos um serviço!');
        }
        //dd($request->servicos);

        $ordemservico->servicos()->attach($request->servicos);
        //$profile->permissions()->attach($request->permissions);

        return redirect()->route('ordemservicos.servicos', $ordemservico->id);
    }

    public function detachServicoOrdemServico(Request $request, $idOrdemServico, $idServico)
    {
        $ordemservico = $this->ordemservico->find($idOrdemServico);
        $servico = $this->servico->find($idServico);

        if (!$ordemservico || !$servico)
            return redirect()
                    ->back()
                    ->with('info', 'Não existe o Perfil ou a Permissão!');

        $ordemservico->servicos()->detach($servico);

        return redirect()->route('ordemservicos.servicos', $ordemservico->id);
    }
}
