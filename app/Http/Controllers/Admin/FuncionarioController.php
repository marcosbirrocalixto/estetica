<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFuncionarioRequest;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Storage;

class FuncionarioController extends Controller
{
    protected $repository;

    public function  __construct(Funcionario $funcionario)
    {
        $this->repository = $funcionario;
    }

    public function index()
    {
        $funcionarios = $this->repository->paginate();

        return view('admin.pages.funcionarios.index', [
            'funcionarios' => $funcionarios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateFuncionarioRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->foto->isValid()) {
            $data['foto'] = $request->foto->store('funcionarios');
        }

        $this->repository->create($data);

        return redirect()->route('funcionarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $funcionario = $this->repository->where('id', $id)->first();

        if (!$funcionario)
            return redirect()->back();

        return view('admin.pages.funcionarios.show', [
            'funcionario' => $funcionario
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
        $funcionario = $this->repository->where('id', $id)->first();

        if (!$funcionario)
            return redirect()->back();

        return view('admin.pages.funcionarios.edit', [
            'funcionario' => $funcionario,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateFuncionarioRequest $request, $id)
    {
        $funcionario = $this->repository->where('id', $id)->first();

        if (!$funcionario)
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->foto->isValid()) {
            $data['foto'] = $request->foto->store('funcionarios');
        }

        $funcionario->update($data);

        return redirect()->route('funcionarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcionario = $this->repository
                ->where('id', $id)
                ->first();

        if (!$funcionario)
            return redirect()->back();

        /*
        if ($funcionario->count() > 0) {
            return redirect()
                    ->back()
                    ->with('error', 'Existem sub-funcionarios vinculados ao funcionario! Não é possível deletar!');
        }
                    */

        $funcionario->delete();

        return redirect()->route('funcionarios.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $funcionarios = $this->repository->search($request->filter);

        return view('admin.pages.funcionarios.index', [
            'funcionarios' => $funcionarios,
            'filters' => $filters,
        ]);
    }
}
