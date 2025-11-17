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
        Schema::create('heart_rates', function (Blueprint $table) {
            $table->id();
           $table->unsignedBigInteger('user_id')->nullable()->comment('User ID:belong to users table');
             $table->string('bpm')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
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
        Schema::dropIfExists('heart_rates');
    }
};
