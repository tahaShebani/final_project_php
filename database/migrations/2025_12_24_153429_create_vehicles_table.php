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
        Schema::disableForeignKeyConstraints();

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_model');
            $table->foreign('car_model')->references('id')->on('car_models');
            $table->string('vin')->unique();
            $table->string('license_plate');
            $table->string('color');
            $table->integer('mileage');
            $table->double('price');
            $table->enum('status', ["available",'reserved','rented','maintenance']);
            $table->timestamp('reserved_until');
            $table->unsignedBigInteger('current_location_id');
            $table->foreign('current_location_id')->references('id')->on('locations');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
