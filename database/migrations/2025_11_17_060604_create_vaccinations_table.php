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
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('User ID:belong to users table');
            $table->string('vaccine_name')->nullable();
            $table->enum('type', ['Childhood', 'Adult', 'Travel', 'Booster', 'Unknown'])->nullable();
            $table->string('administered_date')->nullable();
            $table->string('next_due_date')->nullable();
            $table->string('hospital')->nullable();
            $table->string('proof_file')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['active', 'pending'])->default('active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
