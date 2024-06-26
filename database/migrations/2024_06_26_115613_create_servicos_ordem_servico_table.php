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
        Schema::create('servicos_ordemservico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('servico_id');
            $table->unsignedBigInteger('ordem_servico_id');
            $table->unsignedBigInteger('funcionario_id');


            $table->foreign('servico_id')
                        ->references('id')
                        ->on('servicos')
                        ->onDelete('cascade');

            $table->foreign('ordem_servico_id')
                        ->references('id')
                        ->on('ordens_servico')
                        ->onDelete('cascade');

            $table->foreign('funcionario_id')
                        ->references('id')
                        ->on('funcionarios')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos_ordemservico');
    }
};
