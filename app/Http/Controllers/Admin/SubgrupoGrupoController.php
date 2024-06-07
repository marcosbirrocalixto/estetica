<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subgrupo;
use App\Models\Grupo;
use Illuminate\Http\Request;

class SubgrupoGrupoController extends Controller
{
    protected $grupo, $subgrupo;

    public function __construct(Grupo $grupo, Subgrupo $subgrupo)
    {
        $this->grupo = $grupo;
        $this->subgrupo = $subgrupo;
    }

    public function subgrupos($idGrupo)
    {
        $grupo = $this->grupo->with('subgrupos')->find($idGrupo);

        if (!$grupo) {
            return redirect()->back();
        }

        $subgrupos = $grupo->subgrupos()->paginate();

        return view('admin.pages.grupos.subgrupos.index', [
            'grupo' => $grupo,
            'subgrupos' => $subgrupos,
        ]);
    }

    public function grupos($idSubgrupo)
    {
        if (!$subgrupo = $this->subgrupo->find($idSubgrupo)) {
            return redirect()->back();
        }

        $grupos = $subgrupo->grupos()->paginate();

        return view('admin.pages.subgrupos.grupos.index', [
            'grupos' => $grupos,
            'subgrupo' => $subgrupo,
        ]);
    }

    public function subgruposAvailable(Request $request, $idGrupo)
    {
        if (!$grupo = $this->grupo->find($idGrupo)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $subgrupos = $grupo->subgruposAvailable($request->filter);

        return view('admin.pages.grupos.subgrupos.available', [
            'grupo' => $grupo,
            'subgrupos' => $subgrupos,
            'filters' => $filters,
        ]);
    }

    public function attachSubgruposGrupo(Request $request, $idGrupo)
    {
        if (!$grupo = $this->grupo->find($idGrupo)) {
            return redirect()->back();
        }

        $subgrupos = $grupo->subgruposAvailable();

        if (!$request->subgrupos || count($request->subgrupos) === 0) {
            return redirect()
                    ->back()
                    ->with('info', 'É necessário selecionar pelo menos uma permissão!');
        }
        //dd($request->subgrupos);

        $grupo->subgrupos()->attach($request->subgrupos);

        return redirect()->route('grupos.subgrupos', $grupo->id);
    }

    public function detachSubgrupoGrupo(Request $request, $idGrupo, $idSubgrupo)
    {
        $grupo = $this->grupo->find($idGrupo);
        $subgrupo = $this->subgrupo->find($idsubgrupo);

        if (!$grupo || !$subgrupo)
            return redirect()
                    ->back()
                    ->with('info', 'Não existe o Perfil ou a Permissão!');

        $grupo->subgrupos()->detach($subgrupo);

        return redirect()->route('grupos.subgrupos', $grupo->id);
    }
}
