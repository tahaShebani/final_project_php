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
        Schema::table('vehicles', function (Blueprint $table) {

            $table->enum('status', ["available",'reserved','rented','maintenance','out_of_service'])->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                Schema::table('vehicles', function (Blueprint $table) {

            $table->enum('status', ["available",'reserved','rented','maintenance'])->change();

        });
    }
};
