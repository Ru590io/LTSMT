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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('am_id')->constrained(table: 'am', indexName: 'sessions_am_id');
            $table->foreignId('pm_id')->constrained(table: 'pm', indexName: 'sessions_pm_id');
            $table->foreignId('days_id')->constrained(table: 'days', indexName: 'sessions_days_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
