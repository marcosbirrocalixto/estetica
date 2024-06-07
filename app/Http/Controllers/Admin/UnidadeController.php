<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUnidadeRequest;
use Illuminate\Http\Request;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    protected $repository;

    public function  __construct(Unidade $unidade)
    {
        $this->repository = $unidade;
    }

    public function index()
    {
        $unidades = $this->repository->paginate();

        return view('admin.pages.unidades.index', [
            'unidades' => $unidades,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUnidadeRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('unidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidade = $this->repository->where('id', $id)->first();

        if (!$unidade)
            return redirect()->back();

        return view('admin.pages.unidades.show', [
            'unidade' => $unidade
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
        $unidade = $this->repository->where('id', $id)->first();

        if (!$unidade)
            return redirect()->back();

        return view('admin.pages.unidades.edit', [
            'unidade' => $unidade,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUnidadeRequest $request, $id)
    {
        $unidade = $this->repository->where('id', $id)->first();

        if (!$unidade)
            return redirect()->back();

        $unidade->update($request->all());

        return redirect()->route('unidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidade = $this->repository
                ->where('id', $id)
                ->first();

        if (!$unidade)
            return redirect()->back();

        $unidade->delete();

        return redirect()->route('unidades.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $unidades = $this->repository->search($request->filter);

        return view('admin.pages.unidades.index', [
            'unidades' => $unidades,
            'filters' => $filters,
        ]);
    }
}
