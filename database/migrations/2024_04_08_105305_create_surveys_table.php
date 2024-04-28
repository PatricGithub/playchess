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
        Schema::create('exitsurveys', function (Blueprint $table) {
            $table->id();
            $table->boolean('instructionsClear');
            $table->tinyInteger('confidence');
            $table->string('chessboardSpeed');
            $table->string('unique_id');
            $table->string('condition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exitsurveys');
    }
};
