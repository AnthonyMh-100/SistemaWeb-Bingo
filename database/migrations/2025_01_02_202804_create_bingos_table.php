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
        Schema::create('bingos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_game');
            $table->boolean('pay');
            $table->foreignId('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreignId('people_id')->references('id')->on('participants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bingos');
    }
};
