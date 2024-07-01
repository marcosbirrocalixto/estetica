<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoOrdemServico extends Model
{
    use HasFactory;

    protected $fillable = ['servico_id', 'ordemservico_id', 'user_id', 'funcionario_id', 'tempoPrevisto', 'tempoRealizado', 'valorCobrado'];

    protected $table = 'ordemservico_servico';
}
