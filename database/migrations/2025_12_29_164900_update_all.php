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
    $tables = [   'transactions', 'inspection_reports']; // Add all your table names here

    foreach ($tables as $table) {
        Schema::table($table, function (Blueprint $table) {
            $table->softDeletes(); // Adds the 'deleted_at' column
        });
    }
}

public function down(): void
{
    $tables = ['cars', 'reservations', 'payments', 'users'];
    foreach ($tables as $table) {
        Schema::table($table, function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
};
