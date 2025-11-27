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
        Schema::create('shippers', function (Blueprint $table) {
            $table->id();
            $table->string('ho_va_ten');
            $table->string('so_dien_thoai')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('hinh_anh')->nullable();
            $table->string('cccd')->nullable()->unique();
            $table->integer('is_active')->default(0);
            $table->integer('is_open')->default(0);
            $table->double('tong_tien')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippers');
    }
};
