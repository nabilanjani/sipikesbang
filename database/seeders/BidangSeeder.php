<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bidang;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bidangList = [
            ['nama_bidang' => 'Sekretariat Pribadi'],
            ['nama_bidang' => 'Sekretariat - Umum dan Kepegawaian'],
            ['nama_bidang' => 'Sekretariat - Keuangan'],
            ['nama_bidang' => 'Sekretariat - Program'],
            ['nama_bidang' => 'Bidang 1'],
            ['nama_bidang' => 'Bidang 2'],
            ['nama_bidang' => 'Bidang 3'],
        ];

        Bidang::insert($bidangList);
    }
}
