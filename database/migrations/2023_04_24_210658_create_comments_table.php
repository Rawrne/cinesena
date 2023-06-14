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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user')->nullable()->comment('id del usuario');
            $table->unsignedBigInteger('review')->comment('id de la review');
            $table->mediumText('content');
            $table->integer('rating')->default(0)->comment('La puntuación del comentario');
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users');
            $table->foreign('review')->references('id')->on('reviews');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
