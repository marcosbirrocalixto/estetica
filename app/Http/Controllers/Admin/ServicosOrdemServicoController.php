<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use App\Models\Ordemservico;
use App\Models\Funcionario;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\ServicoOrdemServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicosOrdemServicoController extends Controller
{
    protected $ordemservico, $servico, $funcionarios;

    public function __construct(Ordemservico $ordemservico, Servico $servico, Funcionario $funcionarios, Cliente $cliente, Veiculo $veiculo, ServicoOrdemServico $servicoordemservico)
    {
        $this->ordemservico         = $ordemservico;
        $this->servico              = $servico;
        $this->cliente              = $cliente;
        $this->veiculo              = $veiculo;
        $this->funcionario          = $funcionarios;
        $this->servicoordemservico  = $servicoordemservico;
    }

    public function servicos($id)
    {
        //dd($idOrdemServico);
        $ordemservico = $this->ordemservico->find($id);
        //dd($ordemservico);

        $cliente = $this->cliente->find($ordemservico->cliente_id)->first();
        //dd($cliente);

        $veiculo = $this->veiculo->find($ordemservico->veiculo_id)->first();
        //dd($veiculo);

        if (!$ordemservico) {
            return redirect()->back();
        }

        //$funcionarios = $this->funcionario->get();

        //$serv_ord = $this->servicoordemservico->where('ordemservico_id', $ordemservico->id)->get();
        //dd($serv_ord);


        $servicos = DB::table('ordemservico_servico')
        ->Join('servicos', 'servicos.id', '=', 'ordemservico_servico.servico_id')
        ->Join('ordemservicos', 'ordemservicos.id', '=', 'ordemservico_servico.ordemservico_id')
        ->Join('funcionarios', 'funcionarios.id', '=', 'ordemservico_servico.funcionario_id')
        //->join('funcionarios', 'funcionarios.id', '=', 'ordemservico_servico.funcionario_id')
        ->select('servicos.id as servicoId', 'servicos.name as nomeservico', 'servicos.description', 'servicos.price', 'servicos.tempoPrevisto', 'ordemservicos.id', 'ordemservicos.veiculo_id', 'ordemservicos.cliente_id', 'funcionarios.name as nomefuncionario')
        ->where('ordemservico_servico.ordemservico_id', '=', "$id")
        ->paginate();
        //dd($servicos);

        //$servicos = $this->ordemservico->with('servicos')->get();
        //dd($servicos);

        //$ordem = $ordemservico->servicos()->first();

        //dd($ordem->pivot->ordemservico_id);

        //$servico = $this->servicoordemservico->where('ordemservico_id', $ordem->pivot->ordemservico_id)->get();
        //dd($servico);

        return view('admin.pages.ordemservicos.servicos.index', [
            'servicos'      => $servicos,
            'cliente'       => $cliente,
            'veiculo'       => $veiculo,
            'ordemservico'  => $ordemservico,

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

        //dd($servicos);

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
        $user = auth()->user();

        //dd($id);
        if (!$ordemservico = $this->ordemservico->find($id)) {
            return redirect()->back();
        }

        //dd($request->funcionarios);

        //$servicos = $ordemservico->servicosAvailable();

        //dd($servicos);

        if (!$request->servicos || count($request->servicos) === 0) {
            return redirect()
                    ->back()
                    ->with('info', 'É necessário selecionar pelo menos um serviço!');
        }
        //$ordem = $request->servicos;

        //dd($request->funcionarios);
        //dd($request->servicos);

        $ordemservico->servicos()->attach($request->servicos);
        //dd(count($request->servicos));

        $count = count($request->servicos);

        $data1 = $this->servicoordemservico->where('ordemservico_id', $id)->get();

        //dd($count);
        if ($request->funcionarios[0] == null) {
            $i = 1;
        } else {
            $i = 0;
        }

        if ($count > 0) {
        foreach ($data1 as $data) {
            //dd($data->id);
            $funcionario = $request->funcionarios[$i];
            $ordem = $this->servicoordemservico->where('id', $data->id)->first();
            DB::table('ordemservico_servico')
            //->where('ordemservico_id', $data->ordemservico_id)
            ->where('id', $data->id)
            ->update(
                ['user_id' => $user->id, 'funcionario_id' => $funcionario],
            );
            $i = $i + 1;
        }
        }
        //$count = count($data);

        return redirect()->route('ordemservicos.servicos', $ordemservico->id);
    }

    public function detachServicoOrdemServico(Request $request, $idOrdemServico, $idServico)
    {
        $ordemservico = $this->ordemservico->find($idOrdemServico);
        //dd($ordemservico);
        $servico = $this->servico->find($idServico);
        //dd($servico);

        if (!$ordemservico || !$servico)
            return redirect()
                    ->back()
                    ->with('info', 'Não existe o Perfil ou a Permissão!');

        $ordemservico->servicos()->detach($servico);

        return redirect()->route('ordemservicos.servicos', $ordemservico->id);
    }
}
