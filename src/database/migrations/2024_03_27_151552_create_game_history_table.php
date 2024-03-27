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
        Schema::create('game_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unique_link_id');
            $table->string('result');
            $table->decimal('number', 3, 0);
            $table->decimal('amount', 5, 2);
            $table->timestamps();

            $table->foreign('unique_link_id')->references('id')->on('unique_links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_history');
    }
};
