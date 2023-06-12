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
        Schema::create('films_genres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film')->comment('id de la película');
            $table->unsignedBigInteger('genre')->comment('id del género de película');
            $table->timestamps();

            $table->foreign('film')->references('id')->on('films');
            $table->foreign('genre')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films_genres');
    }
};
