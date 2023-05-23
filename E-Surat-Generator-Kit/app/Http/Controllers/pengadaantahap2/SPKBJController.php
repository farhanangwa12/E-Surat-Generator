<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class SPKBJController extends Controller
{

    // Menampilkan detail data
    public function show($id, $isDownload)
    {
        $data = [
            // Bagian Kop Surat
            'nomor_pihak_pertama' => "111.SPK/DAN.01.03/200900/2022",
            'nomor_pihak_kedua' => '',


            'pengantar' => "Surat Perintah Kerja &RKS!F10&, untuk selanjutnya disebut Surat Perintah Kerja ini, ditandatangani pada hari &'SPK-BJ'!T10&, tanggal &'SPK-BJ'!T11& bulan &'SPK-BJ'!T12& tahun &'SPK-BJ'!T14&&'SPK-BJ'!S12&, oleh dan antara:",
            'pengantar_1' => "PT. PLN (PERSERO), suatu badan hukum yang didirikan berdasarkan Akta Notaris Sutjipto, S.H, di Jakarta Nomor : 169 tanggal 30 Juli 1994, yang telah disahkan dengan keputusan Menteri Kehakiman Republik Indonesia Nomor C211.519.HT.01.TH.94 beserta perubahannya, berkedudukan di Jalan Trunojoyo Blok M I/135, Kebayoran Baru, Jakarta 12160, dalam hal ini diwakili oleh Aris Kurniawan, selaku Manager PT PLN (Persero)  Unit Pelaksana Pembangkitan Timor berdasarkan Surat Kuasa General Manager PT PLN (Persero) Unit Induk Wilayah Nusa Tenggara Timur Nomor : 0018.SKU/DAN.01.03/C20000000/2021 Tanggal 03 Juni 2021, bertindak untuk dan atas nama PT. PLN (Persero) Unit Pelaksana Pembangkitan Timor berkedudukan di Jalan Diponegoro Kuanino - Kupang, untuk selanjutnya dalam Surat Perintah Kerja ini disebut PIHAK PERTAMA.",
            'pengantar_2' => "PT. MULTI DAYA MITRA," . (strpos("PT. MULTI DAYA MITRA", "PT") !== false ? "suatu badan hukum yang didirikan" : "suatu badan usaha yang didirikan") . " berdasarkan Akta Notaris Rina Rustianing Warni, S.H., Nomor 90 tanggal 20 Desember 2012, yang telah terdaftar berdasarkan Keputusan Menteri Hukum Dan Hak Asasi Manusia Republik Indonesia Nomor AHU-09748-AH.01.01 TAHUN 2013 tanggal 01 Maret 2013, dalam hal ini diwakili oleh DIAN BUDI YUNIATI selaku Direktur PT. MULTI DAYA MITRA, dengan demikian bertindak untuk dan atas nama PT. MULTI DAYA MITRA, berkedudukan di Jalan Manyar Airdas No. 15, Surabaya, Jawa Timur, untuk selanjutnya disebut PIHAK KEDUA.",

            'pengantar_berdasarkan' => [
                "Peraturan Direksi Nomor : 0022.P/DIR/2020 tanggal 02 Maret 2020 dan perubahannya No. 0156.P/DIR/2021 tanggal 30 Agustus 2021 tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero);",
                "Surat Kuasa Kerja Anggaran Operasi (MASTER'!B25&) Nomor : &S35& tanggal &TEXT(R35;d mmmm yyyy)&												
                ",
                "Rencana Kerja dan Syarat-Syarat (RKS) Nomor : &S37& tanggal &TEXT(R37;d mmmm yyyy)&;												
                ",
                "Undangan Pengadaan Barang/Jasa Nomor : &S38& tanggal &TEXT(R38;d mmmm yyyy)&;												
                ",
                "Surat Penawaran Harga PIHAK KEDUA Nomor : &S40& tanggal &TEXT(R40;d mmmm yyyy)&;												
                ",
                "Berita Acara Negoisasi Penawaran Nomor : &S41& tanggal &TEXT(R41;d mmmm yyyy)&;
                ",
                "Berita Acara Hasil Pengadaan Langsung Nomor : &S42& tanggal &TEXT(R42;d mmmm yyyy)",

            ],
            'pengantar_mengingatkan' => [
                'a' => 'PIHAK PERTAMA menunjuk PIHAK KEDUA untuk melaksanakan "&RKS!F10&", untuk selanjutnya disebut Pekerjaan;',
                'b' => 'PIHAK KEDUA telah menyetujui untuk melaksanakan Pekerjaan yang diberikan oleh PIHAK PERTAMA sesuai dengan persyaratan dan ketentuan dalam Surat Perintah Kerja ini;',
                'c' => 'PARA PIHAK memiliki kewenangan untuk menandatangani Surat Perintah Kerja ini, dan mengikat pihak yang diwakili;',
                'd' => 
                [

                    'i' => 'Menandatangani Surat Perintah Kerja ini setelah meneliti secara patut;',
                    'ii' => 'Telah membaca dan memahami secara penuh ketentuan Surat Perintah Kerja ini;',
                    'iii' => 'Telah mendapatkan kesempatan yang memadai untuk memeriksa dan mengkonfirmasikan semua ketentuan dalam Surat Perintah Kerja ini beserta semua fakta dan kondisi yang terkait.'
                ]
            ],
            'logopln' => public_path('tampilan/sampul/logopln.png'),
            'baris_bawah' => public_path('tampilan/sampul/garisbawah.png') // path ke file header gambar


        ];
        // dd($data['pengantar_2']);
        $pdf = PDF::loadView('plnpengadaan.kontraktahap2.spkbj.spkbj', $data);
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'SPKBJ' . time() . '.pdf';

        if ($isDownload == 1) {
            // Menampilkan output di browser
            return $pdf->stream($namefile);
        } else if ($isDownload == 2) {
            // Download file
            return $pdf->download($namefile);
        } else {
            return "Parameter tidak valid";
        }
    }

    // Menampilkan form untuk mengedit data
    public function edit($id)
    {
    }

    // Mengupdate data ke database
    public function update(Request $request, $id)
    {
    }

    // Menghapus data dari database
    public function destroy($id)
    {
    }
}
