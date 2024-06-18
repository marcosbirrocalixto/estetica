<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTipoPessoaRequest;
use Illuminate\Http\Request;
use App\Models\Tipopessoa;

class TipoPessoaController extends Controller
{
    protected $repository;

    public function  __construct(Tipopessoa $tipopessoa)
    {
        $this->repository = $tipopessoa;
    }

    public function index()
    {
        $tipopessoas = $this->repository->paginate();

        return view('admin.pages.tipopessoas.index', [
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
        return view('admin.pages.tipopessoas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTipoPessoaRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('tipopessoas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipopessoa = $this->repository->where('id', $id)->first();

        if (!$tipopessoa)
            return redirect()->back();

        return view('admin.pages.tipopessoas.show', [
            'tipopessoa' => $tipopessoa
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
        $tipopessoa = $this->repository->where('id', $id)->first();

        if (!$tipopessoa)
            return redirect()->back();

        return view('admin.pages.tipopessoas.edit', [
            'tipopessoa' => $tipopessoa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTipoPessoaRequest $request, $id)
    {
        $tipopessoa = $this->repository->where('id', $id)->first();

        if (!$tipopessoa)
            return redirect()->back();

        $tipopessoa->update($request->all());

        return redirect()->route('tipopessoas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipopessoa = $this->repository
                ->where('id', $id)
                ->first();

        if (!$tipopessoa)
            return redirect()->back();

        $tipopessoa->delete();

        return redirect()->route('tipopessoas.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $tipopessoas = $this->repository->search($request->filter);

        return view('admin.pages.tipopessoas.index', [
            'tipopessoas' => $tipopessoas,
            'filters' => $filters,
        ]);
    }
}
