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
        Schema::create('weeklyshedule', function (Blueprint $table) {
            $table->id();
            $table->date('wstart_date')->nullable();
            $table->date('wend_date')->nullable();
            $table->string('wname');
            $table->foreignId('users_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_shedule_');
    }
};
