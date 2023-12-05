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
        Schema::create('user_pays', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->double('net_pay',10,2)->default(0.00);
            $table->double('gross_pay',10,2)->default(0.00);
            $table->double('tax', 10, 2)->default(0.00);
            $table->double('tax_amount', 10, 2)->default(0.00);
            $table->double('rate', 5,2);
            $table->double('total_working_hours', 5, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_paid')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pays');
    }
};
