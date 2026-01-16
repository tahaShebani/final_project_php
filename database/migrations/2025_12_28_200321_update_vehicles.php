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
        $table->unsignedBigInteger('car_model_id'); 
        $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
        $table->dropColumn("reserved_until");
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_models',function (Blueprint $table){
        $table->timestamp('reserved_until');
       });
    }
};
