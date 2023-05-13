<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $users = [
            [
                'name' => 'Pengadaan',
                'email' => 'pengadaan@example.com',
                'password' => bcrypt('password'),
                'role' => 'pengadaan',
                'picture_profile' => 'default.jpg'
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@example.com',
                'password' => bcrypt('password'),
                'role' => 'manager',
                'picture_profile' => 'default.jpg'

            ],
            [
                'name' => 'Vendor',
                'email' => 'vendor@example.com',
                'password' => bcrypt('password'),
                'role' => 'vendor',
                'picture_profile' => 'default.jpg'

            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
