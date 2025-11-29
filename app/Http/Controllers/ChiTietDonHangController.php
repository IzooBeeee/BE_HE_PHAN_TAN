<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteGioHangRequest;
use App\Http\Requests\ThemGioHangRequest;
use App\Http\Requests\TinhPhiShipRequest;
use App\Http\Requests\UpdateGioHangRequest;
use App\Events\DonHangMoiEvent;
use App\Jobs\SendMailJob;
use App\Mail\MasterMail;
use App\Models\ChiTietDonHang;
use App\Models\DiaChi;
use App\Models\DonHang;
use App\Models\MonAn;
use App\Models\QuanAn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class ChiTietDonHangController extends Controller
{
    public function getDonDatHang($id_quan_an)
    {
        $khachHang = Auth::guard('sanctum')->user();
        $quan_an     =   QuanAn::where('quan_ans.id', $id_quan_an) // quán đang lấy
            ->where('quan_ans.tinh_trang', 1)  // Quán đang hoạt động
            ->where('quan_ans.is_active', 1)   // Quán đã được kích hoạt
            ->first();

        $mon_an     =   MonAn::where('mon_ans.id_quan_an', $id_quan_an)
            ->where('mon_ans.tinh_trang', 1)  // Món ăn đang bán
            ->get();

        $gio_hang     =   ChiTietDonHang::where('id_don_hang', 0)
            ->where('id_khach_hang', $khachHang->id)
            ->where('chi_tiet_don_hangs.id_quan_an', $id_quan_an)
            ->join('mon_ans', 'mon_ans.id', '=', 'chi_tiet_don_hangs.id_mon_an')
            ->select('chi_tiet_don_hangs.*', 'mon_ans.ten_mon_an')
            ->get();

        $dia_chi_khach = DiaChi::where('id_khach_hang', $khachHang->id)->get();

        if ($quan_an) {
            return response()->json([
                'quan_an'       =>  $quan_an,
                'mon_an'        =>  $mon_an,
                'gio_hang'      =>  $gio_hang,
                'dia_chi_khach' =>  $dia_chi_khach,
                'tong_tien'     =>  $gio_hang->sum('thanh_tien'),
                'status'        =>  true
            ]);
        } else {
            return response()->json([
                'status'    =>  false
            ]);
        }
    }

    public function tinhPhiShip(TinhPhiShipRequest $request)
    {
        $link_get = 'https://api.openrouteservice.org/geocode/search';
        $dia_chi_quan  = QuanAn::where('id', $request->id_quan_an)->first();
        $dia_chi_khach = DiaChi::where('id', $request->id_dia_chi_khach)->first();

        $client        = new Client();

        // Lấy tọa độ quán
        $response_quan      = $client->request('GET', $link_get, [
            'headers' => [
                'User-Agent' => 'MyApp/1.0',
                'Accept'     => 'application/json',
            ],
            'query' => [
                'api_key' => '5b3ce3597851110001cf62484c960a399b1d44f4829554f302e513b8',
                'text'    => $dia_chi_quan->dia_chi,
                'size'    => 1
            ]
        ]);

        // return ($dia_chi_quan->dia_chi);
        $body = $response_quan->getBody()->getContents();
        $response_quan = json_decode($body, true);
        $toa_do_quan   = $response_quan['features'][0]['geometry']['coordinates'];

        // Lấy tọa độ khách
        $response_khach      = $client->request('GET', $link_get, [
            'headers' => [
                'User-Agent' => 'MyApp/1.0',
                'Accept'     => 'application/json',
            ],
            'query' => [
                'api_key' => '5b3ce3597851110001cf62484c960a399b1d44f4829554f302e513b8',
                'text'    => $dia_chi_khach->dia_chi,
                'size'    => 1
            ]
        ]);
        $body = $response_khach->getBody()->getContents();
        $response_khach = json_decode($body, true);
        $toa_do_khach   = $response_khach['features'][0]['geometry']['coordinates'];

        $link_directions = 'https://api.openrouteservice.org/v2/directions/driving-car';
        // Tính khoảng cách
        $response_distance = $client->request('POST', $link_directions, [
            'headers' => [
                'Authorization' => '5b3ce3597851110001cf62484c960a399b1d44f4829554f302e513b8', // API Key
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
            'json' => [
                'coordinates' => [
                    $toa_do_quan,  // Tọa độ quán
                    $toa_do_khach  // Tọa độ khách
                ],
                'units' => 'km' // Đơn vị khoảng cách: kilômét
            ]
        ]);

        $body               = $response_distance->getBody()->getContents();
        $response_distance  = json_decode($body, true);
        try {
            if (!empty($response_distance['routes'][0]['summary']['distance'])) {
                $khoang_cach_km = $response_distance['routes'][0]['summary']['distance'];

                if ($khoang_cach_km <= 30) {
                    $phi_ship = round($khoang_cach_km * 15, -3); // làm tròn nghìn
                } else {
                    $phi_ship = 50000;
                }
            } else {
                $phi_ship = 50000;
            }
        } catch (\Exception $e) {
            $phi_ship = 50000;
        }

        return response()->json([
            'status'        => true,
            'phi_ship'      => $phi_ship
        ]);
    }

    public function themGioHang(ThemGioHangRequest $request)
    {
        $khachHang = Auth::guard('sanctum')->user();
        $monAn     = MonAn::where('id', $request->id)->first();
        $check     = ChiTietDonHang::where('id_khach_hang', $khachHang->id)
            ->where('id_mon_an', $request->id)
            ->where('id_don_hang', 0) // Chưa có đơn hàng
            ->first();
        if ($check) {
            $check->so_luong += 1;
            $check->thanh_tien = $check->don_gia * $check->so_luong;
            $check->save();

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Cập nhật số lượng món ăn thành công'
            ]);
        } else {
            ChiTietDonHang::create([
                'id_mon_an'     =>  $request->id,
                'id_quan_an'    =>  $monAn->id_quan_an,
                'don_gia'       =>  $monAn->gia_khuyen_mai,
                'so_luong'      =>  1,
                'thanh_tien'    =>  $monAn->gia_khuyen_mai,
                'id_khach_hang' =>  $khachHang->id,
            ]);

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Thêm món ăn vào giỏ hàng thành công'
            ]);
        }
    }

    public function updateGioHang(UpdateGioHangRequest $request)
    {
        $khachHang  = Auth::guard('sanctum')->user();
        $mon_an     =   MonAn::where('id', $request->id_mon_an)
            ->where('mon_ans.tinh_trang', 1)
            ->first();
        if (!$mon_an) {
            return response()->json([
                'status'    => 0,
                'message'   => "Món ăn không tồn tại hoặc đã nhưng bán!!!!"
            ]);
        } else {
            ChiTietDonHang::where('id', $request->id)->update([
                'don_gia'       => $mon_an->gia_khuyen_mai > 0 ? $mon_an->gia_khuyen_mai : $mon_an->gia_ban,
                'so_luong'      => $request->so_luong,
                'thanh_tien'    => $request->so_luong * ($mon_an->gia_khuyen_mai > 0 ? $mon_an->gia_khuyen_mai : $mon_an->gia_ban),
                'ghi_chu'       => $request->ghi_chu,
            ]);

            return response()->json([
                'status'    => 1,
                'message'   => "Cập nhật giỏ hàng thành công!!"
            ]);
        }
    }

    public function deleteGioHang(DeleteGioHangRequest $request)
    {
        ChiTietDonHang::where('id', $request->all())->delete();
        return response()->json([
            'status'    => 1,
            'message'   => "Đã hủy món " . $request->ten_mon_an . " thành công!!",
        ]);
    }

    public function xacNhanDatHangChuyenKhoan($id_quan_an, $id_dia_chi_khach)
    {
        try {
            $khachHang  = Auth::guard('sanctum')->user();

            // Validate: Kiểm tra giỏ hàng
            $gio_hang     =   ChiTietDonHang::where('id_don_hang', 0)
                ->where('id_khach_hang', $khachHang->id)
                ->where('chi_tiet_don_hangs.id_quan_an', $id_quan_an)
                ->join('mon_ans', 'mon_ans.id', '=', 'chi_tiet_don_hangs.id_mon_an')
                ->select('chi_tiet_don_hangs.*', 'mon_ans.ten_mon_an')
                ->get();

            if ($gio_hang->isEmpty()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Giỏ hàng trống. Vui lòng thêm món ăn trước khi đặt hàng.'
                ], 400);
            }

            // Validate: Kiểm tra địa chỉ quán ăn
            $dia_chi_quan  = QuanAn::where('id', $id_quan_an)->first();
            if (!$dia_chi_quan) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Không tìm thấy thông tin quán ăn.'
                ], 404);
            }

            // Validate: Kiểm tra địa chỉ khách hàng
            $dia_chi_khach = DiaChi::where('id', $id_dia_chi_khach)
                ->where('id_khach_hang', $khachHang->id)
                ->first();
            if (!$dia_chi_khach) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Không tìm thấy địa chỉ giao hàng.'
                ], 404);
            }

            $link_get = 'https://api.openrouteservice.org/geocode/search';
            $client   = new Client();
            $phi_ship = 50000; // Default phi ship

            // Lấy tọa độ quán
            try {
                $response_quan = $client->request('GET', $link_get, [
                    'headers' => [
                        'User-Agent' => 'MyApp/1.0',
                        'Accept'     => 'application/json',
                    ],
                    'query' => [
                        'api_key' => '5b3ce3597851110001cf62484c960a399b1d44f4829554f302e513b8',
                        'text'    => $dia_chi_quan->dia_chi,
                        'size'    => 1
                    ]
                ]);

                $body = $response_quan->getBody()->getContents();
                $response_quan_data = json_decode($body, true);

                if (empty($response_quan_data['features'][0]['geometry']['coordinates'])) {
                    throw new \Exception('Không tìm thấy tọa độ quán ăn');
                }
                $toa_do_quan = $response_quan_data['features'][0]['geometry']['coordinates'];

                // Lấy tọa độ khách
                $response_khach = $client->request('GET', $link_get, [
                    'headers' => [
                        'User-Agent' => 'MyApp/1.0',
                        'Accept'     => 'application/json',
                    ],
                    'query' => [
                        'api_key' => '5b3ce3597851110001cf62484c960a399b1d44f4829554f302e513b8',
                        'text'    => $dia_chi_khach->dia_chi,
                        'size'    => 1
                    ]
                ]);

                $body = $response_khach->getBody()->getContents();
                $response_khach_data = json_decode($body, true);

                if (empty($response_khach_data['features'][0]['geometry']['coordinates'])) {
                    throw new \Exception('Không tìm thấy tọa độ địa chỉ giao hàng');
                }
                $toa_do_khach = $response_khach_data['features'][0]['geometry']['coordinates'];

                // Tính khoảng cách
                $link_directions = 'https://api.openrouteservice.org/v2/directions/driving-car';
                $response_distance = $client->request('POST', $link_directions, [
                    'headers' => [
                        'Authorization' => '5b3ce3597851110001cf62484c960a399b1d44f4829554f302e513b8',
                        'Content-Type'  => 'application/json',
                        'Accept'        => 'application/json',
                    ],
                    'json' => [
                        'coordinates' => [
                            $toa_do_quan,
                            $toa_do_khach
                        ],
                        'units' => 'km'
                    ]
                ]);

                $body = $response_distance->getBody()->getContents();
                $response_distance_data = json_decode($body, true);

                if (!empty($response_distance_data['routes'][0]['summary']['distance'])) {
                    $khoang_cach_km = $response_distance_data['routes'][0]['summary']['distance'];
                    if ($khoang_cach_km <= 30) {
                        $phi_ship = round($khoang_cach_km * 15, -3); // làm tròn nghìn
                    } else {
                        $phi_ship = 50000;
                    }
                }
            } catch (\Exception $e) {
                // Nếu API geocoding fail, sử dụng phí ship mặc định
                Log::warning('Geocoding API failed: ' . $e->getMessage());
                $phi_ship = 50000;
            }

            // Tạo mã đơn hàng unique bằng timestamp + random
            $ma_don_hang_temp = 'DZ' . time() . rand(100, 999);

            $donHang = DonHang::create([
                'ma_don_hang'       =>  $ma_don_hang_temp,
                'id_khach_hang'     =>  $khachHang->id,
                'id_voucher'        =>  0,
                'id_shipper'        =>  0,
                'id_quan_an'        =>  $id_quan_an,
                'phuong_thuc_thanh_toan' =>  DonHang::thanh_toan_chuyen_khoan,
                'id_dia_chi_nhan'   =>  $id_dia_chi_khach,
                'ten_nguoi_nhan'    =>  $dia_chi_khach->ten_nguoi_nhan,
                'so_dien_thoai'     =>  $dia_chi_khach->so_dien_thoai,
                'tien_hang'         =>  $gio_hang->sum('thanh_tien'),
                'phi_ship'          =>  $phi_ship,
                'tong_tien'         =>  $gio_hang->sum('thanh_tien') + $phi_ship,
                'is_thanh_toan'     =>  0,
                'tinh_trang'        =>  0,
            ]);

            // Cập nhật giỏ hàng (id_don_hang = 0) thành đơn hàng thật
            ChiTietDonHang::where('id_don_hang', 0)
                ->where('id_khach_hang', $khachHang->id)
                ->where('chi_tiet_don_hangs.id_quan_an', $id_quan_an)
                ->update([
                    'id_don_hang' => $donHang->id,
                ]);

            // Update lại mã đơn hàng theo ID thật
            $donHang->ma_don_hang = 'DZ' . $donHang->id;
            $donHang->save();

            // Trigger Broadcasting Event: Thông báo đơn hàng mới đến Quán ăn và Shipper
            try {
                event(new DonHangMoiEvent($donHang));
            } catch (\Exception $e) {
                // Nếu broadcasting fail (Pusher timeout), chỉ log warning, không fail request
                Log::warning('Broadcasting event failed: ' . $e->getMessage(), [
                    'don_hang_id' => $donHang->id
                ]);
            }

            // Lấy lại danh sách món ăn trong đơn hàng để trả về cho modal
            $chi_tiet_mon_an = ChiTietDonHang::where('id_don_hang', $donHang->id)
                ->join('mon_ans', 'mon_ans.id', 'chi_tiet_don_hangs.id_mon_an')
                ->select(
                    'chi_tiet_don_hangs.*',
                    'mon_ans.ten_mon_an',
                    'mon_ans.hinh_anh'
                )
                ->get();

            return response()->json([
                'status'            =>  true,
                'message'           =>  'Đã xác nhận đơn hàng thành công!',
                'id_don_hang'       =>  $donHang->id,
                'ma_don_hang'       =>  $donHang->ma_don_hang,
                'tien_hang'         =>  $donHang->tien_hang,
                'phi_ship'          =>  $donHang->phi_ship,
                'tong_tien'         =>  $donHang->tong_tien,
                'chi_tiet_mon_an'   =>  $chi_tiet_mon_an,
                'dia_chi_nhan'      => [
                    'ten_nguoi_nhan'    => $dia_chi_khach->ten_nguoi_nhan,
                    'so_dien_thoai'     => $dia_chi_khach->so_dien_thoai,
                    'dia_chi'           => $dia_chi_khach->dia_chi,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('xacNhanDatHangChuyenKhoan Error: ' . $e->getMessage(), [
                'id_quan_an' => $id_quan_an,
                'id_dia_chi_khach' => $id_dia_chi_khach,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status'    => false,
                'message'   => 'Có lỗi xảy ra khi xác nhận đơn hàng: ' . $e->getMessage()
            ], 500);
        }
    }
    public function xacNhanDatHangTienMat($id_quan_an, $id_dia_chi_khach)
    {
        try {
            $khachHang  = Auth::guard('sanctum')->user();

            // Validate: Kiểm tra giỏ hàng
            $gio_hang     =   ChiTietDonHang::where('id_don_hang', 0)
                ->where('id_khach_hang', $khachHang->id)
                ->where('chi_tiet_don_hangs.id_quan_an', $id_quan_an)
                ->join('mon_ans', 'mon_ans.id', '=', 'chi_tiet_don_hangs.id_mon_an')
                ->select('chi_tiet_don_hangs.*', 'mon_ans.ten_mon_an')
                ->get();

            if ($gio_hang->isEmpty()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Giỏ hàng trống. Vui lòng thêm món ăn trước khi đặt hàng.'
                ], 400);
            }

            // Validate: Kiểm tra địa chỉ quán ăn
            $dia_chi_quan  = QuanAn::where('id', $id_quan_an)->first();
            if (!$dia_chi_quan) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Không tìm thấy thông tin quán ăn.'
                ], 404);
            }

            // Validate: Kiểm tra địa chỉ khách hàng
            $dia_chi_khach = DiaChi::where('id', $id_dia_chi_khach)
                ->where('id_khach_hang', $khachHang->id)
                ->first();
            if (!$dia_chi_khach) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Không tìm thấy địa chỉ giao hàng.'
                ], 404);
            }

            $link_get = 'https://api.openrouteservice.org/geocode/search';
            $client   = new Client();
            $phi_ship = 50000; // Default phi ship

            // Lấy tọa độ quán
            try {
                $response_quan = $client->request('GET', $link_get, [
                    'headers' => [
                        'User-Agent' => 'MyApp/1.0',
                        'Accept'     => 'application/json',
                    ],
                    'query' => [
                        'api_key' => '5b3ce3597851110001cf62484c960a399b1d44f4829554f302e513b8',
                        'text'    => $dia_chi_quan->dia_chi,
                        'size'    => 1
                    ]
                ]);

                $body = $response_quan->getBody()->getContents();
                $response_quan_data = json_decode($body, true);

                if (empty($response_quan_data['features'][0]['geometry']['coordinates'])) {
                    throw new \Exception('Không tìm thấy tọa độ quán ăn');
                }
                $toa_do_quan = $response_quan_data['features'][0]['geometry']['coordinates'];

                // Lấy tọa độ khách
                $response_khach = $client->request('GET', $link_get, [
                    'headers' => [
                        'User-Agent' => 'MyApp/1.0',
                        'Accept'     => 'application/json',
                    ],
                    'query' => [
                        'api_key' => '5b3ce3597851110001cf62484c960a399b1d44f4829554f302e513b8',
                        'text'    => $dia_chi_khach->dia_chi,
                        'size'    => 1
                    ]
                ]);

                $body = $response_khach->getBody()->getContents();
                $response_khach_data = json_decode($body, true);

                if (empty($response_khach_data['features'][0]['geometry']['coordinates'])) {
                    throw new \Exception('Không tìm thấy tọa độ địa chỉ giao hàng');
                }
                $toa_do_khach = $response_khach_data['features'][0]['geometry']['coordinates'];

                // Tính khoảng cách
                $link_directions = 'https://api.openrouteservice.org/v2/directions/driving-car';
                $response_distance = $client->request('POST', $link_directions, [
                    'headers' => [
                        'Authorization' => '5b3ce3597851110001cf62484c960a399b1d44f4829554f302e513b8',
                        'Content-Type'  => 'application/json',
                        'Accept'        => 'application/json',
                    ],
                    'json' => [
                        'coordinates' => [
                            $toa_do_quan,
                            $toa_do_khach
                        ],
                        'units' => 'km'
                    ]
                ]);

                $body = $response_distance->getBody()->getContents();
                $response_distance_data = json_decode($body, true);

                if (!empty($response_distance_data['routes'][0]['summary']['distance'])) {
                    $khoang_cach_km = $response_distance_data['routes'][0]['summary']['distance'];
                    if ($khoang_cach_km <= 30) {
                        $phi_ship = round($khoang_cach_km * 15, -3); // làm tròn nghìn
                    } else {
                        $phi_ship = 50000;
                    }
                }
            } catch (\Exception $e) {
                // Nếu API geocoding fail, sử dụng phí ship mặc định
                Log::warning('Geocoding API failed: ' . $e->getMessage());
                $phi_ship = 50000;
            }

            // Tạo mã đơn hàng unique bằng timestamp + random
            $ma_don_hang_temp = 'DZ' . time() . rand(100, 999);

            $donHang = DonHang::create([
                'ma_don_hang'       =>  $ma_don_hang_temp,
                'id_khach_hang'     =>  $khachHang->id,
                'id_voucher'        =>  0,
                'id_shipper'        =>  0,
                'id_quan_an'        =>  $id_quan_an,
                'phuong_thuc_thanh_toan' =>  DonHang::thanh_toan_tien_mat,
                'id_dia_chi_nhan'   =>  $id_dia_chi_khach,
                'ten_nguoi_nhan'    =>  $dia_chi_khach->ten_nguoi_nhan,
                'so_dien_thoai'     =>  $dia_chi_khach->so_dien_thoai,
                'tien_hang'         =>  $gio_hang->sum('thanh_tien'),
                'phi_ship'          =>  $phi_ship,
                'tong_tien'         =>  $gio_hang->sum('thanh_tien') + $phi_ship,
                'is_thanh_toan'     =>  0,
                'tinh_trang'        =>  0,
            ]);

            // Cập nhật giỏ hàng (id_don_hang = 0) thành đơn hàng thật
            ChiTietDonHang::where('id_don_hang', 0)
                ->where('id_khach_hang', $khachHang->id)
                ->where('chi_tiet_don_hangs.id_quan_an', $id_quan_an)
                ->update([
                    'id_don_hang' => $donHang->id,
                ]);

            // Update lại mã đơn hàng theo ID thật
            $donHang->ma_don_hang = 'DZ' . $donHang->id;
            $donHang->save();

            // Trigger Broadcasting Event: Thông báo đơn hàng mới đến Quán ăn và Shipper
            try {
                event(new DonHangMoiEvent($donHang));
            } catch (\Exception $e) {
                // Nếu broadcasting fail (Pusher timeout), chỉ log warning, không fail request
                Log::warning('Broadcasting event failed: ' . $e->getMessage(), [
                    'don_hang_id' => $donHang->id
                ]);
            }

            // Lấy lại danh sách món ăn trong đơn hàng để trả về cho modal
            $chi_tiet_mon_an = ChiTietDonHang::where('id_don_hang', $donHang->id)
                ->join('mon_ans', 'mon_ans.id', 'chi_tiet_don_hangs.id_mon_an')
                ->select(
                    'chi_tiet_don_hangs.*',
                    'mon_ans.ten_mon_an',
                    'mon_ans.hinh_anh'
                )
                ->get();

            return response()->json([
                'status'            =>  true,
                'message'           =>  'Đã xác nhận đơn hàng thành công!',
                'id_don_hang'       =>  $donHang->id,
                'ma_don_hang'       =>  $donHang->ma_don_hang,
                'tien_hang'         =>  $donHang->tien_hang,
                'phi_ship'          =>  $donHang->phi_ship,
                'tong_tien'         =>  $donHang->tong_tien,
                'chi_tiet_mon_an'   =>  $chi_tiet_mon_an,
                'dia_chi_nhan'      => [
                    'ten_nguoi_nhan'    => $dia_chi_khach->ten_nguoi_nhan,
                    'so_dien_thoai'     => $dia_chi_khach->so_dien_thoai,
                    'dia_chi'           => $dia_chi_khach->dia_chi,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('xacNhanDatHangTienMat Error: ' . $e->getMessage(), [
                'id_quan_an' => $id_quan_an,
                'id_dia_chi_khach' => $id_dia_chi_khach,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status'    => false,
                'message'   => 'Có lỗi xảy ra khi xác nhận đơn hàng: ' . $e->getMessage()
            ], 500);
        }
    }
}



// $data['link_qr']                   = "https://img.vietqr.io/image/MBBank-0394425076-qr_only.png?amount=" . $donHang->tong_tien . "&addInfo=DZ" . $donHang->id;

        // ChiTietDonHang::where('id_don_hang', 0)
        //     ->where('id_khach_hang', Auth::guard('sanctum')->user()->id)
        //     ->where('chi_tiet_don_hangs.id_quan_an', $id_quan_an)
        //     ->update([
        //         'id_don_hang' => $donHang->id,
        //     ]);
        // $data['ho_ten']                    = $khachHang->ho_va_ten;
        // $data['tong_tien']        = $donHang->tong_tien;
        // $data['phi_ship']        = $donHang->phi_ship;
        // $data['ma_don_hang']        = $donHang->ma_don_hang;

        // $data['ds_for'] =  ChiTietDonHang::where('id_don_hang', $donHang->id)
        //     ->where('id_khach_hang', Auth::guard('sanctum')->user()->id)
        //     ->where('chi_tiet_don_hangs.id_quan_an', $id_quan_an)
        //     ->join('mon_ans', 'mon_ans.id', '=', 'chi_tiet_don_hangs.id_mon_an')
        //     ->select('chi_tiet_don_hangs.*', 'mon_ans.ten_mon_an')
        //     ->get();
        //  Mail::to("kkdn011@gmail.com")->send(new MasterMail('Xác nhận đơn hàng', 'chi_tiet_don_hang', $data));
        // SendMailJob::dispatch("kkdn011@gmail.com", 'Xác nhận đặt hàng', 'chi_tiet_don_hang', $data);
