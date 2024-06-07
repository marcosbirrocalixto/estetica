<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'foto', 'active'];

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

    /**
     * Get Subgrupos Eloquent
     */
    public function subgrupos() {
        return $this->belongsToMany(Subgrupo::class);
    }

    /**
     * Get subgrupos not linked with this grupos
     */
    public function subgruposAvailable($filter = null)
    {
        $subgrupos = Subgrupo::whereNotIn('subgrupos.id', function($query) {
            $query->select('grupo_subgrupo.subgrupo_id');
            $query->from('grupo_subgrupo');
            $query->whereRaw("grupo_subgrupo.grupo_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('subgrupos.codigo', 'LIKE', "%{$filter}%");
        })
        ->paginate();
        //dd($subgrupos);

        return $subgrupos;
    }

}
