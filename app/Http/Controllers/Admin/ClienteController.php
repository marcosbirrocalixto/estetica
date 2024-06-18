<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateClienteRequest;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Tipopessoa;

class ClienteController extends Controller
{
    protected $repository, $tipopessoa;

    public function  __construct(Cliente $cliente, Tipopessoa $tipopessoa)
    {
        $this->repository = $cliente;
        $this->tipopessoa = $tipopessoa;
    }

    public function index()
    {
        $clientes = $this->repository->paginate();

        $tipopessoas = $this->tipopessoa->get();

        return view('admin.pages.clientes.index',
        [
            'clientes' => $clientes,
            'tipopessoas' => $tipopessoas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipopessoas = $this->tipopessoa->get();

        return view('admin.pages.clientes.create',         [
            'tipopessoas' => $tipopessoas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClienteRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->foto->isValid()) {
            $data['foto'] = $request->foto->store('clientes');
        }

        $this->repository->create($data);

        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->repository->where('id', $id)->first();

        if (!$cliente)
            return redirect()->back();

        return view('admin.pages.clientes.show', [
            'cliente' => $cliente
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
        $cliente = $this->repository->where('id', $id)->first();

        if (!$cliente)
            return redirect()->back();

        return view('admin.pages.clientes.edit', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateClienteRequest $request, $id)
    {
        $cliente = $this->repository->where('id', $id)->first();

        if (!$cliente)
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->foto->isValid()) {
            $data['foto'] = $request->foto->store('clientes');
        }

        $cliente->update($data);

        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = $this->repository
                ->where('id', $id)
                ->first();

        if (!$cliente)
            return redirect()->back();

        /*
        if ($cliente->count() > 0) {
            return redirect()
                    ->back()
                    ->with('error', 'Existem sub-clientes vinculados ao cliente! Não é possível deletar!');
        }
                    */

        $cliente->delete();

        return redirect()->route('clientes.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $clientes = $this->repository->search($request->filter);

        return view('admin.pages.clientes.index', [
            'clientes' => $clientes,
            'filters' => $filters,
        ]);
    }
}
