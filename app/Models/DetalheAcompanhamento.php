<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalheAcompanhamento extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    protected $table = 'detalhes_acompanhamento';

    public function acompanhamento()
    {
        return $this->belongsto(AcompanhamentoServico::class);
    }

}
