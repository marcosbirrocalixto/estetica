<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateGrupoRequest;
use Illuminate\Http\Request;
use App\Models\Grupo;
use Illuminate\Support\Facades\Storage;

class GrupoController extends Controller
{
    protected $repository;

    public function  __construct(Grupo $grupo)
    {
        $this->repository = $grupo;
    }

    public function index()
    {
        $grupos = $this->repository->paginate();

        return view('admin.pages.grupos.index', [
            'grupos' => $grupos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.grupos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateGrupoRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->foto->isValid()) {
            $data['foto'] = $request->foto->store('grupos');
        }

        $this->repository->create($data);

        return redirect()->route('grupos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = $this->repository->where('id', $id)->first();

        if (!$grupo)
            return redirect()->back();

        return view('admin.pages.grupos.show', [
            'grupo' => $grupo
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
        $grupo = $this->repository->where('id', $id)->first();

        if (!$grupo)
            return redirect()->back();

        return view('admin.pages.grupos.edit', [
            'grupo' => $grupo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateGrupoRequest $request, $id)
    {
        $grupo = $this->repository->where('id', $id)->first();

        if (!$grupo)
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->foto->isValid()) {
            $data['foto'] = $request->foto->store('grupos');
        }

        $grupo->update($data);

        return redirect()->route('grupos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = $this->repository->with('subgrupo')
                ->where('id', $id)
                ->first();

        if (!$grupo)
            return redirect()->back();

        if ($grupo->subgrupo->count() > 0) {
            return redirect()
                    ->back()
                    ->with('error', 'Existem sub-grupos vinculados ao grupo! Não é possível deletar!');
        }

        $grupo->delete();

        return redirect()->route('grupos.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $grupos = $this->repository->search($request->filter);

        return view('admin.pages.grupos.index', [
            'grupos' => $grupos,
            'filters' => $filters,
        ]);
    }
}
