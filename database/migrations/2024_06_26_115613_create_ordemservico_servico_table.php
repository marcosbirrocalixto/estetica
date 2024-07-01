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
        Schema::create('ordemservico_servico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('servico_id');
            $table->unsignedBigInteger('ordemservico_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('funcionario_id')->nullable();
            $table->time('tempoPrevisto')->nullable();
            $table->time('tempoRealizado')->nullable();
            $table->double('valorCobrado', 10, 2)->nullable();

            $table->foreign('servico_id')
                        ->references('id')
                        ->on('servicos')
                        ->onDelete('cascade');

            $table->foreign('ordemservico_id')
                        ->references('id')
                        ->on('ordemservicos')
                        ->onDelete('cascade');

            $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
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
        Schema::dropIfExists('servicoordemservicos');
    }
};
