<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoOrdemServico extends Model
{
    use HasFactory;

    protected $fillable = ['servico_id', 'ordem_servico_id'];

    protected $table = 'servicos_ordemservico';

    public function ordemservico()
    {
        return $this->belongsto(OrdemServico::class);
    }
}
