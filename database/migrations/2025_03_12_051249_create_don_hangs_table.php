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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->unique();
            $table->integer('id_khach_hang');
            $table->integer('id_voucher')->nullable();
            $table->integer('id_shipper')->nullable();
            $table->integer('id_quan_an');
            $table->integer('id_dia_chi_nhan');
            $table->string('ten_nguoi_nhan');
            $table->string('so_dien_thoai');
            $table->double('tien_hang')->default(0);
            $table->double('phi_ship')->default(0);
            $table->double('tong_tien')->default(0);
            $table->integer('is_thanh_toan')->default(0);
            $table->integer('tinh_trang')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
