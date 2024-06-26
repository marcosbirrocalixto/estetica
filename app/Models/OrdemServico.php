<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'veiculo_id', 'user_id', 'dataentrada', 'dataprogramada', 'kminicial', 'combustivel', 'observacao'];

    protected $table = 'ordens_servico';

    public function servicos()
    {
        return $this->hasMany(ServicoOrdemServico::class);
    }


    /**
     * Get servicos not linked with this ordem servico
     */
    public function servicosAvailable($filter = null)
    {
        $servicos = Servico::whereNotIn('servicos.id', function($query) {
            $query->select('servicos_ordemservico.servico_id');
            $query->from('servicos_ordemservico');
            $query->whereRaw("servicos_ordemservico.ordem_servico_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('servicos.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();
        //dd($servicos);

        return $servicos;
    }
}
