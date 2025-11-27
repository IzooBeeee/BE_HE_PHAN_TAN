<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class ThongKeAdminController extends Controller
{
    public function thongKeTienKhachHang(Request $request)
    {
        $day_begin = $request->day_begin;
        $day_end = $request->day_end;
        if ($day_begin && $day_end) {
            $data = DonHang::join('khach_hangs', 'khach_hangs.id', '=', 'don_hangs.id_khach_hang')
                ->whereDate('don_hangs.created_at', '>=', $day_begin)
                ->whereDate('don_hangs.created_at', '<=', $day_end)
                ->select(
                    'khach_hangs.ho_va_ten',
                    DB::raw('SUM(tong_tien) as tong_tien_tieu'),
                    DB::raw('COUNT(don_hangs.id) as tong_don_hang'),
                    DB::raw('MAX(tong_tien) as don_hang_max'),
                )->groupBy('khach_hangs.ho_va_ten')->get();
        } else {
            $data = DonHang::join('khach_hangs', 'khach_hangs.id', '=', 'don_hangs.id_khach_hang')
                ->select(
                    'khach_hangs.ho_va_ten',
                    DB::raw('SUM(tong_tien) as tong_tien_tieu'),
                    DB::raw('COUNT(don_hangs.id) as tong_don_hang'),
                    DB::raw('MAX(tong_tien) as don_hang_max'),
                )->groupBy('khach_hangs.ho_va_ten')->get();
        }
        $list_ten = [];
        $list_tien = [];
        foreach ($data as $key => $value) {
            array_push($list_ten, $value->ho_va_ten);
            array_push($list_tien, $value->tong_tien_tieu);
        }
        return response()->json([
            'list_ten' => $list_ten,
            'list_tien' => $list_tien,
            'data'  => $data
        ]);
    }
    public function thongKeTienQuanAn(Request $request)
    {
        $day_begin = $request->day_begin;
        $day_end = $request->day_end;

        if ($day_begin && $day_end) {
            $data = DB::table('don_hangs')
                ->join('quan_ans', 'quan_ans.id', '=', 'don_hangs.id_quan_an')
                ->join('khach_hangs', 'khach_hangs.id', '=', 'don_hangs.id_khach_hang')
                ->whereDate('don_hangs.created_at', '>=', $day_begin)
                ->whereDate('don_hangs.created_at', '<=', $day_end)
                ->select(
                    'quan_ans.ten_quan_an',
                    DB::raw('COUNT(DISTINCT don_hangs.id) as tong_don_hang'),
                    DB::raw('COUNT(DISTINCT don_hangs.id_khach_hang) as so_luong_khach_hang'),
                    DB::raw('SUM(don_hangs.tong_tien) as tong_tien_ban')
                )
                ->groupBy('quan_ans.ten_quan_an')
                ->get();
        } else {
            $data = DB::table('don_hangs')
                ->join('quan_ans', 'quan_ans.id', '=', 'don_hangs.id_quan_an')
                ->join('khach_hangs', 'khach_hangs.id', '=', 'don_hangs.id_khach_hang')
                ->select(
                    'quan_ans.ten_quan_an',
                    DB::raw('COUNT(DISTINCT don_hangs.id) as tong_don_hang'),
                    DB::raw('COUNT(DISTINCT don_hangs.id_khach_hang) as so_luong_khach_hang'),
                    DB::raw('SUM(don_hangs.tong_tien) as tong_tien_ban')
                )
                ->groupBy('quan_ans.ten_quan_an')
                ->get();
        }
        $list_ten = [];
        $list_tien = [];
        foreach ($data as $key => $value) {
            array_push($list_ten, $value->ten_quan_an);
            array_push($list_tien, $value->tong_tien_ban);
        }
        return response()->json([
            'list_ten' => $list_ten,
            'list_tien' => $list_tien,
            'data'  => $data
        ]);
    }


    public function dashboard(Request $request)
    {
        // ==================== THỐNG KÊ TỔNG QUAN ====================
        $tongQuanAn = DB::table('quan_ans')->count();
        $tongMonAn = DB::table('mon_ans')->count();
        $tongKhachHang = DB::table('khach_hangs')->count();
        $tongDonHang = DB::table('don_hangs')->count();

        // ==================== THỐNG KÊ DOANH THU ====================
        // Tổng doanh thu tất cả thời gian
        $tongDoanhThu = DB::table('don_hangs')->where('is_thanh_toan', 1)->sum('tong_tien');

        // Doanh thu hôm nay
        $today = now()->toDateString();
        $doanhThuHomNay = DB::table('don_hangs')
            ->whereDate('created_at', $today)
            ->where('is_thanh_toan', 1)
            ->sum('tong_tien');

        // Doanh thu tuần này
        $thisWeek = now()->startOfWeek();
        $doanhThuTuanNay = DB::table('don_hangs')
            ->where('created_at', '>=', $thisWeek)
            ->where('is_thanh_toan', 1)
            ->sum('tong_tien');

        // Doanh thu tháng này
        $thisMonth = now()->startOfMonth();
        $doanhThuThangNay = DB::table('don_hangs')
            ->where('created_at', '>=', $thisMonth)
            ->where('is_thanh_toan', 1)
            ->sum('tong_tien');

        // ==================== BIỂU ĐỒ DOANH THU THEO THÁNG ====================
        // Cố định năm hiện tại, không nhận tham số year từ query
        $currentYear = now()->year;
        $doanhThuTheoThang = DB::table('don_hangs')
            ->select(
                DB::raw('MONTH(created_at) as thang'),
                DB::raw('SUM(CASE WHEN is_thanh_toan = 1 THEN tong_tien ELSE 0 END) as doanh_thu'),
                DB::raw('COUNT(CASE WHEN is_thanh_toan = 1 THEN 1 END) as so_don_hang_thanh_cong')
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('thang')
            ->get()
            ->map(function ($item) {
                $thangNames = [
                    1 => 'Tháng 1', 2 => 'Tháng 2', 3 => 'Tháng 3', 4 => 'Tháng 4',
                    5 => 'Tháng 5', 6 => 'Tháng 6', 7 => 'Tháng 7', 8 => 'Tháng 8',
                    9 => 'Tháng 9', 10 => 'Tháng 10', 11 => 'Tháng 11', 12 => 'Tháng 12'
                ];

                return [
                    'thang' => $item->thang,
                    'ten_thang' => $thangNames[$item->thang] ?? 'Không xác định',
                    'doanh_thu' => $item->doanh_thu ?? 0,
                    'so_don_hang_thanh_cong' => $item->so_don_hang_thanh_cong ?? 0
                ];
            });

        // Đảm bảo có đủ 12 tháng
        $doanhThuFull = [];
        for ($i = 1; $i <= 12; $i++) {
            $found = $doanhThuTheoThang->firstWhere('thang', $i);
            if ($found) {
                $doanhThuFull[] = $found;
            } else {
                $thangNames = [
                    1 => 'Tháng 1', 2 => 'Tháng 2', 3 => 'Tháng 3', 4 => 'Tháng 4',
                    5 => 'Tháng 5', 6 => 'Tháng 6', 7 => 'Tháng 7', 8 => 'Tháng 8',
                    9 => 'Tháng 9', 10 => 'Tháng 10', 11 => 'Tháng 11', 12 => 'Tháng 12'
                ];
                $doanhThuFull[] = [
                    'thang' => $i,
                    'ten_thang' => $thangNames[$i] ?? 'Không xác định',
                    'doanh_thu' => 0,
                    'so_don_hang_thanh_cong' => 0
                ];
            }
        }

        // ==================== TOP QUÁN ĂN THEO DOANH THU ====================
        $topQuanAn = DB::table('quan_ans as qa')
            ->leftJoin('don_hangs as dh', 'qa.id', '=', 'dh.id_quan_an')
            ->select(
                'qa.id',
                'qa.ten_quan_an',
                'qa.hinh_anh',
                'qa.dia_chi',
                DB::raw('COUNT(dh.id) as tong_don_hang'),
                DB::raw('COUNT(CASE WHEN dh.is_thanh_toan = 1 THEN 1 END) as don_hang_thanh_cong'),
                DB::raw('SUM(CASE WHEN dh.is_thanh_toan = 1 THEN dh.tong_tien ELSE 0 END) as tong_doanh_thu'),
                DB::raw('CASE
                    WHEN COUNT(CASE WHEN dh.is_thanh_toan = 1 THEN 1 END) > 0
                    THEN SUM(CASE WHEN dh.is_thanh_toan = 1 THEN dh.tong_tien ELSE 0 END) / COUNT(CASE WHEN dh.is_thanh_toan = 1 THEN 1 END)
                    ELSE 0
                END as doanh_thu_trung_binh')
            )
            ->groupBy('qa.id', 'qa.ten_quan_an', 'qa.hinh_anh', 'qa.dia_chi')
            ->orderBy('tong_doanh_thu', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'ten_quan_an' => $item->ten_quan_an,
                    'hinh_anh' => $item->hinh_anh ?: '/images/default-restaurant.jpg',
                    'dia_chi' => $item->dia_chi ?: 'Chưa cập nhật',
                    'tong_don_hang' => $item->tong_don_hang ?? 0,
                    'don_hang_thanh_cong' => $item->don_hang_thanh_cong ?? 0,
                    'tong_doanh_thu' => $item->tong_doanh_thu ?? 0,
                    'doanh_thu_trung_binh' => $item->doanh_thu_trung_binh ?? 0
                ];
            });

        // ==================== THỐNG KÊ ĐƠN HÀNG THEO TRẠNG THÁI ====================
        $donHangTheoTrangThai = DB::table('don_hangs')
            ->select(
                'tinh_trang',
                DB::raw('COUNT(*) as so_luong'),
                DB::raw('SUM(CASE WHEN is_thanh_toan = 1 THEN tong_tien ELSE 0 END) as tong_tien')
            )
            ->groupBy('tinh_trang')
            ->get()
            ->map(function ($item) {
                $trangThai = [
                    1 => 'Chờ xác nhận',
                    2 => 'Đã xác nhận',
                    3 => 'Đang giao',
                    4 => 'Đã giao',
                    5 => 'Đã hủy'
                ];

                return [
                    'trang_thai' => $item->tinh_trang,
                    'ten_trang_thai' => $trangThai[$item->tinh_trang] ?? 'Không xác định',
                    'so_luong' => $item->so_luong ?? 0,
                    'tong_tien' => $item->tong_tien ?? 0
                ];
            });

        // Đảm bảo có đủ tất cả trạng thái
        $trangThaiFull = [];
        for ($i = 1; $i <= 5; $i++) {
            $found = $donHangTheoTrangThai->firstWhere('trang_thai', $i);
            if ($found) {
                $trangThaiFull[] = $found;
            } else {
                $trangThai = [
                    1 => 'Chờ xác nhận',
                    2 => 'Đã xác nhận',
                    3 => 'Đang giao',
                    4 => 'Đã giao',
                    5 => 'Đã hủy'
                ];
                $trangThaiFull[] = [
                    'trang_thai' => $i,
                    'ten_trang_thai' => $trangThai[$i] ?? 'Không xác định',
                    'so_luong' => 0,
                    'tong_tien' => 0
                ];
            }
        }

        // ==================== TỔNG HỢP DỮ LIỆU ====================
        $tongQuan = [
            'tong_quan_an' => $tongQuanAn,
            'tong_mon_an' => $tongMonAn,
            'tong_khach_hang' => $tongKhachHang,
            'tong_don_hang' => $tongDonHang,
            'tong_doanh_thu' => $tongDoanhThu ?? 0,
            'doanh_thu_hom_nay' => $doanhThuHomNay ?? 0,
            'doanh_thu_tuan_nay' => $doanhThuTuanNay ?? 0,
            'doanh_thu_thang_nay' => $doanhThuThangNay ?? 0
        ];

        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu dashboard thành công',
            'data' => [
                'tong_quan' => $tongQuan,
                'doanh_thu_theo_thang' => $doanhThuFull,
                'top_quan_an' => $topQuanAn,
                'don_hang_theo_trang_thai' => $trangThaiFull
            ]
        ]);
    }
}
