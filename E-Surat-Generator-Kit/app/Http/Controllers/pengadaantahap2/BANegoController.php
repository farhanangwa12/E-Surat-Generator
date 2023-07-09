<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SuratVendor\FormPenawaranHargaController;
use App\Models\Dokumen\BANego;
use App\Models\Dokumen\LampNego;
use App\Models\DokumenVendor\Formpenawaranharga;
use App\Models\DokumenVendor\Lampiranpenawaranharga;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Terbilang;

class BANegoController extends Controller
{

    public function refresh($id)
    {

        // Mengecek apakah record banego ada
        $banego = BANego::where('id_kontrakkerja', $id)->first();


        if ($banego) {
            // Jika record banego ada
            // Lakukan operasi lain yang diinginkan

            $banego = BANego::find($banego->id);
            $banego->save();
        } else {
            // Jika record banego tidak ada

            // Buat instance banego model untuk menyimpan data
            $banego = new BANego();
            $banego->id_kontrakkerja = $id;
            $banego->tandatangan_pengadaan = null;
            $banego->tanggal_tandatanganpengadaan = null;

            $banego->tandatangan_manager = null;
            $banego->tanggal_tandatanganmanager = null;

            $banego->tandatangan_pengadaan = null;
            $banego->tanggal_tandatanganpengadaan = null;

            $banego->tandatangan_direktur = null;
            $banego->tanggal_tandatangan = null;

            $banego->save();
        }

        return 'Data Telah Direfresh';
    }
    // Menampilkan detail data
    public function show($id, $isDownload)
    {
        // $this->refresh($id);
        $kontrakkerja = KontrakKerja::find($id);
        $formpenawaran = Formpenawaranharga::with(['dokumen' => function ($query) use ($id){
            $query->where('id_kontrakkerja', $id);
        }])->first();
  
        $nilai_pekerjaan = $formpenawaran->jumlah_harga;
        $lampirannego = LampNego::with(['pembuatansuratkontrak'=> function ($query) use ($id){
            $query->where('id_kontrakkerja', $id);
        }])->first();
        
   
        $penawaran_negosiasi = isset($lampirannego->total_harga) ? $lampirannego->total_harga : 0;


        $banegotanggal = PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_surat', 'nomor_ba_negosiasi')->first()->tanggal_pembuatan;
        $vendor = Vendor::find($kontrakkerja->id_vendor);
  

        $surat = [
            'nomor' => "Nomor : " . PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_surat', 'nomor_ba_negosiasi')->first()->no_surat,
            'pekerjaan' => strtoupper($kontrakkerja->nama_kontrak) . " PT PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR",

            //    isi surat

            'paragraf_1' => "Pada  hari  ini,  " . Carbon::parse($banegotanggal)->locale('id')->isoFormat('dddd') . " tanggal " . Terbilang::make(Carbon::parse($banegotanggal)->format('d')) . " bulan " . Carbon::parse($banegotanggal)->format('F') . " tahun " . Terbilang::make($kontrakkerja->tahun) . " (" . Carbon::parse($banegotanggal)->format('d-m-Y') . "), yang bertanda tangan di bawah ini selaku Pejabat Pelaksana Pengadaan Barang/Jasa di Lingkungan PT PLN (Persero) Unit Induk Wilayah Nusa Tenggara Timur Unit Pelaksana Pembangkitan Timor telah menyelenggarakan Negosiasi untuk pekerjaan tersebut di atas dengan hasil sebagai berikut :",

            'penawaran_semula' => "Rp. " . number_format(str_replace('.', '', $nilai_pekerjaan), 0, ',', '.'),
            'penawaran_negosiasi' => "Rp. " . number_format(str_replace('.','',$penawaran_negosiasi), 0, ',', '.'),

            // tanda Tangan
            'namaperusahaan' => $vendor->penyedia,

            // Nama Terang
            'vendor' => $vendor->direktur,
            // 'tandatangan_vendor' => BANego::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first() == null ? '0' : BANego::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->tandatangan_direktur,

            'pengadaan' =>  Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'pejabat_pelaksana_pengadaan')->first()->nama_pengguna,
            // 'tandatangan_pengadaan' => BANego::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first() == null ? '0' : BANego::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->tandatangan_pengadaan,
            'manager' => Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_jabatan', 'manager')->first()->nama_pengguna,
            // 'tandatangan_manager' => BANego::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first() == null ? '0' : BANego::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first()->tandatangan_manager,








        ];
        $surat = json_decode(json_encode($surat));
        $data = [
            'logokiri' => public_path('undangan/kiri.jpg'),
            'logo' => public_path('undangan/logo.png'), // path ke file header gambar
            'surat' => $surat

        ];


        $pdf = PDF::loadView('plnpengadaan.kontraktahap2.BANego.banego', $data);
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'BANego_' . time() . '.pdf';

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
