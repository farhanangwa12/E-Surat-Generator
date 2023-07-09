<?php

namespace Database\Seeders;

use App\Models\JenisDokumenKelengkapan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            [
                'nama_dokumen' => 'Nomor & Tanggal Surat Penawaran
            ',
                'dokumen_sistem' => 'ya',
       
                'keterangan' => 'Dokumen Surat Penawaran'
            ],
            [
                'nama_dokumen' => 'Harga/Nilai Penawaran
            ',
                'dokumen_sistem' => 'ya',
                'keterangan' => 'Lampiran Surat Penawaran'
            ],
            ['nama_dokumen' => 'SIUP/SIUJK/SIUJPTL dengan kegiatan usaha yang sesuai untuk pengadaan ini dan masih berlaku
            '],
            ['nama_dokumen' => 'Akte Pendirian Perusahaan beserta perubahan terakhir
            '],
            ['nama_dokumen' => 'Keputusan MENKUMHAM 
            '],
            ['nama_dokumen' => 'Nomor Pokok Wajib Pajak (NPWP) Perusahaan
            '],
            ['nama_dokumen' => 'Ijin Gangguan/SITU/Surat Domisili/Izin Lokasi
            '],
            ['nama_dokumen' => 'Surat Tanda Daftar Perusahaan (TDP) atau Nomor Induk Berusaha (NIB)

            '],
            [
                'nama_dokumen' => 'Pakta Integritas
            ',
                'dokumen_sistem' => 'ya'
            ],
            [
                'nama_dokumen' => 'Surat Pernyataan Sanggup Menyelesaikan Pekerjaan Dengan Baik;',
                'dokumen_sistem' => 'ya'
            ],
            [
                'nama_dokumen' => 'Surat Pernyataan Garansi Pekerjaan
            ',
                'dokumen_sistem' => 'ya'
            ],
            [
                'nama_dokumen' => 'Memiliki Pengalaman Pengadaan sejenis dibuktikan dengan Salinan Kontrak/SPK
            ',
                'dokumen_sistem' => 'ya'
            ],
            ['nama_dokumen' => 'Memiliki kemampuan menyediakan fasilitas berupa peralatan yang diperlukan untuk pelaksanaan pekerjaan
            '],
            ['nama_dokumen' => 'Dokumen HIRARC (Hazard Identification Risk Assessment And Risk Control) Dan JSA (Job Safety Analysist)
            '],
            ['nama_dokumen' => 'Surat Pernyataan Penerapan K3L
            '],
            // [
            //     'nama_dokumen' => 'Neraca/Laporan keuangan Perusahaan terakhir yang memuat laporan laba rugi
            // ',
            //     'dokumen_sistem' => 'ya'
            // ],
            ['nama_dokumen' => 'Tanda Terima penyampaian Surat Pajak Tahunan (SPT) Pajak Penghasilan (PPh) tahun terkahir, dan Surat Setoran Pajak (SSP) PPh,    Pasal 21 atau Pajak Pertambahan Nilai (PPN) sekurang-kurangnya 3 (tiga) bulan terakhir
            '],
            ['nama_dokumen' => 'Dokumen penunjang lainnya 
            '],


        );
        foreach ($data as $key) {
            JenisDokumenKelengkapan::create($key);
        }
    }
}
