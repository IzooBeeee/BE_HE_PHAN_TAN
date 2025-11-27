<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhanQuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phan_quyens')->delete();

        DB::table('phan_quyens')->truncate();

        // === CEO/TỔNG GIÁM ĐỐC (ID: 1) - TOÀN QUYỀN ===
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 1],   ['id_chuc_vu' => 1, 'id_chuc_nang' => 2],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 3],   ['id_chuc_vu' => 1, 'id_chuc_nang' => 4],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 5],   ['id_chuc_vu' => 1, 'id_chuc_nang' => 6],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 7],   ['id_chuc_vu' => 1, 'id_chuc_nang' => 8],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 9],   ['id_chuc_vu' => 1, 'id_chuc_nang' => 10],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 11],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 12],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 13],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 14],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 15],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 16],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 17],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 18],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 19],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 20],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 21],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 22],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 23],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 24],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 25],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 26],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 27],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 28],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 29],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 30],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 31],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 32],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 33],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 34],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 35],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 36],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 37],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 38],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 39],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 40],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 41],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 42],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 43],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 44],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 45],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 46],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 47],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 48],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 49],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 50],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 51],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 52],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 53],  ['id_chuc_vu' => 1, 'id_chuc_nang' => 54],
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 55],
        ]);

        // === COO - GIÁM ĐỐC VẬN HÀNH (ID: 2) ===
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 1],   ['id_chuc_vu' => 2, 'id_chuc_nang' => 2],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 3],   ['id_chuc_vu' => 2, 'id_chuc_nang' => 4],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 5],   ['id_chuc_vu' => 2, 'id_chuc_nang' => 6],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 7],   ['id_chuc_vu' => 2, 'id_chuc_nang' => 8],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 9],   ['id_chuc_vu' => 2, 'id_chuc_nang' => 10],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 11],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 12],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 13],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 14],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 15],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 16],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 17],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 18],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 19],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 25],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 26],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 27],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 28],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 29],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 35],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 36],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 37],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 38],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 39],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 40],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 41],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 42],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 43],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 49],
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 50],  ['id_chuc_vu' => 2, 'id_chuc_nang' => 51],
        ]);

        // === CTO - GIÁM ĐỐC CÔNG NGHỆ (ID: 3) ===
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 1],   ['id_chuc_vu' => 3, 'id_chuc_nang' => 2],
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 3],   ['id_chuc_vu' => 3, 'id_chuc_nang' => 4],
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 5],   ['id_chuc_vu' => 3, 'id_chuc_nang' => 40],
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 41],  ['id_chuc_vu' => 3, 'id_chuc_nang' => 42],
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 43],  ['id_chuc_vu' => 3, 'id_chuc_nang' => 44],
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 45],  ['id_chuc_vu' => 3, 'id_chuc_nang' => 46],
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 47],  ['id_chuc_vu' => 3, 'id_chuc_nang' => 48],
        ]);

        // === TRƯỞNG PHÒNG VẬN HÀNH (ID: 8) ===
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 6],   ['id_chuc_vu' => 8, 'id_chuc_nang' => 7],
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 8],   ['id_chuc_vu' => 8, 'id_chuc_nang' => 9],
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 10],  ['id_chuc_vu' => 8, 'id_chuc_nang' => 11],
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 12],  ['id_chuc_vu' => 8, 'id_chuc_nang' => 13],
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 14],  ['id_chuc_vu' => 8, 'id_chuc_nang' => 15],
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 25],  ['id_chuc_vu' => 8, 'id_chuc_nang' => 26],
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 27],  ['id_chuc_vu' => 8, 'id_chuc_nang' => 28],
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 29],  ['id_chuc_vu' => 8, 'id_chuc_nang' => 35],
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 36],  ['id_chuc_vu' => 8, 'id_chuc_nang' => 37],
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 38],
        ]);

        // === TRƯỞNG PHÒNG CSKH (ID: 9) ===
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 9, 'id_chuc_nang' => 16],  ['id_chuc_vu' => 9, 'id_chuc_nang' => 17],
            ['id_chuc_vu' => 9, 'id_chuc_nang' => 18],  ['id_chuc_vu' => 9, 'id_chuc_nang' => 35],
            ['id_chuc_vu' => 9, 'id_chuc_nang' => 36],  ['id_chuc_vu' => 9, 'id_chuc_nang' => 49],
            ['id_chuc_vu' => 9, 'id_chuc_nang' => 50],  ['id_chuc_vu' => 9, 'id_chuc_nang' => 51],
        ]);

        // === QUẢN LÝ ĐỐI TÁC QUÁN ĂN (ID: 15) ===
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 15, 'id_chuc_nang' => 6],  ['id_chuc_vu' => 15, 'id_chuc_nang' => 7],
            ['id_chuc_vu' => 15, 'id_chuc_nang' => 8],  ['id_chuc_vu' => 15, 'id_chuc_nang' => 9],
            ['id_chuc_vu' => 15, 'id_chuc_nang' => 25], ['id_chuc_vu' => 15, 'id_chuc_nang' => 26],
            ['id_chuc_vu' => 15, 'id_chuc_nang' => 27], ['id_chuc_vu' => 15, 'id_chuc_nang' => 28],
            ['id_chuc_vu' => 15, 'id_chuc_nang' => 29],
        ]);

        // === QUẢN LÝ SHIPPER (ID: 16) ===
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 16, 'id_chuc_nang' => 11], ['id_chuc_vu' => 16, 'id_chuc_nang' => 12],
            ['id_chuc_vu' => 16, 'id_chuc_nang' => 13], ['id_chuc_vu' => 16, 'id_chuc_nang' => 14],
            ['id_chuc_vu' => 16, 'id_chuc_nang' => 15], ['id_chuc_vu' => 16, 'id_chuc_nang' => 35],
            ['id_chuc_vu' => 16, 'id_chuc_nang' => 36], ['id_chuc_vu' => 16, 'id_chuc_nang' => 37],
        ]);

        // === NHÂN VIÊN CSKH (ID: 28) ===
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 28, 'id_chuc_nang' => 16], ['id_chuc_vu' => 28, 'id_chuc_nang' => 17],
            ['id_chuc_vu' => 28, 'id_chuc_nang' => 49], ['id_chuc_vu' => 28, 'id_chuc_nang' => 50],
            ['id_chuc_vu' => 28, 'id_chuc_nang' => 51],
        ]);
    }
}
