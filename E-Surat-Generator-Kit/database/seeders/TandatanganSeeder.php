<?php

namespace Database\Seeders;

use App\Models\TandaTangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TandatanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TandaTangan::create([
            'kode_unik' => 'ABC123',
            'id_akun' => 1,
          
            'save_file_path' => 'tandatangan'
        ]);

        TandaTangan::create([
            'kode_unik' => 'DEF456',
            'id_akun' => 2,
           
            'save_file_path' => 'tandatangan'
        ]);

        TandaTangan::create([
            'kode_unik' => 'GHI789',
            'id_akun' => 3,
       
            'save_file_path' => 'tandatangan'
        ]);
    }
}
