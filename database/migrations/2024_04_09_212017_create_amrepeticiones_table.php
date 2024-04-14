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
        Schema::create('amrepeticiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('am_id')->constrained(table: 'am', indexName: 'amrepeticiones_am_id');
            $table->foreignId('repeticion_id')->constrained(table: 'repeticion', indexName: 'amrepeticiones_repeticion_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amrepeticiones');
    }
};
