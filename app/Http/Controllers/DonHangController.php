<?php

namespace App\Http\Controllers;

use App\Events\DonHangDaNhanEvent;
use App\Events\DonHangDaXongEvent;
use App\Events\DonHangHoanThanhEvent;
use App\Http\Requests\HuyDonHangRequest;
use App\Http\Requests\ShipperNhanDonHangRequest;
use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DonHangController extends Controller
{
    public function getDonHangKhachHang()
    {
        try {
            $user = Auth::guard('sanctum')->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $data = DonHang::where('don_hangs.id_khach_hang', $user->id)
                ->join('quan_ans', 'quan_ans.id', 'don_hangs.id_quan_an')
                ->leftJoin('shippers', 'shippers.id', 'don_hangs.id_shipper')
                ->join('dia_chis', 'dia_chis.id', 'don_hangs.id_dia_chi_nhan')
                ->leftJoin('chi_tiet_don_hangs', 'chi_tiet_don_hangs.id_don_hang', 'don_hangs.id')
                ->leftJoin('mon_ans', 'mon_ans.id', 'chi_tiet_don_hangs.id_mon_an')
                ->select(
                    'don_hangs.id',
                    'don_hangs.ma_don_hang',
                    'don_hangs.created_at',
                    'don_hangs.updated_at',
                    'don_hangs.tien_hang',
                    'don_hangs.phi_ship',
                    'don_hangs.tong_tien',
                    'don_hangs.is_thanh_toan',
                    'don_hangs.tinh_trang',
                    'don_hangs.phuong_thuc_thanh_toan',
                    'quan_ans.ten_quan_an',
                    'quan_ans.hinh_anh as hinh_anh_quan',
                    'quan_ans.dia_chi as dia_chi_quan',
                    'shippers.ho_va_ten as ho_va_ten_shipper',
                    'shippers.so_dien_thoai as sdt_shipper',
                    'dia_chis.dia_chi',
                    'dia_chis.ten_nguoi_nhan',
                    'dia_chis.so_dien_thoai',
                    DB::raw('GROUP_CONCAT(DISTINCT mon_ans.hinh_anh ORDER BY mon_ans.id LIMIT 1) as hinh_anh_mon_an'),
                    DB::raw('COUNT(DISTINCT chi_tiet_don_hangs.id) as so_mon')
                )
                ->groupBy(
                    'don_hangs.id',
                    'don_hangs.ma_don_hang',
                    'don_hangs.created_at',
                    'don_hangs.updated_at',
                    'don_hangs.tien_hang',
                    'don_hangs.phi_ship',
                    'don_hangs.tong_tien',
                    'don_hangs.is_thanh_toan',
                    'don_hangs.tinh_trang',
                    'don_hangs.phuong_thuc_thanh_toan',
                    'quan_ans.id',
                    'quan_ans.ten_quan_an',
                    'quan_ans.hinh_anh',
                    'quan_ans.dia_chi',
                    'shippers.id',
                    'shippers.ho_va_ten',
                    'shippers.so_dien_thoai',
                    'dia_chis.id',
                    'dia_chis.dia_chi',
                    'dia_chis.ten_nguoi_nhan',
                    'dia_chis.so_dien_thoai'
                )
                ->orderBy('don_hangs.created_at', 'desc')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            Log::error('getDonHangKhachHang Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách đơn hàng: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getChiTietDonHangKhachHang(Request $request)
    {
        try {
            $user = Auth::guard('sanctum')->user();

            // Validate request
            if (!$request->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vui lòng cung cấp ID đơn hàng'
                ], 400);
            }

            // Lấy thông tin tổng quát đơn hàng
            $donHang = DonHang::where('don_hangs.id', $request->id)
                ->where('don_hangs.id_khach_hang', $user->id) // Đảm bảo đơn hàng thuộc về khách hàng này
                ->leftJoin('quan_ans', 'quan_ans.id', 'don_hangs.id_quan_an')
                ->leftJoin('shippers', 'shippers.id', 'don_hangs.id_shipper')
                ->leftJoin('dia_chis', 'dia_chis.id', 'don_hangs.id_dia_chi_nhan')
                ->leftJoin('vouchers', 'vouchers.id', 'don_hangs.id_voucher')
                ->select(
                    'don_hangs.*',
                    'quan_ans.ten_quan_an',
                    'quan_ans.hinh_anh as hinh_anh_quan',
                    'quan_ans.dia_chi as dia_chi_quan',
                    'quan_ans.so_dien_thoai as sdt_quan',
                    'shippers.ho_va_ten as ho_va_ten_shipper',
                    'shippers.so_dien_thoai as sdt_shipper',
                    'shippers.hinh_anh as hinh_anh_shipper',
                    'dia_chis.dia_chi',
                    'dia_chis.ten_nguoi_nhan',
                    'dia_chis.so_dien_thoai as sdt_nguoi_nhan',
                    'vouchers.ma_code',
                    'vouchers.ten_voucher',
                    'vouchers.loai_giam',
                    'vouchers.so_giam_gia',
                    'vouchers.so_tien_toi_da'
                )
                ->first();

            if (!$donHang) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
            }

            // Lấy thông tin chi tiết các món ăn
            $chiTietMonAn = ChiTietDonHang::where('chi_tiet_don_hangs.id_don_hang', $request->id)
                ->join('mon_ans', 'mon_ans.id', 'chi_tiet_don_hangs.id_mon_an')
                ->select(
                    'chi_tiet_don_hangs.id',
                    'mon_ans.id as id_mon_an',
                    'mon_ans.ten_mon_an',
                    'mon_ans.hinh_anh',
                    'chi_tiet_don_hangs.so_luong',
                    'chi_tiet_don_hangs.don_gia',
                    'chi_tiet_don_hangs.thanh_tien',
                    'chi_tiet_don_hangs.ghi_chu'
                )
                ->orderBy('chi_tiet_don_hangs.id', 'asc')
                ->get();

            return response()->json([
                'status' => true,
                'don_hang' => $donHang,
                'chi_tiet_mon_an' => $chiTietMonAn,
                'tong_so_mon' => $chiTietMonAn->count()
            ]);
        } catch (\Exception $e) {
            Log::error('getChiTietDonHangKhachHang Error: ' . $e->getMessage(), [
                'don_hang_id' => $request->id ?? null,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy chi tiết đơn hàng: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getDonHangQuanAn()
    {
        $user = Auth::guard('sanctum')->user();

        $data = DonHang::where('don_hangs.id_quan_an', $user->id)
            ->where('tinh_trang', '>=', 1)
            ->join('khach_hangs', 'khach_hangs.id', 'don_hangs.id_khach_hang')
            ->join('shippers', 'shippers.id', 'don_hangs.id_shipper')
            ->select(
                'don_hangs.id',
                'don_hangs.created_at',
                'don_hangs.ma_don_hang',
                'don_hangs.tien_hang',
                'don_hangs.tinh_trang',
                'don_hangs.ten_nguoi_nhan',
                'shippers.ho_va_ten as ho_va_ten_shipper',
            )
            ->orderBy('don_hangs.created_at', 'desc')
            ->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function daXongDonHang(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $donHang = DonHang::where('id', $request->id)
            ->where('id_quan_an', $user->id)
            ->where('tinh_trang', 1)
            ->first();

        if ($donHang) {
            $donHang->update([
                'tinh_trang' => 2,
            ]);

            // Trigger Broadcasting Event: Thông báo quán ăn đã làm xong đơn
            try {
                event(new DonHangDaXongEvent($donHang));
            } catch (\Exception $e) {
                Log::warning('Broadcasting event failed: ' . $e->getMessage(), [
                    'don_hang_id' => $donHang->id
                ]);
            }
        }

        return response()->json([
            'status'    =>  1,
            'message'   =>  'Đã hoàn thành đơn hàng!!',
        ]);
    }

    public function chiTietDonHangQuanAn(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $data = ChiTietDonHang::join('don_hangs', 'don_hangs.id', 'chi_tiet_don_hangs.id_don_hang')
            ->join('mon_ans', 'mon_ans.id', 'chi_tiet_don_hangs.id_mon_an')
            ->where('chi_tiet_don_hangs.id_don_hang', $request->id)
            ->where('don_hangs.id_quan_an', $user->id)
            ->select(
                'mon_ans.ten_mon_an',
                'chi_tiet_don_hangs.so_luong',
                'chi_tiet_don_hangs.don_gia',
                'chi_tiet_don_hangs.thanh_tien',
                'chi_tiet_don_hangs.ghi_chu',
            )
            ->get();
        return response()->json([
            'status'    =>  1,
            'data'      =>  $data,
        ]);
    }

    public function getDonHangShipper()
    {
        $list_don_hang_co_the_nhan = DonHang::where('don_hangs.id_shipper', 0)
            ->where('don_hangs.tinh_trang', 0)
            ->join('quan_ans', 'quan_ans.id', 'don_hangs.id_quan_an')
            ->join('khach_hangs', 'khach_hangs.id', 'don_hangs.id_khach_hang')
            ->join('dia_chis', 'dia_chis.id', 'don_hangs.id_dia_chi_nhan')
            ->select(
                'don_hangs.id',
                'don_hangs.ma_don_hang',
                'quan_ans.ten_quan_an',
                'quan_ans.hinh_anh',
                'quan_ans.dia_chi as dia_chi_quan',
                'don_hangs.ten_nguoi_nhan',
                'khach_hangs.avatar',
                'dia_chis.dia_chi as dia_chi_khach',
                'don_hangs.tong_tien',
                'don_hangs.phi_ship',
                'don_hangs.created_at',
                DB::raw('DATE_FORMAT(don_hangs.created_at, "%H:%i") as gio_tao_don')
            )
            ->orderBy('don_hangs.created_at', 'desc')
            ->get();
        return response()->json([
            'list_don_hang_co_the_nhan' => $list_don_hang_co_the_nhan,
        ]);
    }

    public function getDonHangShipperDangGiao()
    {
        $user = Auth::guard('sanctum')->user();
        $list_don_hang_co_the_nhan = DonHang::where('don_hangs.id_shipper', $user->id)
            ->whereIn('don_hangs.tinh_trang', [1, 2])
            ->join('quan_ans', 'quan_ans.id', 'don_hangs.id_quan_an')
            ->join('khach_hangs', 'khach_hangs.id', 'don_hangs.id_khach_hang')
            ->join('dia_chis', 'dia_chis.id', 'don_hangs.id_dia_chi_nhan')
            ->select(
                'don_hangs.id',
                'don_hangs.ma_don_hang',
                'quan_ans.ten_quan_an',
                'quan_ans.hinh_anh',
                'quan_ans.dia_chi as dia_chi_quan',
                'don_hangs.ten_nguoi_nhan',
                'khach_hangs.avatar',
                'dia_chis.dia_chi as dia_chi_khach',
                'don_hangs.tong_tien',
                'don_hangs.phi_ship',
                'don_hangs.tinh_trang',
                'don_hangs.created_at',
            )
            ->orderBy('don_hangs.created_at', 'desc')
            ->get();
        $list_don_hang_hoan_thanh = DonHang::where('don_hangs.id_shipper', $user->id)
            ->whereIn('don_hangs.tinh_trang', [3, 4])
            ->join('quan_ans', 'quan_ans.id', 'don_hangs.id_quan_an')
            ->join('khach_hangs', 'khach_hangs.id', 'don_hangs.id_khach_hang')
            ->join('dia_chis', 'dia_chis.id', 'don_hangs.id_dia_chi_nhan')
            ->select(
                'don_hangs.id',
                'don_hangs.ma_don_hang',
                'quan_ans.ten_quan_an',
                'quan_ans.hinh_anh',
                'quan_ans.dia_chi as dia_chi_quan',
                'don_hangs.ten_nguoi_nhan',
                'khach_hangs.avatar',
                'dia_chis.dia_chi as dia_chi_khach',
                'don_hangs.tong_tien',
                'don_hangs.phi_ship',
                'don_hangs.tinh_trang',
                'don_hangs.created_at',
            )
            ->get();

        return response()->json([
            'data'                      => $list_don_hang_co_the_nhan,
            'list_don_hang_hoan_thanh'  => $list_don_hang_hoan_thanh,
        ]);
    }

    public function hoanThanhDonHangShipper(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $donHang = DonHang::where('id', $request->id)
            ->where('id_shipper', $user->id)
            ->where('tinh_trang', 2)
            ->where('is_thanh_toan', 0)
            ->first();

        if ($donHang) {
            $donHang->update([
                'is_thanh_toan' => 1,
                'tinh_trang' => 3,
            ]);

            // Trigger Broadcasting Event: Thông báo shipper đã giao xong đơn
            try {
                event(new DonHangHoanThanhEvent($donHang));
            } catch (\Exception $e) {
                Log::warning('Broadcasting event failed: ' . $e->getMessage(), [
                    'don_hang_id' => $donHang->id
                ]);
            }
        }

        return response()->json([
            'status'    =>  1,
            'message'   =>  'Đã hoàn thành đơn hàng!!',
        ]);
    }

    public function nhanDonDonHangShipper(ShipperNhanDonHangRequest $request)
    {
        $user = Auth::guard('sanctum')->user();

        $check = DonHang::where('id', $request->id)
            ->where('id_shipper', 0)
            ->first();
        if ($check) {
            $check->update([
                'id_shipper' => $user->id,
                'tinh_trang' => 1,
            ]);

            // Trigger Broadcasting Event: Thông báo shipper đã nhận đơn
            try {
                event(new DonHangDaNhanEvent($check));
            } catch (\Exception $e) {
                Log::warning('Broadcasting event failed: ' . $e->getMessage(), [
                    'don_hang_id' => $check->id
                ]);
            }

            return response()->json([
                'status'    => 1,
                'message'   => "Bạn đã nhận đơn hàng thành công!!",
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => "Đơn hàng này đã có người nhận!!",
            ]);
        }
    }

    public function getDonHangAdmin()
    {
        $data = DonHang::join('quan_ans', 'quan_ans.id', 'don_hangs.id_quan_an')
            ->join('khach_hangs', 'khach_hangs.id', 'don_hangs.id_khach_hang')
            ->leftjoin('shippers', 'shippers.id', 'don_hangs.id_shipper')
            ->select(
                'don_hangs.*',
                'quan_ans.ten_quan_an',
                'khach_hangs.ho_va_ten as ho_va_ten_khach_hang',
                'shippers.ho_va_ten as ho_va_ten_shipper',
            )
            ->orderBy('don_hangs.created_at', 'desc')
            ->get();

        return response()->json([
            'data'   => $data,
        ]);
    }

    public function getChiTietDonHangAdmin(Request $request)
    {
        $data = ChiTietDonHang::where('chi_tiet_don_hangs.id_don_hang', $request->id)
            ->join('mon_ans', 'mon_ans.id', 'chi_tiet_don_hangs.id_mon_an')
            ->select(
                'mon_ans.ten_mon_an',
                'chi_tiet_don_hangs.so_luong',
                'chi_tiet_don_hangs.don_gia',
                'chi_tiet_don_hangs.thanh_tien',
                'chi_tiet_don_hangs.ghi_chu',
            )
            ->get();
        return response()->json([
            'data'  => $data
        ]);
    }

    public function huyDonHangAdmin(HuyDonHangRequest $request)
    {
        DonHang::where('id', $request->id)->update([
            'tinh_trang'    => 4

        ]);
        return response()->json([
            'status'    => 1,
            'message'   => "Đã hủy đơn hàng thành công!!",
        ]);
    }
}
