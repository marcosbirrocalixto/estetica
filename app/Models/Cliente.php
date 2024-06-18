<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'tipopessoa_id', 'telefone', 'celular', 'identidade', 'cep', 'tipoLogradouro', 'endereco', 'numero', 'complemeto', 'bairro', 'cidade', 'uf'];

    public function search($filter = null)
    {
        $results = $this->where('email', 'LIKE', "%{$filter}%")
                        ->orWhere('cnpf_cpf', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }
}
