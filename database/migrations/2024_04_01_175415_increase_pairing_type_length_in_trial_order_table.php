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
        Schema::table('trial_order', function (Blueprint $table) {
            $table->string('pairing_type', 255)->change();

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trial_order', function (Blueprint $table) {
            $table->string('pairing_type', 50)->change();

            //
        });
    }
};
