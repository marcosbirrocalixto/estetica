<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipousuario_id',
        'name',
        'email',
        'password',
     ];

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('email', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tipousuario()
    {
        return $this->belongsTo(Tipousuario::class);
    }

    /**
     * Get permissions Eloquent
     */
    public function clientes() {
        return $this->belongsToMany(Cliente::class);
    }

    /**
     * Get permissions not linked with this profile
     */
    public function clientesAvailable($filter = null)
    {
        $clientes = Cliente::whereNotIn('clientes.id', function($query) {
            $query->select('cliente_user.cliente_id');
            $query->from('cliente_user');
            $query->whereRaw("cliente_user.user_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('clientes.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $clientes;
    }
}
