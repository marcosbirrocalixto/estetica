<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VeiculoCliente extends Model
{
    use HasFactory;

    protected $fillable = ['placa', 'marca'];

    protected $table = 'veiculos_cliente';

    public function cliente()
    {
        return $this->belongsto(Cliente::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function search($filter = null)
    {
        $results = $this::with('cliente')->where('placa', 'LIKE', "%{$filter}%")
                        ->orWhere('marca', 'LIKE', "%{$filter}%")
                        ->orWhere("$this->cliente->name", 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

}
