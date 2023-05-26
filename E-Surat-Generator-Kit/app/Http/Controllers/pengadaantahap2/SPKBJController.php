<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PDF;

class SPKBJController extends Controller
{

    // Menampilkan detail data
    public function show($id, $isDownload)
    {

        $kontrakkerja = KontrakKerja::with('vendor')->find($id);
        $pembuatansurat = PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->get();
        $pembuatansurat = Collection::make($pembuatansurat)->groupBy('nama_surat')->toArray();

        $pengadaan = Penyelenggara::where('id_kontrakkerja', $id)->where('nama_jabatan', 'pejabat_pelaksana_pengadaan')->first();

        $data = [
            // Bagian Kop Surat
            'nomor_pihak_pertama' => $pembuatansurat['nomor_rks'][0]['no_surat'],
            'nomor_pihak_kedua' => '',


            'pengantar' => "Surat Perintah Kerja &RKS!F10&, untuk selanjutnya disebut Surat Perintah Kerja ini, ditandatangani pada hari &'SPK-BJ'!T10&, tanggal &'SPK-BJ'!T11& bulan &'SPK-BJ'!T12& tahun &'SPK-BJ'!T14&&'SPK-BJ'!S12&, oleh dan antara:",
            'pengantar_1' => "PT. PLN (PERSERO), suatu badan hukum yang didirikan berdasarkan Akta Notaris Sutjipto, S.H, di Jakarta Nomor : 169 tanggal 30 Juli 1994, yang telah disahkan dengan keputusan Menteri Kehakiman Republik Indonesia Nomor C211.519.HT.01.TH.94 beserta perubahannya, berkedudukan di Jalan Trunojoyo Blok M I/135, Kebayoran Baru, Jakarta 12160, dalam hal ini diwakili oleh Aris Kurniawan, selaku Manager PT PLN (Persero)  Unit Pelaksana Pembangkitan Timor berdasarkan Surat Kuasa General Manager PT PLN (Persero) Unit Induk Wilayah Nusa Tenggara Timur Nomor : 0018.SKU/DAN.01.03/C20000000/2021 Tanggal 03 Juni 2021, bertindak untuk dan atas nama PT. PLN (Persero) Unit Pelaksana Pembangkitan Timor berkedudukan di Jalan Diponegoro Kuanino - Kupang, untuk selanjutnya dalam Surat Perintah Kerja ini disebut PIHAK PERTAMA.",
            'pengantar_2' => (strpos($kontrakkerja->vendor->penyedia, "PT") !== false ? "suatu badan hukum yang didirikan" : "suatu badan usaha yang didirikan") . " berdasarkan Akta Notaris Rina Rustianing Warni, S.H., Nomor 90 tanggal 20 Desember 2012, yang telah terdaftar berdasarkan Keputusan Menteri Hukum Dan Hak Asasi Manusia Republik Indonesia Nomor AHU-09748-AH.01.01 TAHUN 2013 tanggal 01 Maret 2013, dalam hal ini diwakili oleh DIAN BUDI YUNIATI selaku Direktur PT. MULTI DAYA MITRA, dengan demikian bertindak untuk dan atas nama PT. MULTI DAYA MITRA, berkedudukan di Jalan Manyar Airdas No. 15, Surabaya, Jawa Timur, untuk selanjutnya disebut PIHAK KEDUA.",

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

            ],
            'pasal3' => [
                2 => [
                    "Selama masa berlakunya Surat Perintah Kerja ini, PIHAK PERTAMA menunjuk",
                    "&MASTER!F45&",
                    "sebagai",
                    "DIREKSI PEKERJAAN."
                ],
                3 => [
                    "Untuk membantu tugas-tugas DIREKSI PEKERJAAN, PIHAK PERTAMA menunjuk",
                    "&MASTER!F46&",
                    "sebagai",
                    "PENGAWAS PEKERJAAN."
                ],
                5 => [
                    "Dalam hal Pengawasan Keselamatan dan Kesehatan Kerja (K3) serta Lingkungan, PIHAK PERTAMA menunjuk",
                    "&MASTER!F47&",
                    "sebagai", "PENGAWAS K3L."
                ]


            ],
            'pasal5' => [
                1 => [
                    "PIHAK PERTAMA menunjuk PIHAK KEDUA untuk melaksanakan &RKS!F10& sesuai dengan rincian jumlah dan harga pada Lampiran Surat Perintah Kerja ini:",
                    "h" => $kontrakkerja->nama_lokasi,
                ],
                2 => [
                    "PIHAK KEDUA dalam melaksanakan pekerjaan dan melaksanakan pemasangan peralatan untuk &RKS!F10& harus memperhatikan Prosedur Pelaksanaan Pekerjaan dan Spesifikasi Teknik sebagaimana yang tercantum dalam KAK/RKS yang merupakan satu kesatuan yang utuh dan tidak terpisahkan dari Surat Perintah Kerja ini.",
                ],

            ],
            'pasal6' => [
                2 => "Waktu pelaksanaan pekerjaan Surat Perintah Kerja ini adalah berlaku untuk jangka waktu &R342& terhitung mulai sejak tanggal penandatanganan Surat Perintah Kerja ini atau terhitung mulai sejak tanggal &TEXT(R341;dd mmmm yyyy)& sampai dengan berakhir tanggal &TEXT(R343;dd mmmm yyyy)&, &R345&.",
                5 => [
                    "a" => "Kinerja yang baik atau memenuhi persyaratan-persyaratan yang ditetapkan dalam Surat Perintah Kerja ini maupun yang tercantum dalam Dokumen Tender/RKS Nomor : &S37& tanggal &TEXT(R37;d mmmm yyyy)& yang merupakan satu kesatuan yang utuh dan tidak terpisahkan dari Surat Perintah Kerja ini;",
                ],

            ],
            'pasal7' => [
                3 => "Penyerahan pekerjaan adalah di &R412& PLN UPK Timor dan harus memperhatikan prosedur pekerjaan sesuai dengan lingkup pekerjaan sebagaimana dimaksud pada Pasal 5 Surat Perintah Kerja ini.",
            ],
            'pasal8' => [
                1 => "Pekerjaan ini dibiayai dari sumber pendanaan APLN Anggaran Operasi (&MASTER!B26&) tahun 2022 Nomor : &R434& tanggal &TEXT(R435;d mmmm yyyy)&.",
                2 => "Total Nilai Surat Perintah Kerja ini adalah sebesar &TEXT(R436;Rp 0.0,00)& (&S436&).",
            ],

            'pasal11' => [
                12 => [
                    'bank' => $kontrakkerja->vendor->bank,
                    'nama_rekening' => $kontrakkerja->vendor->penyedia,
                    'nomor_rekening' => $kontrakkerja->no_rek
                ]
            ],

            'pasal33' => [
                2 => [
                    strtoupper($kontrakkerja->vendor->penyedia),
                    $kontrakkerja->vendor->alamat_jalan . ', ' . ucfirst($kontrakkerja->vendor->alamat_kota) . ', ' . ucfirst($kontrakkerja->vendor->alamat_provinsi),
                    "Telepon",
                    $kontrakkerja->vendor->email_perusahaan
                ]
            ],
            'penyedia' => $kontrakkerja->vendor->penyedia,
            'direktur' => $kontrakkerja->vendor->direktur,
            'pekerjaan_pengadaan' => $pengadaan,









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
