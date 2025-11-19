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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('User ID:belong to users table');
            $table->text('disease')->nullable();
            $table->string('diagnosis_date')->nullable();
            $table->enum('status', ['Active', 'Resolved','Pending','Unknown'])->default('Active')->nullable();
            $table->text('description')->nullable();
            $table->string('hospital')->nullable();
            $table->text('report_file')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};
