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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->integer('length')->comment('La duración en minutos');
            $table->unsignedBigInteger('country')->comment('País de origen');
            $table->integer('year')->nullable();
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('country')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
