<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSubGrupoRequest;
use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Subgrupo;

class SubgrupoController extends Controller
{
    protected $subgrupo, $grupo;

    public function  __construct(Grupo $grupo, Subgrupo $subgrupo)
    {
        $this->grupo = $grupo;
        $this->subgrupo = $subgrupo;
    }

    public function index()
    {
        $subgrupos = $this->subgrupo::with('grupo')->orderBy('description')->paginate();
        //dd($subgrupos);

        return view('admin.pages.subgrupos.index', [
            'subgrupos' => $subgrupos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = $this->grupo->orderby('name')->get();
        return view('admin.pages.subgrupos.create', [
            'grupos' => $grupos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateSubgrupoRequest $request)
    {
        $this->subgrupo->create($request->all());

        return redirect()->route('subgrupos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subgrupo = $this->subgrupo->where('id', $id)->first();

        if (!$subgrupo)
            return redirect()->back();

        return view('admin.pages.subgrupos.show', [
            'subgrupo' => $subgrupo
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
        $subgrupo = $this->subgrupo->with('grupo')->where('id', $id)->first();

        $grupos = $this->grupo->orderby('name')->get();

        if (!$subgrupo)
            return redirect()->back();

        return view('admin.pages.subgrupos.edit', [
            'subgrupo' => $subgrupo,
            'grupos' => $grupos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateSubgrupoRequest $request, $id)
    {
        $subgrupo = $this->subgrupo->where('id', $id)->first();

        if (!$subgrupo)
            return redirect()->back();

        $subgrupo->update($request->all());

        return redirect()->route('subgrupos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subgrupo = $this->subgrupo
                ->where('id', $id)
                ->first();

        if (!$subgrupo)
            return redirect()->back();

        $subgrupo->delete();

        return redirect()->route('subgrupos.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $subgrupos = $this->subgrupo->search($request->filter);

        return view('admin.pages.subgrupos.index', [
            'subgrupos' => $subgrupos,
            'filters' => $filters,
        ]);
    }
}
