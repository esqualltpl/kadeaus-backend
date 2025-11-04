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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->enum('material_status', ['Single', 'Married'])->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->enum('blood_type', ['A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->enum('pregnancy', ['Yes', 'No'])->nullable();
            $table->enum('trimester', ['1st Trimester', '2nd Trimester', '3rd Trimester'])->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('relation')->nullable();
            $table->integer('contact_number')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
