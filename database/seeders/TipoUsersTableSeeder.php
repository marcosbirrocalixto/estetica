<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tipousuario;
use Illuminate\Database\Seeder;

class TipoUSersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipousuario::create([
            'name'      => 'Cliente',
            'description'     => 'Cliente',
        ]);
        Tipousuario::create([
            'name'      => 'Administrador',
            'description'     => 'Administrador',
        ]);
    }
}
