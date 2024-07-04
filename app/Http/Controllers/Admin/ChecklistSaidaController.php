<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateChecklistSaidaRequest;
use Illuminate\Http\Request;
use App\Models\ChecklistSaida;

class ChecklistSaidaController extends Controller
{
    protected $repository;

    public function  __construct(ChecklistSaida $checklistSaida)
    {
        $this->repository = $checklistSaida;
    }

    public function index()
    {
        $checklistSaidas = $this->repository->paginate();

        return view('admin.pages.checklistSaidas.index', [
            'checklistSaidas' => $checklistSaidas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.checklistSaidas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateChecklistSaidaRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('checklistSaidas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checklistSaida = $this->repository->where('id', $id)->first();

        if (!$checklistSaida)
            return redirect()->back();

        return view('admin.pages.checklistSaidas.show', [
            'checklistSaida' => $checklistSaida
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
        $checklistSaida = $this->repository->where('id', $id)->first();

        if (!$checklistSaida)
            return redirect()->back();

        return view('admin.pages.checklistSaidas.edit', [
            'checklistSaida' => $checklistSaida,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateChecklistSaidaRequest $request, $id)
    {
        $checklistSaida = $this->repository->where('id', $id)->first();

        if (!$checklistSaida)
            return redirect()->back();

        $checklistSaida->update($request->all());

        return redirect()->route('checklistSaidas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checklistSaida = $this->repository
                ->where('id', $id)
                ->first();

        if (!$checklistSaida)
            return redirect()->back();

        $checklistSaida->delete();

        return redirect()->route('checklistSaidas.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $checklistSaidas = $this->repository->search($request->filter);

        return view('admin.pages.checklistSaidas.index', [
            'checklistSaidas' => $checklistSaidas,
            'filters' => $filters,
        ]);
    }


}
