<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'description' => 'Printer, Scanner, Penghancur Kertas, PC, AC.',
            ],
            [
                'name' => 'Alat Tulis Kantor',
                'description' => 'Gunting, Map, Amplop.',
            ],
            [
                'name' => 'Barang Operasional',
                'description' => 'Karpet, Mic, Speaker.',
            ],
            [
                'name' => 'Alat Kebersihan',
                'description' => 'Pel, Sapu, Tisu.',
            ],
            [
                'name' => 'Milik Kesbangpol',
                'description' => 'Amplop Kop, Map Kop.',
            ],
        ];
        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['name' => $category['name']], // Cek berdasarkan 'name'
                [
                    'description' => $category['description'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
