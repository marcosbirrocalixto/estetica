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
        Schema::create('detalhes_acompanhamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acompanhamento_servico_id');
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();

            $table->foreign('acompanhamento_servico_id')
                        ->references('id')
                        ->on('acompanhamentos_servico')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalhe_acompanhamentos');
    }
};
