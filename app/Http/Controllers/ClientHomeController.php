<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\MonAn;
use App\Models\QuanAn;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientHomeController extends Controller
{
    public function getDataHome()
    {
        $mon_an = MonAn::where('mon_ans.tinh_trang', 1)
            ->where('mon_ans.gia_khuyen_mai', '>', 0)
            ->join('quan_ans', 'quan_ans.id', 'mon_ans.id_quan_an')
            ->select('mon_ans.*', 'quan_ans.ten_quan_an')
            ->orderBy('mon_ans.gia_khuyen_mai')
            ->get();

        $quan_an_yeu_thich = QuanAn::where('quan_ans.tinh_trang', 1)
            ->where('quan_ans.is_active', 1)
            ->select('quan_ans.id', 'quan_ans.ten_quan_an', 'quan_ans.hinh_anh', 'quan_ans.dia_chi')
            ->get();

        $voucher = Voucher::where('vouchers.tinh_trang', 1)
            ->where('vouchers.thoi_gian_ket_thuc', '>=', now())
            ->join('quan_ans', 'quan_ans.id', 'vouchers.id_quan_an')
            ->select('vouchers.*', 'quan_ans.ten_quan_an')
            ->get();

        $phan_loai = DanhMuc::where('danh_mucs.tinh_trang', 1)
            ->join('mon_ans', 'mon_ans.id_danh_muc', 'danh_mucs.id')
            ->where('mon_ans.tinh_trang', 1)
            ->select('danh_mucs.*')
            ->distinct()
            ->get();

        $quan_an_sale = QuanAn::leftjoin('mon_ans', 'mon_ans.id_quan_an', 'quan_ans.id')
            ->where('quan_ans.tinh_trang', 1)
            ->where('quan_ans.is_active', 1)
            ->where('mon_ans.tinh_trang', 1) // Thêm điều kiện món ăn đang hoạt động
            ->select(
                'quan_ans.id',
                'quan_ans.ten_quan_an',
                'quan_ans.hinh_anh',
                'quan_ans.dia_chi',
                'mon_ans.id as mon_an_id',
                'mon_ans.ten_mon_an',
                'mon_ans.gia_ban',
                'mon_ans.gia_khuyen_mai'
            )
            ->inRandomOrder()
            ->get();
        return response()->json([
            'mon_an'                => $mon_an,
            'voucher'               => $voucher,
            'quan_an_yeu_thich'     => $quan_an_yeu_thich,
            'phan_loai'             => $phan_loai,
            'quan_an_sale'     => $quan_an_sale,

        ]);
    }

    public function getDataQuanAn()
    {
        $quan_an_yeu_thich = QuanAn::leftJoin('don_hangs', 'don_hangs.id_quan_an', 'quan_ans.id')
            ->leftjoin('mon_ans', 'mon_ans.id_quan_an', 'quan_ans.id')
            ->select(
                'quan_ans.id',
                'quan_ans.ten_quan_an',
                'quan_ans.hinh_anh',
                'quan_ans.dia_chi',
                DB::raw('MIN(CASE WHEN mon_ans.gia_khuyen_mai > 0 THEN mon_ans.gia_khuyen_mai ELSE mon_ans.gia_ban END) as gia_min'),
                DB::raw('MAX(CASE WHEN mon_ans.gia_khuyen_mai > 0 THEN mon_ans.gia_khuyen_mai ELSE mon_ans.gia_ban END) as gia_max')
            )
            ->groupBy('quan_ans.id', 'quan_ans.ten_quan_an', 'quan_ans.hinh_anh', 'quan_ans.dia_chi') // Cần groupBy khi dùng aggregate
            ->get();


        return response()->json([
            'quan_an_yeu_thich'     => $quan_an_yeu_thich,
        ]);
    }
    public function timKiemGoiY(Request $request)
    {
        try {
            $keyword = $request->input('keyword', '');
            // Validate keyword
            if (strlen($keyword) < 2) {
                return response()->json([
                    'status' => false,
                    'message' => 'Từ khóa phải có ít nhất 2 ký tự',
                    'mon_an' => [],
                    'quan_an' => []
                ]);
            }

            // Tìm kiếm món ăn với sắp xếp theo độ liên quan
            $monAn = MonAn::where('mon_ans.tinh_trang', 1)
                ->join('quan_ans', 'quan_ans.id', 'mon_ans.id_quan_an')
                ->where('quan_ans.tinh_trang', 1)
                ->where('quan_ans.is_active', 1)
                ->where(function ($query) use ($keyword) {
                    $query->where('mon_ans.ten_mon_an', 'like', '%' . $keyword . '%');
                })
                ->select(
                    'mon_ans.id',
                    'mon_ans.ten_mon_an',
                    'mon_ans.gia_ban',
                    'mon_ans.gia_khuyen_mai',
                    'mon_ans.hinh_anh',
                    'mon_ans.id_quan_an',
                    'quan_ans.ten_quan_an',
                    // Sắp xếp theo độ liên quan: khớp chính xác > bắt đầu bằng > chứa
                    DB::raw("CASE
                        WHEN LOWER(mon_ans.ten_mon_an) = LOWER('{$keyword}') THEN 1
                        WHEN LOWER(mon_ans.ten_mon_an) LIKE LOWER('{$keyword}%') THEN 2
                        ELSE 3
                    END as relevance")
                )
                ->orderBy('relevance', 'asc')
                ->orderBy('mon_ans.ten_mon_an', 'asc')
                ->get();

            // Tìm kiếm quán ăn với sắp xếp theo độ liên quan
            $quanAn = QuanAn::where('tinh_trang', 1)
                ->where('is_active', 1)
                ->where(function ($query) use ($keyword) {
                    $query->where('ten_quan_an', 'like', '%' . $keyword . '%')
                          ->orWhere('dia_chi', 'like', '%' . $keyword . '%');
                })
                ->select(
                    'id',
                    'ten_quan_an',
                    'hinh_anh',
                    'dia_chi',
                    // Sắp xếp theo độ liên quan
                    DB::raw("CASE
                        WHEN LOWER(ten_quan_an) = LOWER('{$keyword}') THEN 1
                        WHEN LOWER(ten_quan_an) LIKE LOWER('{$keyword}%') THEN 2
                        WHEN LOWER(dia_chi) LIKE LOWER('%{$keyword}%') THEN 4
                        ELSE 3
                    END as relevance")
                )
                ->orderBy('relevance', 'asc')
                ->orderBy('ten_quan_an', 'asc')
                ->get();
            return response()->json([
                'status' => true,
                'mon_an' => $monAn,
                'quan_an' => $quanAn
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage(),
                'mon_an' => [],
                'quan_an' => []
            ], 500);
        }
    }
}
