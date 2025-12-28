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

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->unsignedBigInteger('pickup_location_id');
            $table->foreign('pickup_location_id')->references('id')->on('locations');
            $table->unsignedBigInteger('dropoff_location_id');
            $table->foreign('dropoff_location_id')->references('id')->on('locations');
            $table->timestamp('reserved_at');
            $table->timestamp('expires_at')->nullable();
            $table->dateTime('pickup_date');
            $table->dateTime('return_date');
            $table->enum('status', ["pending",'confirmed','cancelled']);
            $table->double('total_price');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
