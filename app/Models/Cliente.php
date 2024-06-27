<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'cnpj_cpf', 'tipopessoa_id', 'telefone', 'celular', 'identidade', 'cep', 'tipologradouro_id', 'endereco', 'numero', 'complemento', 'bairro', 'cidade', 'uf_id'];

    public function search($filter = null)
    {
        $results = $this->where('email', 'LIKE', "%{$filter}%")
                        ->orWhere('email', 'LIKE', "%{$filter}%")
                        ->orWhere('cnpj_cpf', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

    /**
     * Get users Eloquent
     */
    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}
