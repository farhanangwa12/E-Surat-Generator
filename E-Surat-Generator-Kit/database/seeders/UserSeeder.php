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


        User::create([
          
            'name' => 'John Doe',
            'email' => 'pengadaan@example.com',
            'vendor_id' => null,
            'pegawai_id' => 1,
            'password' => bcrypt('password'),
            'role' => 'pengadaan'
        ]);

        User::create([
           
            'name' => 'Jane Doe',
            'email' => 'manager@example.com',
            'vendor_id' => null,
            'pegawai_id' => 2,
            'password' => bcrypt('password'),
            'role' => 'manager'
        ]);

        User::create([
          
            'name' => 'Bob Smith',
            'email' => 'vendor@example.com',
            'vendor_id' => 1,
            'pegawai_id' => null,
            'password' => bcrypt('password'),
            'role' => 'vendor'
        ]);
    }
}
