<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTipoUsuarioRequest;
use Illuminate\Http\Request;
use App\Models\Tipousuario;

class TipoUsuarioController extends Controller
{
    protected $repository;

    public function  __construct(Tipousuario $tipousuario)
    {
        $this->repository = $tipousuario;
    }

    public function index()
    {
        $tipousuarios = $this->repository->paginate();

        return view('admin.pages.tipousuarios.index', [
            'tipousuarios' => $tipousuarios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tipousuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTipoUsuarioRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('tipousuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipousuario = $this->repository->where('id', $id)->first();

        if (!$tipousuario)
            return redirect()->back();

        return view('admin.pages.tipousuarios.show', [
            'tipousuario' => $tipousuario
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
        $tipousuario = $this->repository->where('id', $id)->first();

        if (!$tipousuario)
            return redirect()->back();

        return view('admin.pages.tipousuarios.edit', [
            'tipousuario' => $tipousuario,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTipoUsuarioRequest $request, $id)
    {
        $tipousuario = $this->repository->where('id', $id)->first();

        if (!$tipousuario)
            return redirect()->back();

        $tipousuario->update($request->all());

        return redirect()->route('tipousuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipousuario = $this->repository
                ->where('id', $id)
                ->first();

        if (!$tipousuario)
            return redirect()->back();

        $tipousuario->delete();

        return redirect()->route('tipousuarios.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $tipousuarios = $this->repository->search($request->filter);

        return view('admin.pages.tipousuarios.index', [
            'tipousuarios' => $tipousuarios,
            'filters' => $filters,
        ]);
    }

}
