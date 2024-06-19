<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTipoLogradouroRequest;
use Illuminate\Http\Request;
use App\Models\Tipologradouro;

class TipoLogradouroController extends Controller
{
    protected $repository;

    public function  __construct(Tipologradouro $tipologradouro)
    {
        $this->repository = $tipologradouro;
    }

    public function index()
    {
        $tipologradouros = $this->repository->paginate();

        return view('admin.pages.tipologradouros.index', [
            'tipologradouros' => $tipologradouros,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tipologradouros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTipoLogradouroRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('tipologradouros.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipologradouro = $this->repository->where('id', $id)->first();

        if (!$tipologradouro)
            return redirect()->back();

        return view('admin.pages.tipologradouros.show', [
            'tipologradouro' => $tipologradouro
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
        $tipologradouro = $this->repository->where('id', $id)->first();

        if (!$tipologradouro)
            return redirect()->back();

        return view('admin.pages.tipologradouros.edit', [
            'tipologradouro' => $tipologradouro,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTipoLogradouroRequest $request, $id)
    {
        $tipologradouro = $this->repository->where('id', $id)->first();

        if (!$tipologradouro)
            return redirect()->back();

        $tipologradouro->update($request->all());

        return redirect()->route('tipologradouros.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipologradouro = $this->repository
                ->where('id', $id)
                ->first();

        if (!$tipologradouro)
            return redirect()->back();

        $tipologradouro->delete();

        return redirect()->route('tipologradouros.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $tipologradouros = $this->repository->search($request->filter);

        return view('admin.pages.tipologradouros.index', [
            'tipologradouros' => $tipologradouros,
            'filters' => $filters,
        ]);
    }
}
