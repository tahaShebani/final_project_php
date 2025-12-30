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
            Schema::table('inspection_reports', function (Blueprint $table) {
                      $table->dropForeign(['reservation_id']);

            // 2. Re-add the constraint with the cascade option
            $table->foreign('reservation_id')
                ->references('id')
                ->on('reservations')
                ->onDelete('cascade');
        


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
