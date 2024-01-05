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
        Schema::create('cash_recounsilations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('c5')->default(0);
            $table->integer('c10')->default(0);
            $table->integer('c50')->default(0);
            $table->integer('d1')->default(0);
            $table->integer('d2')->default(0);
            $table->integer('d5')->default(0);
            $table->integer('d10')->default(0);
            $table->integer('d20')->default(0);
            $table->integer('d50')->default(0);
            $table->integer('d100')->default(0);
            $table->date('date');
            $table->float('total')->default(0.00);
            $table->foreignUuid('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('updated_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_recounsilations');
    }
};
