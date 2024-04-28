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
        Schema::create('participants', function (Blueprint $table) {
        $table->id();
        $table->string('ranking')->nullable();
        $table->string('age')->nullable();
        $table->string('age_started')->nullable();
        $table->string('gender')->nullable();
        $table->string('frequency_playing')->nullable();
        $table->string('unique_id')->nullable();
        $table->string('expertise')->nullable(); 
        $table->string('condition')->nullable(); 
        // Add more columns as needed
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
