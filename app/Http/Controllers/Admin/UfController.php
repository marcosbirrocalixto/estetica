<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUfRequest;
use Illuminate\Http\Request;
use App\Models\Uf;

class UfController extends Controller
{
    protected $repository;

    public function  __construct(Uf $uf)
    {
        $this->repository = $uf;
    }

    public function index()
    {
        $ufs = $this->repository->orderby('sigla')->paginate();

        return view('admin.pages.ufs.index', [
            'ufs' => $ufs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.ufs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUfRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('ufs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $uf = $this->repository->where('id', $id)->first();

        if (!$uf)
            return redirect()->back();

        return view('admin.pages.ufs.show', [
            'uf' => $uf
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
        $uf = $this->repository->where('id', $id)->first();

        if (!$uf)
            return redirect()->back();

        return view('admin.pages.ufs.edit', [
            'uf' => $uf,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUfRequest $request, $id)
    {
        $uf = $this->repository->where('id', $id)->first();

        if (!$uf)
            return redirect()->back();

        $uf->update($request->all());

        return redirect()->route('ufs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uf = $this->repository
                ->where('id', $id)
                ->first();

        if (!$uf)
            return redirect()->back();

        $uf->delete();

        return redirect()->route('ufs.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $ufs = $this->repository->search($request->filter);

        return view('admin.pages.ufs.index', [
            'ufs' => $ufs,
            'filters' => $filters,
        ]);
    }
}
