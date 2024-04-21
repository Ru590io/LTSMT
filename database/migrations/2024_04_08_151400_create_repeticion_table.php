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
        Schema::create('repeticion', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('Rdistancia');
            $table->unsignedInteger('Rsets');
            $table->unsignedInteger('Rtiempoesperado');
            $table->unsignedInteger('Rrecuperacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repeticion');
    }
};
