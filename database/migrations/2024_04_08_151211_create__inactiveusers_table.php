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
        Schema::create('inactiveusers', function (Blueprint $table) {
            $table->id();
            $table->string('urole');
            $table->string('ufirst_name');
            $table->string('ulast_name');
            $table->string('uemail')->unique();
            $table->string('uphone_number');
            $table->string('upassword', 12);
            $table->boolean('uis_active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inactiveusers');
    }
};
