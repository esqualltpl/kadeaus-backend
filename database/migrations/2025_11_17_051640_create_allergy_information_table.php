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
        Schema::create('allergy_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('User ID:belong to users table');
            $table->enum('type', ['Food', 'Drug', 'Environmental', 'Other'])->nullable();
            $table->string('allergy_name')->nullable();
            $table->string('reaction_type')->nullable();
            $table->enum('severity', ['Mild', 'Moderate', 'Serious', 'Severe', 'unknown'])->nullable();;
            $table->string('identify_date')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['active', 'pending'])->default('active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergy_information');
    }
};
