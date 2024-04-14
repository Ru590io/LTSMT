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
        Schema::create('amdescanso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('am_id')->constrained(table: 'am', indexName: 'amdescanso_am_id');
            $table->foreignId('descanso_id')->constrained(table: 'descanso', indexName: 'amdescanso_descanso_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amdescanso');
    }
};
