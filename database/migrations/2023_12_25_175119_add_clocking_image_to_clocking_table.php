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
        Schema::table('clockings', function (Blueprint $table) {
            $table->string('clock_in_image')->after('notes')->nullable();
            $table->string('clock_out_image')->after('clock_in_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clockings', function (Blueprint $table) {
            $table->dropColumn(['clock_in_image','clock_out_image']);
        });
    }
};
