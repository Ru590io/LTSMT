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
        Schema::create('pmrepeticiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pm_id')->constrained(table: 'pm', indexName: 'pmrepeticiones_pm_id');
            $table->foreignId('repeticion_id')->constrained(table: 'repeticion', indexName: 'pmrepeticiones_repeticion_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmrepeticiones');
    }
};
