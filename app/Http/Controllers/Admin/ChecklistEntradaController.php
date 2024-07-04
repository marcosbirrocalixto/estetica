<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateChecklistEntradaRequest;
use Illuminate\Http\Request;
use App\Models\ChecklistEntrada;

class ChecklistEntradaController extends Controller
{
    protected $repository;

    public function  __construct(ChecklistEntrada $checklistEntrada)
    {
        $this->repository = $checklistEntrada;
    }

    public function index()
    {
        $checklistEntradas = $this->repository->paginate();

        return view('admin.pages.checklistEntradas.index', [
            'checklistEntradas' => $checklistEntradas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.checklistEntradas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateChecklistEntradaRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('checklistEntradas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checklistEntrada = $this->repository->where('id', $id)->first();

        if (!$checklistEntrada)
            return redirect()->back();

        return view('admin.pages.checklistEntradas.show', [
            'checklistEntrada' => $checklistEntrada
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
        $checklistEntrada = $this->repository->where('id', $id)->first();

        if (!$checklistEntrada)
            return redirect()->back();

        return view('admin.pages.checklistEntradas.edit', [
            'checklistEntrada' => $checklistEntrada,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateChecklistEntradaRequest $request, $id)
    {
        $checklistEntrada = $this->repository->where('id', $id)->first();

        if (!$checklistEntrada)
            return redirect()->back();

        $checklistEntrada->update($request->all());

        return redirect()->route('checklistEntradas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checklistEntrada = $this->repository
                ->where('id', $id)
                ->first();

        if (!$checklistEntrada)
            return redirect()->back();

        $checklistEntrada->delete();

        return redirect()->route('checklistEntradas.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $checklistEntradas = $this->repository->search($request->filter);

        return view('admin.pages.checklistEntradas.index', [
            'checklistEntradas' => $checklistEntradas,
            'filters' => $filters,
        ]);
    }

}
