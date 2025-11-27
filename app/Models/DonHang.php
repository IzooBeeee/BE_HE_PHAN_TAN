<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'don_hangs';
    protected $fillable = [
        'ma_don_hang',
        'id_khach_hang',
        'id_voucher',
        'id_shipper',
        'id_quan_an',
        'id_dia_chi_nhan',
        'ten_nguoi_nhan',
        'so_dien_thoai',
        'tien_hang',
        'phi_ship',
        'tong_tien',
        'is_thanh_toan',
        'so_tien_nhan',
        'tinh_trang',
        'phuong_thuc_thanh_toan',
    ];

    const TINH_TRANG_CHUA_NHAN      = 0;
    const TINH_TRANG_DA_NHAN        = 1;
    const TINH_TRANG_QUAN_DANG_LAM  = 2;
    const TINH_TRANG_DA_GIAO        = 3;

    const thanh_toan_tien_mat       = 1;
    const thanh_toan_chuyen_khoan     = 2;

    const TINH_TRANG_DA_HUY         = 4;
    const DA_THANH_TOAN             = 1;
    const CHUA_THANH_TOAN           = 0;
}
