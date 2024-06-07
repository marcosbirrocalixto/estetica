<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateServicoRequest;
use Illuminate\Http\Request;
use App\Models\Servico;

class ServicoController extends Controller
{
    protected $repository;

    public function  __construct(Servico $servico)
    {
        $this->repository = $servico;
    }

    public function index()
    {
        $servicos = $this->repository->paginate();

        return view('admin.pages.servicos.index', [
            'servicos' => $servicos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.servicos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateServicoRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('servicos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servico = $this->repository->where('id', $id)->first();

        if (!$servico)
            return redirect()->back();

        return view('admin.pages.servicos.show', [
            'servico' => $servico
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
        $servico = $this->repository->where('id', $id)->first();

        if (!$servico)
            return redirect()->back();

        return view('admin.pages.servicos.edit', [
            'servico' => $servico,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateServicoRequest $request, $id)
    {
        $servico = $this->repository->where('id', $id)->first();

        if (!$servico)
            return redirect()->back();

        $servico->update($request->all());

        return redirect()->route('servicos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servico = $this->repository
                ->where('id', $id)
                ->first();

        if (!$servico)
            return redirect()->back();

        $servico->delete();

        return redirect()->route('servicos.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $servicos = $this->repository->search($request->filter);

        return view('admin.pages.servicos.index', [
            'servicos' => $servicos,
            'filters' => $filters,
        ]);
    }
}
