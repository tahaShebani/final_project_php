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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // البيانات الأساسية
            $table->string('name', 100); // الاسم الكامل
            $table->string('email', 150)->unique(); // البريد الإلكتروني
            $table->string('phone_number', 20)->nullable(); // رقم الهاتف (اختياري)

            // الدور (user/admin)
            $table->enum('role', ['user', 'admin'])->default('user'); 

            // أعمدة Laravel الافتراضية
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // إدارة الوقت والحذف الناعم
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
