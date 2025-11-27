<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chi_tiet_don_hangs';
    protected $fillable = [
        'id_don_hang',
        'id_mon_an',
        'id_quan_an',
        'id_khach_hang',
        'don_gia',
        'so_luong',
        'thanh_tien',
        'ghi_chu',
    ];


}
