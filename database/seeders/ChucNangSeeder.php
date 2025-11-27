<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucNangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chuc_nangs')->delete();

        DB::table('chuc_nangs')->truncate();

        DB::table('chuc_nangs')->insert([
            // === QUẢN LÝ NHÂN VIÊN ===
            ['id' => 1, 'ten_chuc_nang' => 'Xem danh sách nhân viên'],
            ['id' => 2, 'ten_chuc_nang' => 'Tạo mới nhân viên'],
            ['id' => 3, 'ten_chuc_nang' => 'Cập nhật thông tin nhân viên'],
            ['id' => 4, 'ten_chuc_nang' => 'Xóa nhân viên'],
            ['id' => 5, 'ten_chuc_nang' => 'Thay đổi trạng thái nhân viên'],

            // === QUẢN LÝ QUÁN ĂN ===
            ['id' => 6, 'ten_chuc_nang' => 'Xem danh sách quán ăn'],
            ['id' => 7, 'ten_chuc_nang' => 'Duyệt đăng ký quán ăn'],
            ['id' => 8, 'ten_chuc_nang' => 'Cập nhật thông tin quán ăn'],
            ['id' => 9, 'ten_chuc_nang' => 'Khóa/mở khóa quán ăn'],
            ['id' => 10, 'ten_chuc_nang' => 'Xóa quán ăn'],

            // === QUẢN LÝ SHIPPER ===
            ['id' => 11, 'ten_chuc_nang' => 'Xem danh sách shipper'],
            ['id' => 12, 'ten_chuc_nang' => 'Duyệt đăng ký shipper'],
            ['id' => 13, 'ten_chuc_nang' => 'Cập nhật thông tin shipper'],
            ['id' => 14, 'ten_chuc_nang' => 'Khóa/mở khóa shipper'],
            ['id' => 15, 'ten_chuc_nang' => 'Xóa shipper'],

            // === QUẢN LÝ KHÁCH HÀNG ===
            ['id' => 16, 'ten_chuc_nang' => 'Xem danh sách khách hàng'],
            ['id' => 17, 'ten_chuc_nang' => 'Cập nhật thông tin khách hàng'],
            ['id' => 18, 'ten_chuc_nang' => 'Khóa/mở khóa khách hàng'],
            ['id' => 19, 'ten_chuc_nang' => 'Xóa khách hàng'],

            // === QUẢN LÝ DANH MỤC ===
            ['id' => 20, 'ten_chuc_nang' => 'Xem danh sách danh mục'],
            ['id' => 21, 'ten_chuc_nang' => 'Tạo mới danh mục'],
            ['id' => 22, 'ten_chuc_nang' => 'Cập nhật danh mục'],
            ['id' => 23, 'ten_chuc_nang' => 'Xóa danh mục'],
            ['id' => 24, 'ten_chuc_nang' => 'Thay đổi trạng thái danh mục'],

            // === QUẢN LÝ MÓN ĂN ===
            ['id' => 25, 'ten_chuc_nang' => 'Xem danh sách món ăn'],
            ['id' => 26, 'ten_chuc_nang' => 'Duyệt món ăn mới'],
            ['id' => 27, 'ten_chuc_nang' => 'Cập nhật thông tin món ăn'],
            ['id' => 28, 'ten_chuc_nang' => 'Xóa món ăn vi phạm'],
            ['id' => 29, 'ten_chuc_nang' => 'Thay đổi trạng thái món ăn'],

            // === QUẢN LÝ VOUCHER ===
            ['id' => 30, 'ten_chuc_nang' => 'Xem danh sách voucher'],
            ['id' => 31, 'ten_chuc_nang' => 'Tạo voucher hệ thống'],
            ['id' => 32, 'ten_chuc_nang' => 'Cập nhật voucher'],
            ['id' => 33, 'ten_chuc_nang' => 'Xóa voucher'],
            ['id' => 34, 'ten_chuc_nang' => 'Thay đổi trạng thái voucher'],

            // === QUẢN LÝ ĐỐN HÀNG ===
            ['id' => 35, 'ten_chuc_nang' => 'Xem tất cả đơn hàng'],
            ['id' => 36, 'ten_chuc_nang' => 'Xem chi tiết đơn hàng'],
            ['id' => 37, 'ten_chuc_nang' => 'Hủy đơn hàng'],
            ['id' => 38, 'ten_chuc_nang' => 'Xử lý khiếu nại đơn hàng'],
            ['id' => 39, 'ten_chuc_nang' => 'Hoàn tiền đơn hàng'],

            // === BÁO CÁO & THỐNG KÊ ===
            ['id' => 40, 'ten_chuc_nang' => 'Xem báo cáo doanh thu'],
            ['id' => 41, 'ten_chuc_nang' => 'Xem thống kê hệ thống'],
            ['id' => 42, 'ten_chuc_nang' => 'Xuất báo cáo Excel/PDF'],
            ['id' => 43, 'ten_chuc_nang' => 'Xem báo cáo chi tiết theo thời gian'],

            // === QUẢN LÝ HỆ THỐNG ===
            ['id' => 44, 'ten_chuc_nang' => 'Quản lý chức vụ'],
            ['id' => 45, 'ten_chuc_nang' => 'Phân quyền hệ thống'],
            ['id' => 46, 'ten_chuc_nang' => 'Cấu hình hệ thống'],
            ['id' => 47, 'ten_chuc_nang' => 'Backup dữ liệu'],
            ['id' => 48, 'ten_chuc_nang' => 'Xem log hệ thống'],

            // === HỖ TRỢ KHÁCH HÀNG ===
            ['id' => 49, 'ten_chuc_nang' => 'Trả lời chat khách hàng'],
            ['id' => 50, 'ten_chuc_nang' => 'Xử lý khiếu nại'],
            ['id' => 51, 'ten_chuc_nang' => 'Quản lý feedback'],

            // === MARKETING ===
            ['id' => 52, 'ten_chuc_nang' => 'Tạo chương trình khuyến mãi'],
            ['id' => 53, 'ten_chuc_nang' => 'Quản lý banner/quảng cáo'],
            ['id' => 54, 'ten_chuc_nang' => 'Gửi thông báo push'],
            ['id' => 55, 'ten_chuc_nang' => 'Quản lý email marketing'],
        ]);
    }
}
