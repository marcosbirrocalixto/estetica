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
        Schema::create('acompanhamentos_servico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servico_id');
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();

            $table->foreign('servico_id')
                        ->references('id')
                        ->on('servicos')
                        ->onDelete('cascade');

        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acompanhamentos_servico');
    }
};
