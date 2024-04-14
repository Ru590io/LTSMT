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
        Schema::create('pmdescanso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pm_id')->constrained(table: 'pm', indexName: 'pmdescanso_pm_id');
            $table->foreignId('descanso_id')->constrained(table: 'descanso', indexName: 'pmdescanso_descanso_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmdescanso');
    }
};
