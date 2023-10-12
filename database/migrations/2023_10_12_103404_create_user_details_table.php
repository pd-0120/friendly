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
        Schema::create('user_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('phone', 20)->nullable();
            $table->string('emergency_phone', 20)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('suburb', 50)->nullable();
            $table->integer('pincode')->nullable();
            $table->double('payrate', 10, 2)->default(0.00);
            $table->date('joining_date')->nullable();
            $table->date('leaving_date')->nullable();
            $table->date('dob')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
