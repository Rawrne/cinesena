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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user')->nullable()->comment('id del usuario');
            $table->unsignedBigInteger('film')->comment('id de la película');
            $table->mediumText('content');
            $table->decimal('score', 2, 1)->comment('La puntuación de la película');
            $table->integer('rating')->default(0)->comment('La puntuación de la review');
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users');
            $table->foreign('film')->references('id')->on('films');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
