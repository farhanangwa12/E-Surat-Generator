<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            [
                'id_akun' => '3',
                'penyedia' => 'PT. MULTI INAR BANGUNAN',
                'direktur' => 'BUDI SUSANTI',
                'alamat_jalan' => 'Jalan Simpang kepuh No 199',
                'alamat_kota' => 'Surabaya',
                'alamat_provinsi' => 'Jawa Timur',
                'bank' => 'BANK BNI',
                'nomor_rek' => 908990,
            ]
           
        ];

        foreach ($vendors as $vendor) {
            Vendor::create($vendor);
        }
    }
}
