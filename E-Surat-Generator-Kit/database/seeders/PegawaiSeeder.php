<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Pegawai::create([
            'nama_pegawai' => 'John Doe',
            'jabatan' => 'Pengadaan',
            'nomor_jabatan' => '12345'
        ]);

        Pegawai::create([
            'nama_pegawai' => 'Jane Doe',
            'jabatan' => 'Manager',
            'nomor_jabatan' => '67890'
        ]);
    }
}
