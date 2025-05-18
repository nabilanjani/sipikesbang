<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'usertype' => 'admin',
                'name' => 'Nabila Betari Anjani',
                'email' => 'admin@gmail.com',
                'password' => 'admin123',
            ],
            [
                'usertype' => 'umpeg',
                'name' => 'Umum dan Kepegawaian',
                'email' => 'umpeg@gmail.com',
                'password' => 'umpeg123',
            ],
            [
                'usertype' => 'staf',
                'name' => 'Staf Badan Kesbangpol',
                'email' => 'staf@gmail.com',
                'password' => 'staf123',
            ],
        ];
        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            User::create($user);
        }
    }
}
