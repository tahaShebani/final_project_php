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


        Schema::table('vehicles',function (Blueprint $table){
        $table->timestamp("reserved_until")->nullable();
        $table->unsignedBigInteger('returned_at_id')->nullable();
        $table->foreign('returned_at_id')->references('id')->on('locations');
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('vehicles',function (Blueprint $table){
        $table->dropColumn("reserved_until");
        $table->dropColumn("returned_at_id");

       });
    }
};
