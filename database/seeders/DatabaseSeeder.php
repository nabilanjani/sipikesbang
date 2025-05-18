<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Dukungan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ListUser::class,
            PostSeeder::class,
            DukunganSeeder::class,
        ]);
    }
}
