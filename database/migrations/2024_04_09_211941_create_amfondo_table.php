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
        Schema::create('amfondo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('am_id')->constrained(table: 'am', indexName: 'amfondo_am_id');
            $table->foreignId('fondo_id')->constrained(table: 'fondo', indexName: 'amfondo_fondo_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amfondo');
    }
};
