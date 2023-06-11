<?php

namespace App\Http\Controllers\pengadaantahap1;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\RKS;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use App\Models\SumberAnggaran;
use App\Models\TandaTangan;
use App\Models\Vendor;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use DNS2D;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Terbilang;

class RKSController extends Controller
{
    public function refresh($id)
    {

        // Mengecek apakah record rks ada
        $rks = RKS::where('id_kontrakkerja', $id)->first();


        if (!$rks) {
           // Jika record und tidak ada

            // Buat instance und model untuk menyimpan data
            $rks1 = new RKS();
            $rks1->id_kontrakkerja = $id; // Mengambil nilai id dari $id
            $rks1->datarks = null; // Mengatur nilai datarks1 sebagai null
            $rks1->tandatangan_pengadaan = null; // Mengatur nilai tandatangan_pengadaan sebagai null
            $rks1->tanggal_tandatangan_pengadaan = null; // Mengatur nilai tanggal_tandatangan_pengadaan sebagai null
            $rks1->tandatangan_manager = null; // Mengatur nilai tandatangan_manager sebagai null
            $rks1->tanggal_tandatangan_manager = null; // Mengatur nilai tanggal_tandatangan_manager sebagai null
            $rks1->save();
        } else {
            
        }

        return 'Data Telah Direfresh';
    }
    public function showrks($id, $isDownload)
    {
        $this->refresh($id);
        $kontrakkerja = KontrakKerja::find($id);
        $vendor = Vendor::find($kontrakkerja->id_vendor);

        $nama_pekerjaanrks =  strtoupper($kontrakkerja->nama_kontrak) . " PT PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR";

        $jumlah_harikontrak =  Carbon::parse($kontrakkerja->tanggal_pekerjaan)->diffInDays($kontrakkerja->tanggal_akhir_pekerjaan);

        // Tanggal batas Penawaran
        $tanggalbataspenawaran = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'batas_akhir_dokumen_penawaran')->first()->tanggal_pembuatan;
        $masterharitanggal = Carbon::createFromFormat('Y-m-d', $tanggalbataspenawaran)->locale('id')->isoFormat('dddd / D MMMM YYYY');
        $sumberanggaran = SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first();
        $surat = [
            'nomor' => PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_surat', 'nomor_rks')->first()->no_surat,
            'tanggal' => Carbon::createFromFormat('Y-m-d', PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_surat', 'nomor_rks')->first()->tanggal_pembuatan)->locale('id')->isoFormat('DD MMMM YYYY'),
            'pekerjaan' => $nama_pekerjaanrks,

            // Bagian BAB 1
            'bab_1_2' =>   "Dalam permintaan penawaran harga ini Penyedia Barang/Jasa diminta menawarkan harga untuk pekerjaan : " . $nama_pekerjaanrks,
            'bab_1_3_tanggal' =>   $masterharitanggal,
            'bab_1_3_pukul' =>   "16:30 Wita",
            'bab_1_5' =>   "Di dalam surat penawaran harga tersebut mencantumkan kesanggupan jangka waktu pelaksanaan pekerjaan adalah " . $jumlah_harikontrak . " (" . Terbilang::make($jumlah_harikontrak) . ") hari kalender terhitung sejak berdasarkan Surat Perintah Kerja (SPK) ditandatangani.
            ",
            // 'bab_1_6' =>   "Pekerjaan ini akan dibiayai dari sumber dana &MASTER!B26& Nomor : ". SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->skk_ao ."  tanggal ".SumberAnggaran::where('id_kontrakkerja')->first()->tanggal_anggaran."",
            'bab_1_6' =>   "Pekerjaan ini akan dibiayai dari sumber dana SKK-AO Nomor : " . $sumberanggaran->skk_ao . "  tanggal ".$sumberanggaran->tanggal_anggaran."",
            'bab_1_7' =>   $kontrakkerja->lokasi_pekerjaan,



            // Bagian BAB 2
            'bab_2_1' =>   "Yang dimaksud dengan $nama_pekerjaanrks secara lebih khusus diperjelas dalam Spesifikasi Teknik/KAK.",
            'bab_2_2' =>   "PT PLN (Persero) dalam hal ini diwakilkan oleh {Manager} PT PLN (Persero) Unit Induk Wilayah NTT Unit Pelaksana Pembangkitan Timor sebagai Pengguna Barang/Jasa yang bertindak sebagai PIHAK PERTAMA di dalam Kontrak/SPK dan dalam pelaksanaan pekerjaan di bantu oleh Direksi Pekerjaan dan Pengawas Pekerjaan.",
            'bab_2_4_nama' =>   "PT PLN (Persero) UIW NTT UPK TIMOR cq. {Manager}",
            'bab_2_4_alamat' =>   "Jalan Diponegoro Kuanino, Kupang 85119",

            'bab_2_5_direksipekerjaan' =>   Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'direksi')->first()->nama_pengguna,
            'bab_2_5_pengawaspekerjaan' =>   Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pengawas_pekerjaan')->first()->nama_pengguna,
            'bab_2_5_pengawask3' =>  Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pengawas_k3')->first()->nama_pengguna,
            'bab_2_7' =>   $jumlah_harikontrak . "( " . ucwords(Terbilang::make($jumlah_harikontrak)) . " ) " . "hari kalender",
            'bab_2_8_kontrak' =>   "Kontrak Pengadaan Pekerjaan ini dibiayai dari APLN &MASTER!B26&.",
            'bab_2_8_nomor' =>   "Nomor : " . SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->skk_ao,
            //  'bab_2_8_tanggal' =>   "Tanggal : ". Carbon::parse("2023-12-20")->locale('id')->format('j F Y'),
            'bab_2_8_tanggal' =>   "Tanggal : " . Carbon::parse(SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->tanggal_anggaran)->locale('id')->isoFormat('Do MMMM YYYY'),
            'bab_2_10_1' =>   "Yang dimaksud dengan garansi adalah masa dimana Penyedia Barang/Jasa harus menjamin atas seluruh pekerjaan yang diserahterimakan kepada Pengguna Barang/Jasa dalam keadaan baik dan sesuai dengan Persyaratan/Speck Teknik/KAK dan Penyedia Barang/Jasa masih berkewajiban untuk melakukan penggantian jika pekerjaan yang dilaksanakan tidak sesuai dengan Persyaratan/Speck Teknik/KAK dan atau terjadi kerusakan selama dalam pengiriman oleh Penyedia Barang/Jasa ke lokasi penyerahan pekerjaan;",
            'bab_2_10_4' =>  "Penyedia Barang/Jasa wajib mengganti/memperbaiki sebagian atau keseluruhan dari pekerjaan yang ditolak tersebut dengan yang sesuai Persyaratan/Speck Teknik/KAK tanpa ada biaya tambahan dari Pengguna Barang/Jasa;",

            // Bagian BAB 6
            'bab_6_2' =>   "Pengguna Barang/Jasa menganggap bahwa semua macam pekerjaan yang telah diuraikan dalam Speck teknik / KAK / Persyaratan (RKS) serta (Bill of quantity (BoQ) ini seluruhnya termasuk $nama_pekerjaanrks harus diajukan dalam penawaran ini.",
            'bab_6_3' =>   "Pengguna Barang/Jasa menunjuk " . Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'direksi')->first()->nama_pengguna . " sebagai Direksi Pekerjaan yang diberi kuasa penuh untuk mengawasi/ mengontrol/ mengecek/memeriksa pengadaan pekerjaan dan menunjuk " . Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pengawas_pekerjaan')->first()->nama_pengguna . "  sebagai pengawas pekerjaan serta menunjuk " . Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pengawas_k3')->first()->nama_pengguna . " sebagai Pengawas K3.",

            // Bagian Nama Terang Tanda tangan
            'namaterang_manager' =>   Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'manager')->first()->nama_pengguna,
            'namaterang_pengadaan' =>  Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pejabat_pelaksana_pengadaan')->first()->nama_pengguna,
            'tandatangan_manager' => RKS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first() == null ?  '0'  : RKS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->tandatangan_manager,
            'tandatangan_pengadaan' => RKS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first() == null ?  '0'  : RKS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->tandatangan_pengadaan,
            // Isian Vendor
            'nama' => $vendor->penyedia,
            'alamat' =>  "$vendor->alamat_jalan , $vendor->alamat_kota, $vendor->alamat_provinsi.",
            'telepon' =>  $vendor->telepon == null ? '.....................' : $vendor->telepon,
            'website' =>  $vendor->website == null ? '.....................' : $vendor->website,
            'faksimili' =>  $vendor->faksimili == null ? '.....................' : $vendor->faksimili,
            'email' =>  $vendor->email_perusahaan == null ? '.....................' : $vendor->email_perusahaan,
            'pengawasPekerjaan' =>  "..................." . "belum",
            'pengawasK3' =>  "..................." . "belum"





        ];
        $surat = json_decode(json_encode($surat));
        $data = [
            'logokiri' => public_path('undangan/kiri.jpg'),
            'logo' => public_path('undangan/logo.png'), // path ke file header gambar
            'tandatangan' =>   DNS2D::getBarcodePNG('4', 'QRCODE'),
            'surat' => $surat


        ];
        $pdf = PDF::loadView('plnpengadaan.kontraktahap1.RKS.rks', $data);
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'RKS_' . time() . '.pdf';
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
    public function isirks($id)
    {
        // echo "test";

        $kontrakkerja = KontrakKerja::find($id);
        $vendor = Vendor::find($kontrakkerja->id_vendor);

        $nama_pekerjaanrks =  strtoupper($kontrakkerja->nama_kontrak) . " PT PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR";

        $jumlah_harikontrak =  Carbon::parse($kontrakkerja->tanggal_pekerjaan)->diffInDays($kontrakkerja->tanggal_akhir_pekerjaan);

        $surat = [
            'nomor' => PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_surat', 'nomor_rks')->first()->no_surat,
            'tanggal' => Carbon::createFromFormat('Y-m-d', PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_surat', 'nomor_rks')->first()->tanggal_pembuatan)->locale('id')->isoFormat('DD MMMM YYYY'),
            'pekerjaan' => $nama_pekerjaanrks,

            // Bagian BAB 1
            'bab_1_2' =>   "Dalam permintaan penawaran harga ini Penyedia Barang/Jasa diminta menawarkan harga untuk pekerjaan : " . $nama_pekerjaanrks,
            'bab_1_3_tanggal' =>   "Rabu / 28 Desember 2022 Belum",
            'bab_1_3_pukul' =>   "16:30 Wita Belum",
            'bab_1_5' =>   "Di dalam surat penawaran harga tersebut mencantumkan kesanggupan jangka waktu pelaksanaan pekerjaan adalah " . $jumlah_harikontrak . " (" . Terbilang::make($jumlah_harikontrak) . ") hari kalender &Q27& Belum.",
            // 'bab_1_6' =>   "Pekerjaan ini akan dibiayai dari sumber dana &MASTER!B26& Nomor : ". SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->skk_ao ."  tanggal ".SumberAnggaran::where('id_kontrakkerja')->first()->tanggal_anggaran."",
            'bab_1_6' =>   "Pekerjaan ini akan dibiayai dari sumber dana &MASTER!B26& Nomor : " . SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->skk_ao . "  tanggal 20-12-2023 Belum",
            'bab_1_7' =>   $kontrakkerja->lokasi_pekerjaan,



            // Bagian BAB 2
            'bab_2_1' =>   "Yang dimaksud dengan $nama_pekerjaanrks secara lebih khusus diperjelas dalam Spesifikasi Teknik/KAK.",
            'bab_2_2' =>   "PT PLN (Persero) dalam hal ini diwakilkan oleh {Manager} PT PLN (Persero) Unit Induk Wilayah NTT Unit Pelaksana Pembangkitan Timor sebagai Pengguna Barang/Jasa yang bertindak sebagai PIHAK PERTAMA di dalam Kontrak/SPK dan dalam pelaksanaan pekerjaan di bantu oleh Direksi Pekerjaan dan Pengawas Pekerjaan.",
            'bab_2_4_nama' =>   "PT PLN (Persero) UIW NTT UPK TIMOR cq. {Manager}",
            'bab_2_4_alamat' =>   "Jalan Diponegoro Kuanino, Kupang 85119",

            'bab_2_5_direksipekerjaan' =>   Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'direksi')->first()->nama_pengguna,
            'bab_2_5_pengawaspekerjaan' =>   Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pengawas_pekerjaan')->first()->nama_pengguna,
            'bab_2_5_pengawask3' =>  Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pengawas_k3')->first()->nama_pengguna,
            'bab_2_7' =>   $jumlah_harikontrak . "( " . ucwords(Terbilang::make($jumlah_harikontrak)) . " ) " . "hari kalender",
            'bab_2_8_kontrak' =>   "Kontrak Pengadaan Pekerjaan ini dibiayai dari APLN &MASTER!B26&.",
            'bab_2_8_nomor' =>   "Nomor : " . SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->skk_ao,
            //  'bab_2_8_tanggal' =>   "Tanggal : ". Carbon::parse("2023-12-20")->locale('id')->format('j F Y'),
            'bab_2_8_tanggal' =>   "Tanggal : " . Carbon::parse(SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->tanggal_anggaran)->locale('id')->isoFormat('Do MMMM YYYY'),
            'bab_2_10_1' =>   "Yang dimaksud dengan garansi adalah masa dimana Penyedia Barang/Jasa harus menjamin atas seluruh pekerjaan yang diserahterimakan kepada Pengguna Barang/Jasa dalam keadaan baik dan sesuai dengan Persyaratan/Speck Teknik/KAK dan Penyedia Barang/Jasa masih berkewajiban untuk melakukan penggantian jika pekerjaan yang dilaksanakan tidak sesuai dengan Persyaratan/Speck Teknik/KAK dan atau terjadi kerusakan selama dalam pengiriman oleh Penyedia Barang/Jasa ke lokasi penyerahan pekerjaan;",
            'bab_2_10_4' =>  "Penyedia Barang/Jasa wajib mengganti/memperbaiki sebagian atau keseluruhan dari pekerjaan yang ditolak tersebut dengan yang sesuai Persyaratan/Speck Teknik/KAK tanpa ada biaya tambahan dari Pengguna Barang/Jasa;",

            // Bagian BAB 6
            'bab_6_2' =>   "Pengguna Barang/Jasa menganggap bahwa semua macam pekerjaan yang telah diuraikan dalam Speck teknik / KAK / Persyaratan (RKS) serta (Bill of quantity (BoQ) ini seluruhnya termasuk $nama_pekerjaanrks harus diajukan dalam penawaran ini.",
            'bab_6_3' =>   "Pengguna Barang/Jasa menunjuk " . Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'direksi')->first()->nama_pengguna . " sebagai Direksi Pekerjaan yang diberi kuasa penuh untuk mengawasi/ mengontrol/ mengecek/memeriksa pengadaan pekerjaan dan menunjuk " . Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pengawas_pekerjaan')->first()->nama_pengguna . "  sebagai pengawas pekerjaan serta menunjuk " . Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pengawas_k3')->first()->nama_pengguna . " sebagai Pengawas K3.",

            // Bagian Nama Terang Tanda tangan
            'namaterang_manager' =>   Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'manager')->first()->nama_pengguna,
            'namaterang_pengadaan' =>  Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pejabat_pelaksana_pengadaan')->first()->nama_pengguna,
            'tandatangan_manager' => RKS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first() == null ?  '0'  : RKS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->tandatangan_manager,
            'tandatangan_pengadaan' => RKS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first() == null ?  '0'  : RKS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->tandatangan_pengadaan,
            // Isian Vendor
            'nama' => $vendor->penyedia,
            'alamat' =>  "$vendor->alamat_jalan , $vendor->alamat_kota, $vendor->alamat_provinsi.",
            'telepon' =>  $vendor->telepon == null ? '.....................' : $vendor->telepon,
            'website' =>  $vendor->website == null ? '.....................' : $vendor->website,
            'faksimili' =>  $vendor->faksimili == null ? '.....................' : $vendor->faksimili,
            'email' =>  $vendor->email_perusahaan == null ? '.....................' : $vendor->email_perusahaan,
            'pengawasPekerjaan' =>  "..................." . "belum",
            'pengawasK3' =>  "..................." . "belum"





        ];
        $surat = json_decode(json_encode($surat));
        $data = [
            // 'logokiri' => public_path('undangan/kiri.jpg'),
            // 'logo' => public_path('undangan/logo.png'), // path ke file header gambar
            'tandatangan' =>   DNS2D::getBarcodePNG('4', 'QRCODE'),
            'surat' => $surat


        ];
        return view('plnpengadaan.kontraktahap1.RKS.IsiRKS', compact('surat', 'data', 'id'));
    }

    public function updateRKS(Request $request, $id)
    {

        $kontrakkerja = KontrakKerja::find($id);
        $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->setActiveSheetIndexByName('RKS');

        $memvalidasiData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'faksimili' => 'nullable|string|max:255',
            'email' => 'required|email',
            'pengawas_pekerjaan' => 'required',
            'pengawas_k3' => 'required'
        ]);


        $direksiPekerjaan = $memvalidasiData['pengawas_pekerjaan'];
        $pengawasK3 = $memvalidasiData['pengawas_k3'];


        $worksheet->setCellValue('F74', $memvalidasiData['nama'])
            ->setCellValue('F75', $memvalidasiData['alamat'])
            ->setCellValue('F76', $memvalidasiData['telepon'])
            ->setCellValue('F77', $memvalidasiData['website'])
            ->setCellValue('F78', $memvalidasiData['faksimili'])
            ->setCellValue('F79', $memvalidasiData['email'])
            ->setCellValue('H88', $direksiPekerjaan)
            ->setCellValue('H89', $pengawasK3);

        // mengirim file Excel sebagai response
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);
        return redirect()->back()->with('success', 'Berhasil mengupdate excel');
    }



    public function tandatangan($id, $jenis)
    {


        $rks = RKS::where('id_kontrakkerja', $id)->first();


        $authId = Auth::id(); // Mendapatkan ID dari sesi pengguna yang terotentikasi
        $tandatangan = TandaTangan::where('id_akun', $authId)->first();

        if (!$tandatangan) {
            return redirect()->route('tandatangan.detail')->withErrors('Tandatangan belum dibuat.');
        }

        $kodeUnik = $tandatangan->kode_unik;

        $rks2 = RKS::find($rks->id);
        if ($jenis === 'pengadaan') {
            $rks2->tandatangan_pengadaan = $kodeUnik;
            $rks2->tanggal_tandatangan_pengadaan = Carbon::now('Asia/Jakarta');
        } elseif ($jenis === 'manager') {
            $rks2->tandatangan_manager = $kodeUnik;
            $rks2->tanggal_tandatangan_manager = Carbon::now('Asia/Jakarta');
        }

        $rks2->save();

        return redirect()->route('tandatangan.detail', ['id' => $id])->with('success', 'Tanda Tangan Berhasil');
    }
}
