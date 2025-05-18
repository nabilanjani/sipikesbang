<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Staf;
use App\Models\Bidang;

class StafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('staf')->truncate(); // Kosongkan tabel staf
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ambil semua bidang dari database
        $bidangSekpri = Bidang::where('nama_bidang', 'Sekretariat Pribadi')->first();
        $bidangUmpeg = Bidang::where('nama_bidang', 'Sekretariat - Umum dan Kepegawaian')->first();
        $bidangKeu = Bidang::where('nama_bidang', 'Sekretariat - Keuangan')->first();
        $bidangProg = Bidang::where('nama_bidang', 'Sekretariat - Program')->first();
        $bidang1 = Bidang::where('nama_bidang', 'Bidang 1')->first();
        $bidang2 = Bidang::where('nama_bidang', 'Bidang 2')->first();
        $bidang3 = Bidang::where('nama_bidang', 'Bidang 3')->first();

        // Data staf
        $stafList = [
            ['nama' => 'Jeon Wonwoo', 'nip' => '123456789', 'email' => 'wonwoo@gmail.com', 'bidang_id' => $bidangSekpri->id],
            ['nama' => 'Drs. Muhammad Agung Hikmati, M. Si.', 'nip' => '197105011991011001', 'email' => 'agunghk@gmail.com', 'bidang_id' => $bidangSekpri->id],
            ['nama' => 'Choi Seungcheol', 'nip' => '987654321', 'email' => 'seungcheol@gmail.com', 'bidang_id' => $bidangUmpeg->id],
            ['nama' => 'Bhakti Wisnu Wardhana, S. I. P., M. Si.', 'nip' => '198712302007011003', 'email' => 'bhaktiws@gmail.com', 'bidang_id' => $bidangUmpeg->id],
            ['nama' => 'Chwe Hansol', 'nip' => '456789123', 'email' => 'vernon@gmail.com', 'bidang_id' => $bidangKeu->id],
            ['nama' => 'Aan Setiawan, S. E., AKT', 'nip' => '198109082009031005', 'email' => 'aanstw@gmail.com', 'bidang_id' => $bidangKeu->id],
            ['nama' => 'Kim Mingyu', 'nip' => '789123456', 'email' => 'mingyu@gmail.com', 'bidang_id' => $bidangProg->id],
            ['nama' => 'Wulandari, S. E., M. M.', 'nip' => '1971090441994032002', 'email' => 'wulandari@gmail.com', 'bidang_id' => $bidangProg->id],
            ['nama' => 'Yoon Jeonghan', 'nip' => '789456123', 'email' => 'jeonghan@gmail.com', 'bidang_id' => $bidang1->id],
            ['nama' => 'Pradhana Agung Nugraha, S. STP., M. M.', 'nip' => '198203312000121001', 'email' => 'pradhanaan@gmail.com', 'bidang_id' => $bidang1->id],
            ['nama' => 'Boo Seungkwan', 'nip' => '123789456', 'email' => 'seungkwan@gmail.com', 'bidang_id' => $bidang2->id],
            ['nama' => 'Musichah Setiasih, S. I. P., M. M., M. Eng.', 'nip' => '198009012010012018', 'email' => 'musichahst@gmail.com', 'bidang_id' => $bidang2->id],
            ['nama' => 'Lee Dokyeom', 'nip' => '321654987', 'email' => 'dokyeom@gmail.com', 'bidang_id' => $bidang3->id],
            ['nama' => 'Agung Kristiyanto, S. Sos.', 'nip' => '196702161997031004', 'email' => 'agungkris@gmail.com', 'bidang_id' => $bidang3->id],
        ];

        Staf::insert($stafList);
    }
}
