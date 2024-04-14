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
        Schema::create('pmfondo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pm_id')->constrained(table: 'pm', indexName: 'pmfondo_pm_id');
            $table->foreignId('fondo_id')->constrained(table: 'fondo', indexName: 'pmfondo_fondo_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmfondo');
    }
};
