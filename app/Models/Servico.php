<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'tempoPrevisto'];

    public function acompanhamentos()
    {
        return $this->hasMany(AcompanhamentoServico::class);
    }

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

    /**
     * Get profiles Eloquent
     */
    public function ordemservicos() {
        return $this->belongsToMany(Ordemservico::class);
    }

    public function funcionarios() {
        return $this->belongsToMany(Funcionario::class);
    }

}
