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
            $table->unsignedBigInteger('tipologradouro_id');
            $table->unsignedBigInteger('uf_id');
            $table->string('name');
            $table->string('email');
            $table->string('cnpj_cpf')->unique();
            $table->string('telefone');
            $table->string('celular');
            $table->string('identidade');
            $table->string('cep');
            $table->string('endereco');
            $table->string('numero');
            $table->string('complemento');
            $table->string('bairro');
            $table->string('cidade');
            $table->timestamps();

            $table->foreign('tipopessoa_id')
                        ->references('id')
                        ->on('tipopessoas')
                        ->onDelete('cascade');

            $table->foreign('tipologradouro_id')
                        ->references('id')
                        ->on('tipologradouros')
                        ->onDelete('cascade');

            $table->foreign('uf_id')
                        ->references('id')
                        ->on('ufs')
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
