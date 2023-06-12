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
        Schema::create('filmographies', function (Blueprint $table) {
            $table->comment('Tabla que relaciona películas con directores');
            $table->id();
            $table->unsignedBigInteger('film')->comment('id de la película');
            $table->unsignedBigInteger('director')->comment('id del director');
            $table->timestamps();

            $table->foreign('film')->references('id')->on('films');
            $table->foreign('director')->references('id')->on('directors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmographies');
    }
};
