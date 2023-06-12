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
        Schema::create('writing_teams', function (Blueprint $table) {
            $table->comment('Tabla que relaciona películas con guionistas');
            $table->id();
            $table->unsignedBigInteger('film')->comment('id de la película');
            $table->unsignedBigInteger('writer')->comment('id del guionista');
            $table->timestamps();

            $table->foreign('film')->references('id')->on('films');
            $table->foreign('writer')->references('id')->on('writers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writing_teams');
    }
};
