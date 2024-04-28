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
        Schema::create('image_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('rating');
            $table->string('answer');
            $table->string('participant_id'); // Assuming participants have IDs
            $table->string('expertise'); // Add data type for participant expertise
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_ratings');
    }
};
