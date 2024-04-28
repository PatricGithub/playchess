<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trial_order', function (Blueprint $table) {
            $table->id();
            $table->string('set_number');
            $table->string('photo1_path');
            $table->string('photo2_path');
            $table->string('pairing_type');
            $table->boolean('taken')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trial_order');
    }
};
