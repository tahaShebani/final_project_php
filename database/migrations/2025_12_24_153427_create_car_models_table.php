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

        Schema::create('car_models', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('car_class')->nullable(); $table->foreign('car_class')->references('id')->on('car_classes')->onDelete('cascade');
            $table->string('brand');                // اسم الشركة المصنعة
            $table->string('model_name');           // اسم الموديل
            $table->year('year');                   // سنة الصنع
            $table->string('fuel_type');            // نوع الوقود
            $table->string('transmission');         // ناقل الحركة
            $table->integer('doors');               // عدد الأبواب
            $table->integer('seating_capacity');    // عدد المقاعد
            $table->integer('luggage_capacity');    // سعة الحقائب
            $table->decimal('price', 10, 2);        // السعر اليومي
            $table->enum('status', ['available', 'unavailable'])->default('available'); // حالة السيارة
            $table->string('image_path')->nullable(); // صورة السيارة (اختياري)
            $table->softDeletes();                  // لدعم الحذف الناعم
            $table->timestamps();                   // created_at و updated_at
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};
