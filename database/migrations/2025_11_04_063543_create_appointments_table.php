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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('User ID:belong to users table');
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('rescheduled_by')->nullable();
             $table->string('rescheduled_date')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->string('cancelled_date')->nullable();
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->enum('is_share_documents', ['Yes', 'No',])->nullable();
            $table->enum('visit_type', ['in-person', 'virtual',])->nullable();
            $table->string('virtual_link')->nullable();
            $table->text('note')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->enum('status', ['pending', 'active','completed','cancelled'])->default('pending')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
