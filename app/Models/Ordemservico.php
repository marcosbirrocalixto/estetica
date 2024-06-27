<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordemservico extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'veiculo_id', 'user_id', 'dataentrada', 'dataprogramada', 'kminicial', 'combustivel', 'observacao'];

    protected $table = 'ordemservicos';

    public function servico()
    {
        return $this->hasMany(Servico::class);
    }

    /**
     * Get permissions Eloquent
     */
    public function veiculos() {
        return $this->belongsToMany(Veiculo::class);
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class);
    }

    /**
     * Get permissions not linked with this profile
     */
    public function servicosAvailable($filter = null)
    {
        $servicos = Servico::whereNotIn('servicos.id', function($query) {
            $query->select('ordemservico_servico.servico_id');
            $query->from('ordemservico_servico');
            $query->whereRaw("ordemservico_servico.ordemservico_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('servicos.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();
        //dd($permissions);

        return $servicos;
    }
}
