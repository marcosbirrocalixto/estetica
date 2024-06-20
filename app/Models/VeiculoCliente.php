<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoCliente extends Model
{
    use HasFactory;

    protected $fillable = ['placa', 'marca'];

    protected $table = 'veiculos_cliente';

    public function cliente()
    {
        return $this->belongsto(Cliente::class);
    }
}
