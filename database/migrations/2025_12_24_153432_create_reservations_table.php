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
            $table->unsignedBigInteger('car_model_id');
            $table->unsignedBigInteger('pickup_location_id');
            $table->unsignedBigInteger('dropoff_location_id');
            $table->timestamp('reserved_at');
            $table->timestamp('expires_at')->nullable();
            $table->dateTime('pickup_date');
            $table->dateTime('return_date');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending'); // حالة الحجز
            $table->double('total_price');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
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
