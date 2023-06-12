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
        Schema::create('casts', function (Blueprint $table) {
            $table->comment('Tabla que relaciona películas con actores');
            $table->id(); 
            $table->unsignedBigInteger('film')->comment('id de la película');
            $table->unsignedBigInteger('actor')->comment('id del actor');
            $table->string('character');
            $table->timestamps();

            $table->foreign('film')->references('id')->on('films');
            $table->foreign('actor')->references('id')->on('actors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casts');
    }
};
