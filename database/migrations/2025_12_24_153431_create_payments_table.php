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

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->enum('payment_source', ["online",'in-person']);
            $table->enum('payment_method', ["cash",'card']);

            // ربط الدفع بالحجز
            $table->unsignedBigInteger('reservation_id');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');

            // ربط الدفع بالمستخدم الذي عالج العملية
            $table->unsignedBigInteger('processed_by');
            $table->foreign('processed_by')->references('id')->on('users');

            // ربط الدفع بالمعاملة المالية
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->softDeletes();

            // وقت الدفع
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
