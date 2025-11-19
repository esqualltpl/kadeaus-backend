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
        Schema::create('blood_pressures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('User ID:belong to users table');
            $table->string('systolic')->nullable();
            $table->string('diastolic')->nullable();;
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->enum('blood_pressure_status', ['High', 'Normal', 'Low'])->nullable();
            $table->enum('status', ['pending', 'active'])->default('active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_pressures');
    }
};
