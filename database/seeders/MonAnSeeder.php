<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonAnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mon_ans')->delete();
        DB::table('mon_ans')->truncate();

        $monAn = [];
        $id = 1;

        // QUÁN 1: Highlands Coffee (Cafe & Đồ uống)
        $monsQuan1 = [
            ['ten_mon_an' => 'Phin Sữa Đá', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Cafe phin truyền thống Việt Nam kết hợp sữa đặc', 'hinh_anh' => 'https://thuytinhgiare.com/wp-content/uploads/2023/07/hinh-anh-ly-cafe-phin_4.jpg', 'id_danh_muc' => 17],
            ['ten_mon_an' => 'Phin Đen Đá', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Cafe đen đậm đà từ phin truyền thống', 'hinh_anh' => 'https://cafesongao.com/wp-content/uploads/2021/07/ca-phe-den-da.png', 'id_danh_muc' => 17],
            ['ten_mon_an' => 'Bạc Xỉu', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Cafe Sài Gòn với sữa tươi và sữa đặc', 'hinh_anh' => 'http://thuytinhgiare.com/wp-content/uploads/2023/07/hinh-anh-ly-cafe-bac-xiu_16.jpg', 'id_danh_muc' => 17],
            ['ten_mon_an' => 'Cafe Muối', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Cafe đặc biệt với lớp kem muối béo ngậy', 'hinh_anh' => 'https://cdn.tuoitre.vn/471584752817336320/2023/8/16/ca-phe-muoi-1692166818071338553380.png', 'id_danh_muc' => 17],
            ['ten_mon_an' => 'Cafe Dừa', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cafe kết hợp nước cốt dừa thơm ngon', 'hinh_anh' => 'https://myvietcoffee.com/wp-content/uploads/2024/10/cach-lam-ca-phe-nuoc-cot-dua.jpg', 'id_danh_muc' => 17],
            ['ten_mon_an' => 'Freeze Trà Xanh', 'gia_ban' => 50000, 'gia_khuyen_mai' => 45000, 'mo_ta' => 'Đá xay trà xanh mát lạnh', 'hinh_anh' => 'https://bizweb.dktcdn.net/100/487/455/products/freeze-tra-xanh-1698984273180.jpg?v=1724205776357', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Freeze Socola', 'gia_ban' => 52000, 'gia_khuyen_mai' => 47000, 'mo_ta' => 'Đá xay socola đậm đà', 'hinh_anh' => 'https://recipes.net/wp-content/uploads/portal_files/recipes_net_posts/2021-06/freeze-easy-chocolate-shake-recipe.png', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Classic Phin Freeze', 'gia_ban' => 55000, 'gia_khuyen_mai' => 50000, 'mo_ta' => 'Đá xay cafe phin truyền thống', 'hinh_anh' => 'https://www.highlandscoffee.com.vn/vnt_upload/product/06_2023/HLC_New_logo_5.1_Products__CLASSIC_FREEZE_PHINDI.jpg', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Đào Cam Sả', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Trà hoa quả thanh mát', 'hinh_anh' => 'https://lofita.vn/public/upload/files/Tra%20dao%20cam%20sa.jpg', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Chanh Leo', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Trà với chanh leo chua ngọt', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9CORGtdgqKHMRFIGWkREdjFd3nT7TxnP6Sw&s', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Nước Cam Ép', 'gia_ban' => 38000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Nước cam tươi vắt nguyên chất', 'hinh_anh' => 'https://i.pinimg.com/736x/e1/2f/04/e12f04e59f41d77b623c621364198088.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Nước Ép Dưa Hấu', 'gia_ban' => 35000, 'gia_khuyen_mai' => 32000, 'mo_ta' => 'Nước dưa hấu tươi mát', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2020/10/23/1301299/5-cach-lam-nuoc-ep-dua-hau-cuc-ngon-don-gian-tai-nha-202010231109233490.jpg', 'id_danh_muc' => 19],
        ];
        foreach ($monsQuan1 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 1, 'tinh_trang' => 1]);
        }

        // QUÁN 2: Trà Sữa Phúc Hưng
        $monsQuan2 = [
            ['ten_mon_an' => 'Trà Sữa Trân Châu Đường Đen', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Trà sữa với trân châu đường đen dẻo ngọt', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2022/01/21/1412109/huong-dan-cach-lam-tra-sua-tran-chau-duong-den-202201211537260116.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Truyền Thống', 'gia_ban' => 30000, 'gia_khuyen_mai' => 25000, 'mo_ta' => 'Trà sữa đen thơm ngon', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/08/10/1374160/hoc-2-cach-pha-tra-sua-truyen-thong-thom-ngon-chuan-vi-ai-cung-me-202203031716377004.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Bạc Hà', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Trà sữa vị bạc hà the mát', 'hinh_anh' => 'https://cdn.nguyenkimmall.com/images/detailed/747/6-tra-sua-bac-ha.jpg.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Khoai Môn', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Trà sữa khoai môn tím béo ngậy', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/11/04/1395665/cach-lam-tra-sua-khoai-mon-thom-ngon-chuan-vi-202111041038558095.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Matcha', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Trà sữa matcha Nhật Bản', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2022/03/16/1420535/cach-lam-matcha-da-xay-kem-ngon-beo-ngay-don-gian-tai-nha-202203160109187743.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Sương Sáo', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Trà sữa với sương sáo mát lạnh', 'hinh_anh' => 'https://cdn.tgdd.vn/2021/09/CookRecipe/Avatar/tra-sua-suong-sao-bang-bot-beo-thumbnail-1.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Đào', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Trà sữa hương đào thơm ngon', 'hinh_anh' => 'https://congthucphache.com/wp-content/uploads/2021/10/z2847484529074_9f315bdce3a01f84745b61a47fa600fd.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Ô Long', 'gia_ban' => 36000, 'gia_khuyen_mai' => 31000, 'mo_ta' => 'Trà sữa ô long đài loan', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/08/10/1374160/hoc-cach-pha-tra-sua-o-long-dai-loan-thom-ngon-chuan-vi-ai-cung-me-202108100039248020.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Socola', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Trà sữa socola đậm đà', 'hinh_anh' => 'https://noithatcaphe.vn/images/2022/07/15/socola-da-xay-1.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Yakult', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Trà sữa kết hợp yakult chua ngọt', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRF9fisCFm_cdkp053RNCS7KCX-bwq51mrSZw&s', 'id_danh_muc' => 16],
        ];
        foreach ($monsQuan2 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 2, 'tinh_trang' => 1]);
        }

        // QUÁN 3: Dinhtea - Trà Sữa
        $monsQuan3 = [
            ['ten_mon_an' => 'Lục Trà Chanh', 'gia_ban' => 28000, 'gia_khuyen_mai' => 25000, 'mo_ta' => 'Trà xanh chanh tươi mát', 'hinh_anh' => 'https://congthucphache.com/wp-content/uploads/2021/10/z2829041305457_465d871cb818145dda9be6542ba95731.jpg', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Lục Trà Xoài', 'gia_ban' => 30000, 'gia_khuyen_mai' => 27000, 'mo_ta' => 'Trà xanh xoài nhiệt đới', 'hinh_anh' => 'https://congthucphache.com/wp-content/uploads/2021/10/z2847484529074_9f315bdce3a01f84745b61a47fa600fd.jpg', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Chanh Nhãn', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Trà chanh với nhãn tươi', 'hinh_anh' => 'https://longnhanbamai.com/wp-content/uploads/2018/08/Cach-pha-tra-nhan-ngon.jpg', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Chanh Bạc Hà', 'gia_ban' => 30000, 'gia_khuyen_mai' => 26000, 'mo_ta' => 'Trà chanh bạc hà the mát', 'hinh_anh' => 'https://assets.unileversolutions.com/v1/1188476.jpg', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Chanh Gừng Sả', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Trà chanh với gừng sả ấm áp', 'hinh_anh' => 'https://images.baodantoc.vn/uploads/2020/Th%C3%A1ng%202/Ng%C3%A0y%2017/tra-sa-e1571990437260.jpg', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Vải', 'gia_ban' => 30000, 'gia_khuyen_mai' => 26000, 'mo_ta' => 'Trà vị vải thiều ngọt thanh', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRi3mnnDR42vTqZ7LII-EATkSrw_Ts9A59QTA&s', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Đào Cam Sả', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Trà hoa quả mix đặc biệt', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXbFucPDmhWK7KU1Mgj3TuMYHwjAlJW_qYQTa-9VSsGjg4GXYK-EfqvyNs4OkDrhFKSmo&usqp=CAU', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Ô Long Vải', 'gia_ban' => 33000, 'gia_khuyen_mai' => 29000, 'mo_ta' => 'Trà ô long kết hợp vải thiều', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQM2egr6SI14d3VhRmvFuwtOF-gGAJ_W3BToA&s', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Xanh Đào', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Trà xanh hương đào thơm mát', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9bGG9CYO9ecTNdqf1A00f4Sv77mAheGUHIUD74eVNwoMbWaidd2xT6avWsjKMe9w-uE0&usqp=CAU', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Dâu', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Trà dâu tây tươi mát', 'hinh_anh' => 'https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:format(webp):quality(75)/2023_10_19_638333136830369737_tra-dau-tam-thumb.jpg', 'id_danh_muc' => 18],
        ];
        foreach ($monsQuan3 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 3, 'tinh_trang' => 1]);
        }

        // QUÁN 4: Gong Cha
        $monsQuan4 = [
            ['ten_mon_an' => 'Matcha Đá Xay', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Matcha Nhật đá xay mát lạnh', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2022/03/16/1420535/cach-lam-matcha-da-xay-kem-ngon-beo-ngay-don-gian-tai-nha-202203160109187743.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Socola Đá Xay', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Socola đá xay béo ngậy', 'hinh_anh' => 'https://noithatcaphe.vn/images/2022/07/15/socola-da-xay-1.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Trân Châu', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Trà sữa trân châu đen dẻo dai', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2022/01/21/1412109/huong-dan-cach-lam-tra-sua-tran-chau-duong-den-202201211537260116.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Ô Long Sữa', 'gia_ban' => 36000, 'gia_khuyen_mai' => 31000, 'mo_ta' => 'Trà ô long sữa đài loan', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/08/10/1374160/hoc-cach-pha-tra-sua-o-long-dai-loan-thom-ngon-chuan-vi-ai-cung-me-202108100039248020.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Trà Sữa Alisan', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Trà sữa cao cấp từ Đài Loan', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/08/10/1374160/hoc-2-cach-pha-tra-sua-truyen-thong-thom-ngon-chuan-vi-ai-cung-me-202203031716377004.jpg', 'id_danh_muc' => 16],
            ['ten_mon_an' => 'Sữa Tươi Trân Châu Đường Đen', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Sữa tươi với trân châu đường đen', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2022/01/21/1412109/huong-dan-cach-lam-tra-sua-tran-chau-duong-den-202201211537260116.jpg', 'id_danh_muc' => 15],
            ['ten_mon_an' => 'Trà Ô Long Đào', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Trà ô long với đào tươi', 'hinh_anh' => 'https://phela.vn/wp-content/uploads/2024/07/Resize-AppFood-KV-OLongDaoHong-2-03-scaled.jpg', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Ô Long Vải', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Trà ô long với vải thiều', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTedKhMhInxUrejNjqkNWH8Yia417gPHGNGuQ&s', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Trà Chanh', 'gia_ban' => 28000, 'gia_khuyen_mai' => 25000, 'mo_ta' => 'Trà chanh tươi mát', 'hinh_anh' => 'https://media.vov.vn/sites/default/files/styles/large/public/2024-10/uong_nuoc_chanh_qua_nhieu_1.jpg', 'id_danh_muc' => 18],
            ['ten_mon_an' => 'Café Đường Đen', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Cafe với đường đen thơm nồng', 'hinh_anh' => 'https://cdn.tuoitre.vn/471584752817336320/2023/8/16/ca-phe-muoi-1692166818071338553380.png', 'id_danh_muc' => 17],
        ];
        foreach ($monsQuan4 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 4, 'tinh_trang' => 1]);
        }

        // QUÁN 5: Nước Ép & Sinh Tố Sài Gòn
        $monsQuan5 = [
            ['ten_mon_an' => 'Nước Ép Cam', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Nước cam tươi vắt nguyên chất', 'hinh_anh' => 'https://i.pinimg.com/736x/e1/2f/04/e12f04e59f41d77b623c621364198088.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Nước Ép Dưa Hấu', 'gia_ban' => 28000, 'gia_khuyen_mai' => 25000, 'mo_ta' => 'Nước dưa hấu tươi mát', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2020/10/23/1301299/5-cach-lam-nuoc-ep-dua-hau-cuc-ngon-don-gian-tai-nha-202010231109233490.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Nước Ép Cà Rốt', 'gia_ban' => 30000, 'gia_khuyen_mai' => 26000, 'mo_ta' => 'Nước cà rốt giàu vitamin A', 'hinh_anh' => 'https://banhcuonnamviet.com/upload/product/epcarot-6565.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Nước Ép Dứa', 'gia_ban' => 28000, 'gia_khuyen_mai' => 25000, 'mo_ta' => 'Nước dứa thơm ngọt', 'hinh_anh' => 'https://login.medlatec.vn//ImagePath/images/20230420/20230420_Nuoc-ep-dua-co-chua-nhieu-vitamin-va-khoang-chat-.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Nước Chanh Tươi', 'gia_ban' => 22000, 'gia_khuyen_mai' => 20000, 'mo_ta' => 'Nước chanh vắt tươi giải khát', 'hinh_anh' => 'https://media.vov.vn/sites/default/files/styles/large/public/2024-10/uong_nuoc_chanh_qua_nhieu_1.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Nước Mía', 'gia_ban' => 20000, 'gia_khuyen_mai' => 18000, 'mo_ta' => 'Nước mía tươi ngọt thanh', 'hinh_anh' => 'https://cdn.nhathuoclongchau.com.vn/unsafe/800x0/https://cms-prod.s3-sgn09.fptcloud.com/nuoc_mia_co_tac_dung_gi_doi_voi_suc_khoe_1_3faa508da1.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Nước Dừa Tươi', 'gia_ban' => 25000, 'gia_khuyen_mai' => 22000, 'mo_ta' => 'Nước dừa tươi mát lạnh', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2020/06/22/1264775/nuoc-dua-de-duoc-bao-lau-cach-bao-nuoc-dua-dung-202006221624116259.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Sinh Tố Bơ', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Sinh tố bơ béo ngậy', 'hinh_anh' => 'https://png.pngtree.com/png-clipart/20240308/original/pngtree-tasty-avocado-smoothie-in-glass-file-png-png-image_14536497.png', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Sinh Tố Dâu', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Sinh tố dâu tây tươi', 'hinh_anh' => 'https://i0.wp.com/berryland.vn/wp-content/uploads/2024/04/Sinh-to-dau-tay.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Sinh Tố Xoài', 'gia_ban' => 30000, 'gia_khuyen_mai' => 26000, 'mo_ta' => 'Sinh tố xoài chín ngọt', 'hinh_anh' => 'https://tiki.vn/blog/wp-content/uploads/2023/03/cach-lam-sinh-to-xoai.jpg', 'id_danh_muc' => 19],
            ['ten_mon_an' => 'Sinh Tố Mãng Cầu', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Sinh tố mãng cầu thơm ngon', 'hinh_anh' => 'https://www.huongnghiepaau.com/wp-content/uploads/2019/08/sinh-to-mang-cau.jpg', 'id_danh_muc' => 19],
        ];
        foreach ($monsQuan5 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 5, 'tinh_trang' => 1]);
        }

        // QUÁN 6-10: CƠM TẤM (mỗi quán 8-10 món)
        $monsQuan6 = [
            ['ten_mon_an' => 'Cơm Tấm Sườn Bì Chả', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Cơm tấm với sườn, bì, chả đầy đủ', 'hinh_anh' => 'https://tse4.mm.bing.net/th/id/OIP.zfwd7yctDpX0nki0A7XgNQHaEK?rs=1&pid=ImgDetMain', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Bì', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cơm tấm sườn bì thơm ngon', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/08/16/1375565/cach-nau-com-tam-suon-bi-cha-tai-nha-ngon-nhu-ngoai-tiem-202108162216045436.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Chả', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cơm tấm sườn chả đậm đà', 'hinh_anh' => 'https://comtambason.com/wp-content/uploads/2020/12/Suon-cha.png', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Nướng', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Cơm tấm sườn nướng than', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/08/09/1373996/tu-lam-com-tam-suon-trung-don-gian-thom-ngon-nhu-ngoai-hang-202201071248422991.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Trứng', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Cơm tấm sườn ốp la', 'hinh_anh' => 'https://lamsonfood.com/wp-content/uploads/2022/02/com-tam-duoc-nhieu-nguoi-yeu-thich.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Chả', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Cơm tấm chả trứng béo ngậy', 'hinh_anh' => 'https://cdn.tgdd.vn/2021/07/CookProduct/0-1200x676-14.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Bì', 'gia_ban' => 30000, 'gia_khuyen_mai' => 26000, 'mo_ta' => 'Cơm tấm bì heo giòn dai', 'hinh_anh' => 'https://lamsonfood.com/wp-content/uploads/2022/02/com-tam-duoc-nhieu-nguoi-yeu-thich.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Gà Nướng', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cơm tấm gà nướng thơm lừng', 'hinh_anh' => 'https://tse2.mm.bing.net/th/id/OIP.tBH5N9YaS3jHgTwSzUa6QQHaHa?rs=1&pid=ImgDetMain', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Non Kho', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Cơm tấm sườn non kho mềm', 'hinh_anh' => 'https://cdn.tgdd.vn/2021/08/CookProduct/t1-1200x676.jpg', 'id_danh_muc' => 22],
        ];
        foreach ($monsQuan6 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 6, 'tinh_trang' => 1]);
        }

        // QUÁN 7: Cơm Tấm Sườn Ngon
        $monsQuan7 = [
            ['ten_mon_an' => 'Cơm Tấm Sườn Đặc Biệt', 'gia_ban' => 50000, 'gia_khuyen_mai' => 45000, 'mo_ta' => 'Cơm tấm sườn đặc biệt full topping', 'hinh_anh' => 'https://canbepnho.com/wp-content/uploads/2023/02/Den-Viet-Nam-khong-the-bo-qua-com-tam-suon-bi-cha-3.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn BBQ', 'gia_ban' => 48000, 'gia_khuyen_mai' => 43000, 'mo_ta' => 'Cơm tấm sườn BBQ kiểu Mỹ', 'hinh_anh' => 'https://trixie.com.vn/media/images/article/43561209/com-suon-nuong-bbq%204.png', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Cay', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cơm tấm sườn ướp cay nồng', 'hinh_anh' => 'https://lamsonfood.com/wp-content/uploads/2022/02/com-tam-duoc-nhieu-nguoi-yeu-thich.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Mật Ong', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Cơm tấm sườn ướp mật ong', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/08/09/1373996/tu-lam-com-tam-suon-trung-don-gian-thom-ngon-nhu-ngoai-hang-202201071248422991.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Heo Rừng', 'gia_ban' => 52000, 'gia_khuyen_mai' => 48000, 'mo_ta' => 'Cơm tấm sườn heo rừng thơm ngon', 'hinh_anh' => 'https://lamsonfood.com/wp-content/uploads/2022/02/com-tam-duoc-nhieu-nguoi-yeu-thich.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Xả Ớt', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cơm tấm sườn xả ớt đậm đà', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/08/16/1375565/cach-nau-com-tam-suon-bi-cha-tai-nha-ngon-nhu-ngoai-tiem-202108162216045436.jpg', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Sườn Non', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Cơm tấm sườn non mềm ngon', 'hinh_anh' => 'https://comtambason.com/wp-content/uploads/2020/12/Suon-cha.png', 'id_danh_muc' => 22],
            ['ten_mon_an' => 'Cơm Tấm Combo Gia Đình', 'gia_ban' => 150000, 'gia_khuyen_mai' => 140000, 'mo_ta' => 'Cơm tấm combo cho 4 người', 'hinh_anh' => 'https://tse4.mm.bing.net/th/id/OIP.zfwd7yctDpX0nki0A7XgNQHaEK?rs=1&pid=ImgDetMain', 'id_danh_muc' => 22],
        ];
        foreach ($monsQuan7 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 7, 'tinh_trang' => 1]);
        }

        // QUÁN 8: Cơm Gà Đà Nẵng
        $monsQuan8 = [
            ['ten_mon_an' => 'Cơm Gà Xé', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Cơm gà xé thơm ngon', 'hinh_anh' => 'https://phugiafood.com/wp-content/uploads/2021/11/Com-ga-xe-phay-1-1024x768.jpg', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Gà Nướng', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cơm gà nướng da giòn', 'hinh_anh' => 'https://tse2.mm.bing.net/th/id/OIP.tBH5N9YaS3jHgTwSzUa6QQHaHa?rs=1&pid=ImgDetMain', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Gà Luộc', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Cơm gà luộc mềm ngon', 'hinh_anh' => 'https://tse2.mm.bing.net/th/id/OIP.8CbJFAx1I9Nd4c3Xt6K_7AHaFM?rs=1&pid=ImgDetMain', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Gà Quay', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Cơm gà quay giòn bì', 'hinh_anh' => 'https://i-giadinh.vnecdn.net/2022/04/06/Thanh-pham-1-1-4812-1649254024.jpg', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Đùi Gà Quay', 'gia_ban' => 48000, 'gia_khuyen_mai' => 43000, 'mo_ta' => 'Cơm đùi gà quay giòn thơm', 'hinh_anh' => 'https://tapchiamthuc.net/wp-content/uploads/2023/03/gd.jpg', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Cánh Gà Quay', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Cơm cánh gà quay giòn', 'hinh_anh' => 'https://burgerking.vn/media/catalog/product/cache/1/image/1800x/040ec09b1e35df139433887a97daa66f/c/_/c_m_c_nh_g_bbq_1.png', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Gà Kho Gừng', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Cơm gà kho gừng đậm đà', 'hinh_anh' => 'https://tse2.mm.bing.net/th/id/OIP.8CbJFAx1I9Nd4c3Xt6K_7AHaFM?rs=1&pid=ImgDetMain', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Gà Rán', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cơm gà rán giòn rụm', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2017/03/22/963765/cach-lam-ga-ran-thom-ngon-8_760x450.jpg', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Gà Chiên Nước Mắm', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Cơm gà chiên nước mắm thơm ngon', 'hinh_anh' => 'https://tse2.mm.bing.net/th/id/OIP.tBH5N9YaS3jHgTwSzUa6QQHaHa?rs=1&pid=ImgDetMain', 'id_danh_muc' => 20],
        ];
        foreach ($monsQuan8 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 8, 'tinh_trang' => 1]);
        }

        // QUÁN 9: Cơm Chiên Đà Nẵng
        $monsQuan9 = [
            ['ten_mon_an' => 'Cơm Chiên Dương Châu', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Cơm chiên Dương Châu đầy đủ', 'hinh_anh' => 'https://baovephapluat.vn/data/images/0/2020/11/28/huyenpt/com-chien3.jpg', 'id_danh_muc' => 23],
            ['ten_mon_an' => 'Cơm Chiên Trứng', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Cơm chiên trứng đơn giản', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2019/06/05/1171265/cach-lam-com-chien-trung-hat-com-toi-khong-bi-nhao-202203031523399671.jpg', 'id_danh_muc' => 23],
            ['ten_mon_an' => 'Cơm Chiên Hải Sản', 'gia_ban' => 50000, 'gia_khuyen_mai' => 45000, 'mo_ta' => 'Cơm chiên hải sản tươi ngon', 'hinh_anh' => 'https://i.ytimg.com/vi/ZbSbc9Z8K6E/maxresdefault.jpg', 'id_danh_muc' => 23],
            ['ten_mon_an' => 'Cơm Chiên Thịt Bò', 'gia_ban' => 48000, 'gia_khuyen_mai' => 43000, 'mo_ta' => 'Cơm chiên thịt bò mềm ngọt', 'hinh_anh' => 'https://imgs.vietnamnet.vn/Images/2016/02/27/09/20160227090830-com-rang-thit-bo-chac-bung-cho-bua-sang-beef-fried-rice-5-1456502480-width600height413.jpg?width=0&s=XRPtCckMY_pRrXEDTHAEhA', 'id_danh_muc' => 23],
            ['ten_mon_an' => 'Cơm Chiên Gà', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cơm chiên gà thơm ngon', 'hinh_anh' => 'https://cdn.tgdd.vn/2021/01/CookRecipe/Avatar/com-chien-ga-xoi-mo-thumbnail.jpg', 'id_danh_muc' => 23],
            ['ten_mon_an' => 'Cơm Chiên Xá Xíu', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Cơm chiên xá xíu Trung Hoa', 'hinh_anh' => 'https://photo.znews.vn/w660/Uploaded/tmuitg/2020_11_16/maiod.jpg', 'id_danh_muc' => 23],
            ['ten_mon_an' => 'Cơm Chiên Heo Quay', 'gia_ban' => 48000, 'gia_khuyen_mai' => 43000, 'mo_ta' => 'Cơm chiên heo quay giòn bì', 'hinh_anh' => 'https://img-global.cpcdn.com/recipes/1f3479b6cd02e393/680x482cq70/c%C6%A1m-rang-th%E1%BB%8Bt-heo-quay-lowcarb-recipe-main-photo.jpg', 'id_danh_muc' => 23],
            ['ten_mon_an' => 'Cơm Chiên Lạp Xưởng', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Cơm chiên lạp xưởng thơm ngon', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToElsJpafd_aGHUMfE1Iqdg4WDUfJVXhcqlg&s', 'id_danh_muc' => 23],
        ];
        foreach ($monsQuan9 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 9, 'tinh_trang' => 1]);
        }

        // QUÁN 10: Cơm Văn Phòng Bình Dân
        $monsQuan10 = [
            ['ten_mon_an' => 'Cơm Sườn Kho', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Cơm sườn kho đậm đà', 'hinh_anh' => 'https://i.ytimg.com/vi/VNwsb7wpuMk/maxresdefault.jpg', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Cá Kho', 'gia_ban' => 30000, 'gia_khuyen_mai' => 26000, 'mo_ta' => 'Cơm cá kho tộ ngon', 'hinh_anh' => 'https://tse4.mm.bing.net/th/id/OIP._Dl1IjCFyyp-nIHdc-rPwQHaEK?rs=1&pid=ImgDetMain', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Thịt Kho Trứng', 'gia_ban' => 30000, 'gia_khuyen_mai' => 26000, 'mo_ta' => 'Cơm thịt kho trứng đậm vị', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWxg8fE4VW-JI8PjtHYtwkJsBnTI0IVD01Lw&s', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Tôm Rim', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Cơm tôm rim mặn ngọt', 'hinh_anh' => 'https://product.hstatic.net/1000245833/product/c_m_t_m_rim_master.jpg', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Cá Chiên', 'gia_ban' => 32000, 'gia_khuyen_mai' => 28000, 'mo_ta' => 'Cơm cá chiên giòn ngon', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfjNw2hr0rJ_feiwb3Um8mp3NbtvLTfo40zA&s', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Thịt Luộc', 'gia_ban' => 28000, 'gia_khuyen_mai' => 25000, 'mo_ta' => 'Cơm thịt luộc đơn giản', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKRntcXlniZSsBmIKutKLkeBM8ed5J-Q7a_w&s', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Gà Luộc', 'gia_ban' => 30000, 'gia_khuyen_mai' => 26000, 'mo_ta' => 'Cơm gà luộc mềm ngon', 'hinh_anh' => 'https://tse2.mm.bing.net/th/id/OIP.8CbJFAx1I9Nd4c3Xt6K_7AHaFM?rs=1&pid=ImgDetMain', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Trứng Chiên', 'gia_ban' => 25000, 'gia_khuyen_mai' => 22000, 'mo_ta' => 'Cơm trứng chiên giản dị', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2019/06/05/1171265/cach-lam-com-chien-trung-hat-com-toi-khong-bi-nhao-202203031523399671.jpg', 'id_danh_muc' => 20],
            ['ten_mon_an' => 'Cơm Thịt Rim', 'gia_ban' => 30000, 'gia_khuyen_mai' => 26000, 'mo_ta' => 'Cơm thịt rim ngọt mặn', 'hinh_anh' => 'https://imgs.vietnamnet.vn/Images/2017/03/21/11/20170321114313-thhit-lon2.jpg?width=0&s=PvkBZtQcCXDlEZCjXWwtFg', 'id_danh_muc' => 20],
        ];
        foreach ($monsQuan10 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 10, 'tinh_trang' => 1]);
        }

        // QUÁN 11-15: BÚN & PHỞ
        // QUÁN 11: Bún Bò Huế Đà Nẵng
        $monsQuan11 = [
            ['ten_mon_an' => 'Bún Bò Huế Đặc Biệt', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Bún bò Huế đầy đủ topping', 'hinh_anh' => 'https://static.vinwonders.com/production/bun-bo-hue-topbanner.jpg', 'id_danh_muc' => 49],
            ['ten_mon_an' => 'Bún Bò Huế Thường', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Bún bò Huế truyền thống', 'hinh_anh' => 'https://hoasenfoods.vn/wp-content/uploads/2024/01/bun-bo-hue.jpg', 'id_danh_muc' => 49],
            ['ten_mon_an' => 'Bún Bò Huế Giò Heo', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Bún bò Huế với giò heo', 'hinh_anh' => 'https://static.vinwonders.com/production/bun-bo-hue-topbanner.jpg', 'id_danh_muc' => 49],
            ['ten_mon_an' => 'Bún Bò Huế Chả Cua', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Bún bò Huế với chả cua', 'hinh_anh' => 'https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:format(webp):quality(75)/bun_cha_cua_thumb_7ae24d9f5c.JPG', 'id_danh_muc' => 49],
            ['ten_mon_an' => 'Bún Bò Nam Bộ', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Bún bò Nam Bộ trộn khô', 'hinh_anh' => 'https://tse3.mm.bing.net/th/id/OIP.CkTbR2IeD4bTP-eCJzS9qQHaEK?rs=1&pid=ImgDetMain', 'id_danh_muc' => 55],
            ['ten_mon_an' => 'Bún Bò Xào', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Bún bò xào sả ớt', 'hinh_anh' => 'https://file.hstatic.net/200000700229/article/bun-bo-xao-1_9b96d02d671d4884a43c7f0aebd04d1c.jpg', 'id_danh_muc' => 55],
            ['ten_mon_an' => 'Bún Bò Giò Heo', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Bún bò với giò heo luộc', 'hinh_anh' => 'https://www.huongnghiepaau.com/wp-content/uploads/2017/08/cach-nau-bun-bo-hue.jpg', 'id_danh_muc' => 49],
            ['ten_mon_an' => 'Bún Bò Tái', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Bún bò với thịt bò tái', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2019/06/27/1175792/cach-nau-bun-bo-tai-an-mot-cai-la-te-tai-ca-nguoi-202208301428003234.jpg', 'id_danh_muc' => 49],
        ];
        foreach ($monsQuan11 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 11, 'tinh_trang' => 1]);
        }

        // QUÁN 12: Bún Thịt Nướng Ngon
        $monsQuan12 = [
            ['ten_mon_an' => 'Bún Thịt Nướng Đặc Biệt', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Bún thịt nướng full topping', 'hinh_anh' => 'https://static.vinwonders.com/production/bun-thit-nuong-ha-noi-4.jpg', 'id_danh_muc' => 54],
            ['ten_mon_an' => 'Bún Thịt Nướng Chả Giò', 'gia_ban' => 48000, 'gia_khuyen_mai' => 43000, 'mo_ta' => 'Bún thịt nướng với chả giò', 'hinh_anh' => 'https://file.hstatic.net/200000700229/article/bun-thit-nuong-cha-gio-1_049ecb6eac20407ab13217579cdb1c73.jpg', 'id_danh_muc' => 54],
            ['ten_mon_an' => 'Bún Thịt Nướng Bì', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Bún thịt nướng với bì heo', 'hinh_anh' => 'https://tse1.mm.bing.net/th/id/OIP.rxRdASLv2X-bG40jc-J_NgHaEP?rs=1&pid=ImgDetMain', 'id_danh_muc' => 54],
            ['ten_mon_an' => 'Bún Thịt Nướng Chả', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Bún thịt nướng với chả trứng', 'hinh_anh' => 'https://cdn.tgdd.vn/2021/09/CookProduct/t-1200x676-3.jpg', 'id_danh_muc' => 54],
            ['ten_mon_an' => 'Bún Thịt Nướng Nem', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Bún thịt nướng với nem nướng', 'hinh_anh' => 'https://www.sgtiepthi.vn/wp-content/uploads/2020/11/T2_Bunnemnuong_nhahanghoangtam.jpg', 'id_danh_muc' => 54],
            ['ten_mon_an' => 'Bún Nem Nướng', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Bún với nem nướng thơm ngon', 'hinh_anh' => 'https://file.hstatic.net/200000562209/file/bun_nem_nuong_-_jamono_5dc5b32972fc4b5da720aed74bb636b1.jpg', 'id_danh_muc' => 54],
            ['ten_mon_an' => 'Bún Chả Giò', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Bún với chả giò giòn rụm', 'hinh_anh' => 'https://cdn.eva.vn/upload/2-2024/images/2024-05-30/cach-lam-bun-cha-gio-gion-rum-thom-ngon-kho-cuong-cua-nguoi-mien-nam-thay-bua-com-ngay-he-1-1717063328-377-width780height520.jpg', 'id_danh_muc' => 54],
            ['ten_mon_an' => 'Bún Thập Cẩm', 'gia_ban' => 50000, 'gia_khuyen_mai' => 45000, 'mo_ta' => 'Bún thập cẩm đầy đủ', 'hinh_anh' => 'https://gcs.tripi.vn/public-tripi/tripi-feed/img/473849IIz/bun-rieu-ba-kieu-1042342.jpg', 'id_danh_muc' => 54],
        ];
        foreach ($monsQuan12 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 12, 'tinh_trang' => 1]);
        }

        // QUÁN 13: Bún Chả Cá Hờn
        $monsQuan13 = [
            ['ten_mon_an' => 'Bún Chả Cá Lăng', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Bún chả cá lăng thơm ngon', 'hinh_anh' => 'https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:format(webp):quality(75)/2023_9_10_638299486131194600_cach-lam-cha-ca-lang-bang-noi-chien-khong-dau-thumb.jpg', 'id_danh_muc' => 57],
            ['ten_mon_an' => 'Bún Chả Cá Thu', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Bún chả cá thu ngon', 'hinh_anh' => 'https://cdn.tgdd.vn/2020/07/CookRecipe/Avatar/bun-ca-thu-thumbnail.jpg', 'id_danh_muc' => 57],
            ['ten_mon_an' => 'Bún Chả Cá Thác Lác', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Bún chả cá thác lác đặc biệt', 'hinh_anh' => 'https://cdn.tgdd.vn/2021/01/CookProduct/Thumb-1200x676-30.jpg', 'id_danh_muc' => 57],
            ['ten_mon_an' => 'Bún Chả Cá Hải Sản', 'gia_ban' => 48000, 'gia_khuyen_mai' => 43000, 'mo_ta' => 'Bún chả cá mix hải sản', 'hinh_anh' => 'https://cdn.tgdd.vn/2021/09/CookDish/huong-dan-chi-tiet-cach-lam-bun-cha-ca-nha-trang-chuan-vi-avt-1200x676.jpg', 'id_danh_muc' => 57],
            ['ten_mon_an' => 'Bún Cá Sứa', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Bún cá với sứa biển', 'hinh_anh' => 'https://statics.vinwonders.com/bun-sua-nha-trang-1_1632704947.jpg', 'id_danh_muc' => 57],
            ['ten_mon_an' => 'Bún Cá Rô Đồng', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Bún cá rô đồng đặc sản', 'hinh_anh' => 'https://www.huongnghiepaau.com/wp-content/uploads/2016/07/bun-ca-ro-dong.jpg', 'id_danh_muc' => 57],
            ['ten_mon_an' => 'Bún Riêu Cá', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Bún riêu cá chua ngọt', 'hinh_anh' => 'https://i.ytimg.com/vi/Xb-s5pPlbbc/maxresdefault.jpg', 'id_danh_muc' => 52],
            ['ten_mon_an' => 'Bún Cá Nước Trong', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Bún cá nước trong thanh mát', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2020/04/03/1246339/cach-nau-bun-ca-ha-noi-thom-ngon-chuan-vi-khong-ta-13.jpg', 'id_danh_muc' => 57],
        ];
        foreach ($monsQuan13 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 13, 'tinh_trang' => 1]);
        }

        // QUÁN 14: Bún Mắm Ngon
        $monsQuan14 = [
            ['ten_mon_an' => 'Bún Mắm Cá Linh', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Bún mắm cá linh đặc sản', 'hinh_anh' => 'https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:format(webp):quality(75)/cach_nau_bun_mam_ca_linh_1_9a6b506fd6.png', 'id_danh_muc' => 53],
            ['ten_mon_an' => 'Bún Mắm Tôm', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Bún mắm tôm đậm đà', 'hinh_anh' => 'https://cdn.tgdd.vn/2021/12/CookDishThumb/cach-lam-bun-dau-mam-tom-ngon-ngat-ngay-an-mot-lan-la-ghien-thumb-620x620.jpg', 'id_danh_muc' => 53],
            ['ten_mon_an' => 'Bún Mắm Thịt', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Bún mắm với thịt heo', 'hinh_anh' => 'https://tse4.mm.bing.net/th/id/OIP.WU9WCutYI7E-WbVKUzdsqQHaHa?rs=1&pid=ImgDetMain', 'id_danh_muc' => 53],
            ['ten_mon_an' => 'Bún Mắm Hải Sản', 'gia_ban' => 48000, 'gia_khuyen_mai' => 43000, 'mo_ta' => 'Bún mắm hải sản đặc biệt', 'hinh_anh' => 'https://tse3.mm.bing.net/th/id/OIP.VxcVQUGI7QEbOxlt8nmrOAHaEL?rs=1&pid=ImgDetMain', 'id_danh_muc' => 53],
            ['ten_mon_an' => 'Bún Mắm Cá Lóc', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Bún mắm cá lóc miền Tây', 'hinh_anh' => 'https://cdn.tgdd.vn/2021/03/CookRecipe/Avatar/bun-ca-loc-thumbnail.jpg', 'id_danh_muc' => 53],
            ['ten_mon_an' => 'Bún Mắm Nem', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Bún mắm nem đậm vị', 'hinh_anh' => 'https://cdn.vntrip.vn/cam-nang/wp-content/uploads/2016/12/huong-vi-thom-ngon-kho-quen-cua-mon-bun-mam-nem-da-nang-953-5.jpg', 'id_danh_muc' => 53],
            ['ten_mon_an' => 'Bún Nước Lèo', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Bún nước lèo An Giang', 'hinh_anh' => 'https://cdn.tgdd.vn/Files/2020/07/01/1266749/cach-nau-bun-nuoc-leo-soc-trang-ngon-dam-da-chuan-vi-an-mot-lan-la-nho-mai-202208301437543598.jpg', 'id_danh_muc' => 53],
        ];
        foreach ($monsQuan14 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 14, 'tinh_trang' => 1]);
        }

        // QUÁN 15: Phở Bò Đà Nẵng
        $monsQuan15 = [
            ['ten_mon_an' => 'Phở Bò Đặc Biệt', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Phở bò đầy đủ topping', 'hinh_anh' => 'https://tse1.mm.bing.net/th/id/OIP.Y6nFeTlHIC-wyKyR2Pj_zwHaFJ?rs=1&pid=ImgDetMain', 'id_danh_muc' => 50],
            ['ten_mon_an' => 'Phở Bò Tái', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Phở bò với thịt tái', 'hinh_anh' => 'https://cdnv2.tgdd.vn/mwg-static/common/Common/pho-tai-lan.jpg', 'id_danh_muc' => 50],
            ['ten_mon_an' => 'Phở Bò Chín', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Phở bò với thịt chín', 'hinh_anh' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFL8gNECDeK3gADaGZg2frA8YSPEAzu2Snxg&s', 'id_danh_muc' => 50],
            ['ten_mon_an' => 'Phở Bò Gầu', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Phở bò với gầu bò mềm', 'hinh_anh' => 'https://imgs.vietnamnet.vn/Images/2016/02/15/14/20160215143619-cach-nau-pho-bo-1p-143539911.jpg?width=0&s=t9nnM9JXCNS7pB2qObtcqw', 'id_danh_muc' => 50],
            ['ten_mon_an' => 'Phở Bò Nạm', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Phở bò với nạm bò', 'hinh_anh' => 'https://tse1.mm.bing.net/th/id/OIP.Y6nFeTlHIC-wyKyR2Pj_zwHaFJ?rs=1&pid=ImgDetMain', 'id_danh_muc' => 50],
            ['ten_mon_an' => 'Phở Bò Sách', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Phở bò với sách bò', 'hinh_anh' => 'https://chopstixpho.net/uploads/article/pho-tai-sach-1554883883.jpg', 'id_danh_muc' => 50],
            ['ten_mon_an' => 'Phở Gà', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Phở gà thơm ngon', 'hinh_anh' => 'https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:format(webp):quality(75)/cach_lam_pho_ga_vi_mien_bac_e16f1f49c8.jpg', 'id_danh_muc' => 50],
            ['ten_mon_an' => 'Phở Đặc Biệt', 'gia_ban' => 50000, 'gia_khuyen_mai' => 45000, 'mo_ta' => 'Phở đặc biệt full topping', 'hinh_anh' => 'https://tse1.mm.bing.net/th/id/OIP.Y6nFeTlHIC-wyKyR2Pj_zwHaFJ?rs=1&pid=ImgDetMain', 'id_danh_muc' => 50],
        ];
        foreach ($monsQuan15 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 15, 'tinh_trang' => 1]);
        }

        // QUÁN 16-20: MÌ QUẢNG
        // QUÁN 16: Mì Quảng 1A
        $monsQuan16 = [
            ['ten_mon_an' => 'Mì Quảng Gà', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Mì quảng gà truyền thống', 'hinh_anh' => 'https://i.ytimg.com/vi/g3V_oNeMdHs/maxresdefault.jpg', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Tôm', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Mì quảng với tôm tươi', 'hinh_anh' => 'https://tse4.mm.bing.net/th/id/OIP.PAXvKG2tiEQzJmJ-qIWRzQHaEK?rs=1&pid=ImgDetMain', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Thịt', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Mì quảng thịt heo', 'hinh_anh' => 'https://tse3.mm.bing.net/th/id/OIP.1hdGdrsFYUDvGi9VdnFH7QHaEL?rs=1&pid=ImgDetMain', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Hải Sản', 'gia_ban' => 50000, 'gia_khuyen_mai' => 45000, 'mo_ta' => 'Mì quảng hải sản đầy đủ', 'hinh_anh' => 'https://cdn.khamphadanang.vn/wp-content/uploads/2024/02/mi-quang-1a-hai-phong-3.jpg?strip=all&lossy=1&ssl=1', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Cá', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Mì quảng cá ngon', 'hinh_anh' => 'https://www.huongnghiepaau.com/wp-content/uploads/2017/08/cach-nau-mi-quang-ca-loc.jpg', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Đặc Biệt', 'gia_ban' => 55000, 'gia_khuyen_mai' => 50000, 'mo_ta' => 'Mì quảng đặc biệt full topping', 'hinh_anh' => 'https://cdn.khamphadanang.vn/wp-content/uploads/2024/02/mi-quang-1a-hai-phong-3.jpg?strip=all&lossy=1&ssl=1', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Bò', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Mì quảng bò ngon', 'hinh_anh' => 'https://vcdn1-ngoisao.vnecdn.net/2020/06/01/mi-bo1-1591004481-5291-1591005003.jpg?w=1200&h=0&q=100&dpr=1&fit=crop&s=xBN9UV9qANvYQpVMfdsu4g', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Chay', 'gia_ban' => 35000, 'gia_khuyen_mai' => 30000, 'mo_ta' => 'Mì quảng chay thanh đạm', 'hinh_anh' => 'https://hoangviettravel.vn/wp-content/uploads/2020/03/mi-quang-chay-da-nang-09-min.jpg', 'id_danh_muc' => 47],
        ];
        foreach ($monsQuan16 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 16, 'tinh_trang' => 1]);
        }

        // QUÁN 17: Mì Quảng Bếp Trang
        $monsQuan17 = [
            ['ten_mon_an' => 'Mì Quảng Ếch', 'gia_ban' => 45000, 'gia_khuyen_mai' => 40000, 'mo_ta' => 'Mì quảng ếch đặc sản', 'hinh_anh' => 'https://cdn.khamphadanang.vn/wp-content/uploads/2024/01/mi-quang-ech-bep-trang-2.jpg?strip=all&lossy=1&ssl=1', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Bò Kho', 'gia_ban' => 48000, 'gia_khuyen_mai' => 43000, 'mo_ta' => 'Mì quảng bò kho đậm đà', 'hinh_anh' => 'https://cdn11.dienmaycholon.vn/filewebdmclnew/public/userupload/files/kien-thuc/cach-nau-mi-quang-bo/cach-nau-mi-quang-bo-6.jpg', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Gà Xé', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Mì quảng gà xé thơm ngon', 'hinh_anh' => 'https://img-global.cpcdn.com/recipes/3f1c042425bb6652/680x482cq70/cach-n%E1%BA%A5u-nhan-mi-qu%E1%BA%A3ng-ga-recipe-main-photo.jpg', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Thịt Heo', 'gia_ban' => 38000, 'gia_khuyen_mai' => 33000, 'mo_ta' => 'Mì quảng thịt heo ngon', 'hinh_anh' => 'https://daynauan.info.vn/wp-content/uploads/2020/07/mi-quang-thit-heo.jpg', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Tôm Cua', 'gia_ban' => 50000, 'gia_khuyen_mai' => 45000, 'mo_ta' => 'Mì quảng tôm cua đặc sản', 'hinh_anh' => 'https://helenrecipes.com/wp-content/uploads/2021/05/Screenshot-2021-05-31-142423-1200x675.png', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Cá Thu', 'gia_ban' => 42000, 'gia_khuyen_mai' => 38000, 'mo_ta' => 'Mì quảng cá thu thơm ngon', 'hinh_anh' => 'https://os.beptrang.vn/uploads/menu/full_mi-quang-ca-thu-98-1572252870.jpg', 'id_danh_muc' => 47],
            ['ten_mon_an' => 'Mì Quảng Bò Viên', 'gia_ban' => 40000, 'gia_khuyen_mai' => 35000, 'mo_ta' => 'Mì quảng bò viên dai ngon', 'hinh_anh' => 'https://file.hstatic.net/200000700229/article/mi-bo-vien-1_bd39cac5b97a4e0b88504d12cc633b21.jpg', 'id_danh_muc' => 47],
        ];
        foreach ($monsQuan17 as $mon) {
            $monAn[] = array_merge($mon, ['id' => $id++, 'slug_mon_an' => \Illuminate\Support\Str::slug($mon['ten_mon_an']), 'id_quan_an' => 17, 'tinh_trang' => 1]);
        }

        // Continue với các quán còn lại...
        // Do giới hạn độ dài, sẽ thêm các quán 18-40 vào đợt sau

        DB::table('mon_ans')->insert($monAn);

        // Tăng giá sau khi insert
        DB::table('mon_ans')->update([
            'gia_ban' => DB::raw('CEIL(gia_ban * 1.0 / 1000) * 1000'),
            'gia_khuyen_mai' => DB::raw('CEIL(COALESCE(gia_khuyen_mai, gia_ban * 0.9) / 1000) * 1000'),
        ]);
    }
}
