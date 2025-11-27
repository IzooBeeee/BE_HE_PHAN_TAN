<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class QuanAn extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'quan_ans';
    protected $fillable = [
        'email',
        'password',
        'ma_so_thue',
        'ten_quan_an',
        'hinh_anh',
        'id_quan_huyen',
        'dia_chi',
        'so_dien_thoai',
        'gio_mo_cua',
        'gio_dong_cua',
        'tong_tien',
        'is_active',
        'tinh_trang',
        'toa_do_x',
        'toa_do_y',
    ];
}
