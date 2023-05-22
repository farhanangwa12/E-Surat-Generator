<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use Illuminate\Http\Request;
use PDF;

use Carbon\Carbon;
use Terbilang;
class CoverController extends Controller
{
   

    // Menampilkan detail data
    public function show($id, $isDownload)
    {
        $kontrakkerja = KontrakKerja::with('vendor')->find($id);
        
        $surat = [
            'nama_perusahaan' => $kontrakkerja->vendor->penyedia,

            'nomor_pihak_pertama' => PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_surat', 'nomor_rks')->first()->no_surat,

            'nomor_pihak_kedua' => "Belum 781/MDM-PLN/XII/2022",
            'tanggal_awal_kontrak' => Carbon::parse($kontrakkerja->tanggal_pekerjaan)->locale('id')->isoFormat('DD MMMM YYYY'),
            'tanggal_akhir_kontrak' => Carbon::parse($kontrakkerja->tanggal_akhir_pekerjaan)->locale('id')->isoFormat('DD MMMM YYYY'),
            'jangka_waktu' =>Carbon::parse($kontrakkerja->tanggal_pekerjaan)->diffInDays($kontrakkerja->tanggal_akhir_pekerjaan) . ' ( '.Terbilang::make(Carbon::parse($kontrakkerja->tanggal_pekerjaan)->diffInDays($kontrakkerja->tanggal_akhir_pekerjaan)).' ) ' . 'Hari Kalender',
            'nilai_pekerjaan' => "Rp. Belum Rupiah",

            'tahun' => "TAHUN " .$kontrakkerja->tahun
          


        ];
        $surat = json_decode(json_encode($surat));
        $data = [
            'logokiri' => public_path('undangan/kiri.jpg'),
            'logo' => public_path('undangan/logo.png'), // path ke file header gambar
            'surat' => $surat
        ];

        $pdf = PDF::loadView('plnpengadaan.kontraktahap2.Cover.cover', $data);
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'Cover_' . time() . '.pdf';

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
