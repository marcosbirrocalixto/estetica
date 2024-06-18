<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipopessoa_id');
            $table->string('name');
            $table->string('email');
            $table->string('cnpf_cpf')->unique();
            $table->string('telefone');
            $table->string('celular');
            $table->string('identidade');
            $table->string('cep');
            $table->string('endereco');
            $table->string('numero');
            $table->string('complemeto');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->timestamps();

            $table->foreign('tipopessoa_id')
                        ->references('id')
                        ->on('tipopessoas')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
