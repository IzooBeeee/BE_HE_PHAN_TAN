<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietDanhMucQuanAnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chi_tiet_danh_muc_quan_ans')->delete();
        DB::table('chi_tiet_danh_muc_quan_ans')->truncate();

        DB::table('chi_tiet_danh_muc_quan_ans')->insert([
            ['id' => '1', 'id_quan_an' => '2', 'id_danh_muc' => '15'],
            ['id' => '2', 'id_quan_an' => '2', 'id_danh_muc' => '16'],
            ['id' => '3', 'id_quan_an' => '2', 'id_danh_muc' => '17'],
            ['id' => '4', 'id_quan_an' => '2', 'id_danh_muc' => '18'],
            ['id' => '5', 'id_quan_an' => '3', 'id_danh_muc' => '15'],
            ['id' => '6', 'id_quan_an' => '3', 'id_danh_muc' => '16'],
            ['id' => '7', 'id_quan_an' => '3', 'id_danh_muc' => '18'],
            ['id' => '8', 'id_quan_an' => '4', 'id_danh_muc' => '15'],
            ['id' => '9', 'id_quan_an' => '4', 'id_danh_muc' => '16'],
            ['id' => '10', 'id_quan_an' => '4', 'id_danh_muc' => '17'],
            ['id' => '11', 'id_quan_an' => '4', 'id_danh_muc' => '18'],
            ['id' => '12', 'id_quan_an' => '4', 'id_danh_muc' => '19'],
            ['id' => '13', 'id_quan_an' => '4', 'id_danh_muc' => '36'],
            ['id' => '14', 'id_quan_an' => '5', 'id_danh_muc' => '22'],
            ['id' => '15', 'id_quan_an' => '5', 'id_danh_muc' => '23'],
            ['id' => '16', 'id_quan_an' => '5', 'id_danh_muc' => '14'],
            ['id' => '17', 'id_quan_an' => '5', 'id_danh_muc' => '26'],
            ['id' => '18', 'id_quan_an' => '6', 'id_danh_muc' => '23'],
            ['id' => '19', 'id_quan_an' => '6', 'id_danh_muc' => '14'],
            ['id' => '20', 'id_quan_an' => '7', 'id_danh_muc' => '22'],
            ['id' => '21', 'id_quan_an' => '7', 'id_danh_muc' => '23'],
            ['id' => '22', 'id_quan_an' => '7', 'id_danh_muc' => '24'],
            ['id' => '23', 'id_quan_an' => '7', 'id_danh_muc' => '25'],
            ['id' => '24', 'id_quan_an' => '8', 'id_danh_muc' => '14'],
            ['id' => '25', 'id_quan_an' => '8', 'id_danh_muc' => '15'],
            ['id' => '26', 'id_quan_an' => '8', 'id_danh_muc' => '25'],
            ['id' => '27', 'id_quan_an' => '8', 'id_danh_muc' => '26'],
            ['id' => '28', 'id_quan_an' => '9', 'id_danh_muc' => '21'],
            ['id' => '29', 'id_quan_an' => '9', 'id_danh_muc' => '28'],
            ['id' => '30', 'id_quan_an' => '9', 'id_danh_muc' => '14'],
            ['id' => '31', 'id_quan_an' => '10', 'id_danh_muc' => '13'],
            ['id' => '32', 'id_quan_an' => '10', 'id_danh_muc' => '8'],
            ['id' => '33', 'id_quan_an' => '11', 'id_danh_muc' => '19'],
            ['id' => '34', 'id_quan_an' => '11', 'id_danh_muc' => '35'],
            ['id' => '35', 'id_quan_an' => '11', 'id_danh_muc' => '14'],
            ['id' => '36', 'id_quan_an' => '12', 'id_danh_muc' => '36'],
            ['id' => '37', 'id_quan_an' => '12', 'id_danh_muc' => '14'],
            ['id' => '38', 'id_quan_an' => '12', 'id_danh_muc' => '15'],
            ['id' => '39', 'id_quan_an' => '12', 'id_danh_muc' => '16'],
            ['id' => '40', 'id_quan_an' => '12', 'id_danh_muc' => '17'],
            ['id' => '41', 'id_quan_an' => '12', 'id_danh_muc' => '18'],
            ['id' => '42', 'id_quan_an' => '13', 'id_danh_muc' => '11'],
            ['id' => '43', 'id_quan_an' => '13', 'id_danh_muc' => '35'],
            ['id' => '44', 'id_quan_an' => '13', 'id_danh_muc' => '24'],
            ['id' => '45', 'id_quan_an' => '14', 'id_danh_muc' => '11'],
            ['id' => '46', 'id_quan_an' => '14', 'id_danh_muc' => '35'],
            ['id' => '47', 'id_quan_an' => '14', 'id_danh_muc' => '24'],
            ['id' => '48', 'id_quan_an' => '15', 'id_danh_muc' => '6'],
            ['id' => '49', 'id_quan_an' => '15', 'id_danh_muc' => '14'],
            ['id' => '50', 'id_quan_an' => '15', 'id_danh_muc' => '15'],
            ['id' => '51', 'id_quan_an' => '15', 'id_danh_muc' => '16'],
            ['id' => '52', 'id_quan_an' => '15', 'id_danh_muc' => '17'],
            ['id' => '53', 'id_quan_an' => '15', 'id_danh_muc' => '18'],
            ['id' => '54', 'id_quan_an' => '16', 'id_danh_muc' => '15'],
            ['id' => '55', 'id_quan_an' => '16', 'id_danh_muc' => '16'],
            ['id' => '56', 'id_quan_an' => '16', 'id_danh_muc' => '17'],
            ['id' => '57', 'id_quan_an' => '16', 'id_danh_muc' => '18'],
            ['id' => '58', 'id_quan_an' => '17', 'id_danh_muc' => '32'],
            ['id' => '59', 'id_quan_an' => '17', 'id_danh_muc' => '33'],
            ['id' => '60', 'id_quan_an' => '18', 'id_danh_muc' => '22'],
            ['id' => '61', 'id_quan_an' => '18', 'id_danh_muc' => '25'],
            ['id' => '62', 'id_quan_an' => '18', 'id_danh_muc' => '26'],
            ['id' => '63', 'id_quan_an' => '19', 'id_danh_muc' => '11'],
            ['id' => '64', 'id_quan_an' => '20', 'id_danh_muc' => '8'],
            // Thêm chi tiết danh mục cho các quán ăn mới (ID 21-50)
            ['id' => '65', 'id_quan_an' => '21', 'id_danh_muc' => '49'], // Bún bò Huế
            ['id' => '66', 'id_quan_an' => '21', 'id_danh_muc' => '50'], // Phở
            ['id' => '67', 'id_quan_an' => '21', 'id_danh_muc' => '51'], // Bún chả
            ['id' => '68', 'id_quan_an' => '22', 'id_danh_muc' => '49'], // Bún bò Huế
            ['id' => '69', 'id_quan_an' => '22', 'id_danh_muc' => '52'], // Bún riêu
            ['id' => '70', 'id_quan_an' => '22', 'id_danh_muc' => '53'], // Bún mắm
            ['id' => '71', 'id_quan_an' => '23', 'id_danh_muc' => '54'], // Bún thịt nướng
            ['id' => '72', 'id_quan_an' => '23', 'id_danh_muc' => '55'], // Bún bò Nam Bộ
            ['id' => '73', 'id_quan_an' => '23', 'id_danh_muc' => '56'], // Bún mọc
            ['id' => '74', 'id_quan_an' => '24', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '75', 'id_quan_an' => '24', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '76', 'id_quan_an' => '24', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '77', 'id_quan_an' => '25', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '78', 'id_quan_an' => '25', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '79', 'id_quan_an' => '25', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '80', 'id_quan_an' => '26', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '81', 'id_quan_an' => '26', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '82', 'id_quan_an' => '26', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '83', 'id_quan_an' => '27', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '84', 'id_quan_an' => '27', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '85', 'id_quan_an' => '27', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '86', 'id_quan_an' => '28', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '87', 'id_quan_an' => '28', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '88', 'id_quan_an' => '28', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '89', 'id_quan_an' => '29', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '90', 'id_quan_an' => '29', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '91', 'id_quan_an' => '29', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '92', 'id_quan_an' => '30', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '93', 'id_quan_an' => '30', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '94', 'id_quan_an' => '30', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '95', 'id_quan_an' => '31', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '96', 'id_quan_an' => '31', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '97', 'id_quan_an' => '31', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '98', 'id_quan_an' => '32', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '99', 'id_quan_an' => '32', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '100', 'id_quan_an' => '32', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '101', 'id_quan_an' => '33', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '102', 'id_quan_an' => '33', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '103', 'id_quan_an' => '33', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '104', 'id_quan_an' => '34', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '105', 'id_quan_an' => '34', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '106', 'id_quan_an' => '34', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '107', 'id_quan_an' => '35', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '108', 'id_quan_an' => '35', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '109', 'id_quan_an' => '35', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '110', 'id_quan_an' => '36', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '111', 'id_quan_an' => '36', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '112', 'id_quan_an' => '36', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '113', 'id_quan_an' => '37', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '114', 'id_quan_an' => '37', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '115', 'id_quan_an' => '37', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '116', 'id_quan_an' => '38', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '117', 'id_quan_an' => '38', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '118', 'id_quan_an' => '38', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '119', 'id_quan_an' => '39', 'id_danh_muc' => '49'], // Bún bò Huế
            ['id' => '120', 'id_quan_an' => '39', 'id_danh_muc' => '50'], // Phở
            ['id' => '121', 'id_quan_an' => '39', 'id_danh_muc' => '51'], // Bún chả
            ['id' => '122', 'id_quan_an' => '40', 'id_danh_muc' => '52'], // Bún riêu
            ['id' => '123', 'id_quan_an' => '40', 'id_danh_muc' => '53'], // Bún mắm
            ['id' => '124', 'id_quan_an' => '40', 'id_danh_muc' => '54'], // Bún thịt nướng
            ['id' => '125', 'id_quan_an' => '41', 'id_danh_muc' => '55'], // Bún bò Nam Bộ
            ['id' => '126', 'id_quan_an' => '41', 'id_danh_muc' => '56'], // Bún mọc
            ['id' => '127', 'id_quan_an' => '41', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '128', 'id_quan_an' => '42', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '129', 'id_quan_an' => '42', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '130', 'id_quan_an' => '42', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '131', 'id_quan_an' => '43', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '132', 'id_quan_an' => '43', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '133', 'id_quan_an' => '43', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '134', 'id_quan_an' => '44', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '135', 'id_quan_an' => '44', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '136', 'id_quan_an' => '44', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '137', 'id_quan_an' => '45', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '138', 'id_quan_an' => '45', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '139', 'id_quan_an' => '45', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '140', 'id_quan_an' => '46', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '141', 'id_quan_an' => '46', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '142', 'id_quan_an' => '46', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '143', 'id_quan_an' => '47', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '144', 'id_quan_an' => '47', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '145', 'id_quan_an' => '47', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '146', 'id_quan_an' => '48', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '147', 'id_quan_an' => '48', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '148', 'id_quan_an' => '48', 'id_danh_muc' => '59'], // Món ăn chay
            ['id' => '149', 'id_quan_an' => '49', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '150', 'id_quan_an' => '49', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '151', 'id_quan_an' => '49', 'id_danh_muc' => '60'], // Món ăn theo mùa
            ['id' => '152', 'id_quan_an' => '50', 'id_danh_muc' => '57'], // Bún chả các loại
            ['id' => '153', 'id_quan_an' => '50', 'id_danh_muc' => '58'], // Món ăn đặc sản
            ['id' => '154', 'id_quan_an' => '50', 'id_danh_muc' => '59'], // Món ăn chay
        ]);
    }
}
