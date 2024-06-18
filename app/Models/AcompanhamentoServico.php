<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcompanhamentoServico extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    protected $table = 'acompanhamentos_servico';

    public function servico()
    {
        return $this->belongsto(Servico::class);
    }

    public function detalhes()
    {
        return $this->hasMany(DetalheAcompanhamento::class);
    }
}
