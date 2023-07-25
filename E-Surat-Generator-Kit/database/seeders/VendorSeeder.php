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
        // $vendors = [
        //     [
        //         'id_akun' => '3',
        //         'penyedia' => 'PT. MULTI INAR BANGUNAN',
        //         'direktur' => 'BUDI SUSANTI',
        //         'alamat_jalan' => 'Jalan Simpang kepuh No 199',
        //         'alamat_kota' => 'Surabaya',
        //         'alamat_provinsi' => 'Jawa Timur',
        //         'bank' => 'BANK BNI',
        //         'nomor_rek' => 908990,
        //         'telepon' => "0918293003",
        //         'website' => 'wwww.multiinarbangunan.com',
        //         'faksimili' => '(023) 123414',
        //         'email_perusahaan' => 'inarbangunan@office.com'
        //     ]

        // ];

        // foreach ($vendors as $vendor) {
        //     Vendor::create($vendor);
        // }
        Vendor::create([
            'penyedia' => 'PT. MULTI INAR BANGUNAN',
            'direktur' => 'BUDI SUSANTI',
            'alamat_jalan' => 'Jalan Simpang kepuh No 199',
            'alamat_kota' => 'Surabaya',
            'alamat_provinsi' => 'Jawa Timur',
            'bank' => 'BANK MANDIRI',
            'nomor_rek' => '14211111111',
            'telepon' => '(021) 1234567',
            'website' => 'http://www.ptabc.com',
            'faksimili' => '(021) 1234568',
            'email_perusahaan' => 'info@ptabc.com',
            'pengawas_pekerjaan' => 'Pengawas Pekerjaan',
            'pengawas_k3' => 'Pengawas K3'
        ]);
    }
}
