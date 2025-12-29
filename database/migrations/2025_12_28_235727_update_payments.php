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

            $table->unsignedBigInteger('transaction_id')->nullable()->change();

            $table->unsignedBigInteger('reservations_id')->nullable();
            $table->foreign('reservations_id')->references('id')->on('reservations');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::table('payments', function (Blueprint $table) {

            $table->unsignedBigInteger('transaction_id')->change();

            $table->dropColumn('reservations_id');


        });
    }
};
