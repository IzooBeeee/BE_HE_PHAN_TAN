<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Shipper extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'shippers';
    protected $fillable = [
        'ho_va_ten',
        'so_dien_thoai',
        'email',
        'password',
        'hinh_anh',
        'cccd',
        'is_active',
        'is_open',
        'tong_tien',
    ];
}
