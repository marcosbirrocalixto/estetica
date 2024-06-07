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
        Schema::create('grupo_subgrupo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subgrupo_id');
            $table->unsignedBigInteger('grupo_id');

            $table->foreign('subgrupo_id')
                        ->references('id')
                        ->on('subgrupos')
                        ->onDelete('cascade');

            $table->foreign('grupo_id')
                        ->references('id')
                        ->on('grupos')
                        ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_subgrupo');
    }
};
