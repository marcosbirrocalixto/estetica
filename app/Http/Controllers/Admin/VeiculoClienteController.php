<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\VeiculoCliente;
use App\Http\Requests\StoreUpdateVeiculoClienteRequest;

class VeiculoClienteController extends Controller
{
    protected $repository, $cliente;

    public function __construct(VeiculoCliente $veiculoCliente, Cliente $cliente)
    {
        $this->repository = $veiculoCliente;
        $this->cliente = $cliente;
    }

    public function index($idCliente)
    {
        //dd($idCliente);
        if (!$cliente = $this->cliente->where('id', $idCliente)->first()) {
            return redirect()->back();
        };

        //$veiculos = $cliente->veiculos();
        $veiculos = $cliente->veiculos()->paginate();

        return view('admin.pages.clientes.veiculos.index', [
            'cliente'      => $cliente,
            'veiculos'   => $veiculos,
        ]);
    }

    public function create($idCliente)
    {
        if (!$cliente = $this->cliente->where('id', $idCliente)->first()) {
            return redirect()->back();
        };

        return view('admin.pages.clientes.veiculos.create', [
            'cliente'      => $cliente,
        ]);
    }

    public function store(StoreUpdateVeiculoClienteRequest $request, $idCliente)
    {
        if (!$cliente = $this->cliente->where('id', $idCliente)->first()) {
            return redirect()->back();
        };

        //dd($request->all());
        //$data['cliente_id'] = $cliente->id;
        //$this->repository->create($data);

        $cliente->veiculos()->create($request->all());

        return redirect()->route('veiculos.cliente.index', [
            'id'      => $cliente->id,
        ]);
    }

    public function edit($idcliente, $idVeiculo)
    {
        $cliente   = $this->cliente->where('id', $idcliente)->first();
        $veiculo = $this->repository->find($idVeiculo);

        if (!$cliente || !$veiculo) {
            return redirect()->back();
        };

        return view('admin.pages.clientes.veiculos.edit', [
            'cliente'      => $cliente,
            'veiculo'    => $veiculo,
        ]);
    }

    public function update(StoreUpdateVeiculoClienteRequest $request, $idCliente, $idVeiculo)
    {
        $cliente   = $this->cliente->where('id', $idCliente)->first();
        $veiculo = $this->repository->find($idVeiculo);

        if (!$cliente || !$veiculo) {
            return redirect()->back();
        };

        $veiculo->update($request->all());

        return redirect()->route('veiculos.cliente.index', [
            'id'      => $cliente->id,
        ]);
    }

    public function show($idCliente, $idVeiculo)
    {
        $cliente   = $this->cliente->where('id', $idCliente)->first();
        $veiculo = $this->repository->find($idVeiculo);

        if (!$cliente || !$veiculo) {
            return redirect()->back();
        };

        return view('admin.pages.clientes.veiculos.show', [
            'cliente'      => $cliente,
            'veiculo'    => $veiculo,
        ]);
    }

    public function delete($idCliente, $idVeiculo)
    {
        $cliente   = $this->cliente->where('id', $idCliente)->first();
        $veiculo = $this->repository->find($idVeiculo);

        if (!$cliente || !$veiculo) {
            return redirect()->back();
        };

        $veiculo->delete();

        return redirect()->route('veiculos.cliente.index', [
            'id'      => $cliente->id,
        ])
        ->with('message', 'Registro deletado com sucesso!');
    }
}
