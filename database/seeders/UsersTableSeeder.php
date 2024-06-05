<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Marcos Birro Calixto',
            'email'     => 'marcosbirrocalixto@outlook.com.br',
            'password'  => bcrypt('Jack1746'),
        ]);
    }
}
