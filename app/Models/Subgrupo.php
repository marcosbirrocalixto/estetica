<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupo extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'description', 'especie', 'active'];

    public function search($filter = null)
    {
        $results = $this->where('codigo', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

    /**
     * Get Grupo Eloquent
     */
    public function grupo() {
        return $this->belongsToMany(Grupo::class);
    }
}
