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
        Schema::table('payments', function (Blueprint $table) {
            // 1. Drop the foreign key constraint first
            $table->dropForeign(['processed_by']);
        });

        Schema::table('payments', function (Blueprint $table) {
            // 2. Modify the column to be nullable
            $table->foreignId('processed_by')->nullable()->change();

            // 3. Re-add the constraint
            $table->foreign('processed_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['processed_by']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('processed_by')->nullable(false)->change();
            $table->foreign('processed_by')->references('id')->on('users');
        });
    }
};
