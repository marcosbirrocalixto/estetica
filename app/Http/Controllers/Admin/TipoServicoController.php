<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTipoServicoRequest;
use Illuminate\Http\Request;
use App\Models\Tiposervico;

class TipoServicoController extends Controller
{
    protected $repository;

    public function  __construct(Tiposervico $tiposervico)
    {
        $this->repository = $tiposervico;
    }

    public function index()
    {
        $tiposervicos = $this->repository->paginate();

        return view('admin.pages.tiposervicos.index', [
            'tiposervicos' => $tiposervicos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tiposervicos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTipoServicoRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('tiposervicos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tiposervico = $this->repository->where('id', $id)->first();

        if (!$tiposervico)
            return redirect()->back();

        return view('admin.pages.tiposervicos.show', [
            'tiposervico' => $tiposervico
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
        $tiposervico = $this->repository->where('id', $id)->first();

        if (!$tiposervico)
            return redirect()->back();

        return view('admin.pages.tiposervicos.edit', [
            'tiposervico' => $tiposervico,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTipoServicoRequest $request, $id)
    {
        $tiposervico = $this->repository->where('id', $id)->first();

        if (!$tiposervico)
            return redirect()->back();

        $tiposervico->update($request->all());

        return redirect()->route('tiposervicos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiposervico = $this->repository
                ->where('id', $id)
                ->first();

        if (!$tiposervico)
            return redirect()->back();

        $tiposervico->delete();

        return redirect()->route('tiposervicos.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $tiposervicos = $this->repository->search($request->filter);

        return view('admin.pages.tiposervicos.index', [
            'tiposervicos' => $tiposervicos,
            'filters' => $filters,
        ]);
    }
}
