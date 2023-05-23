<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SampulController extends Controller
{
   

    // Menampilkan detail data
    public function show($id, $isDownload)
    {
        $kontrakkerja = KontrakKerja::with('vendor')->find($id);
        
        $surat = [
            'nomor' => "Nomor : " . PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_surat', 'nomor_spk')->first()->nomor_spk,

            'tanggal' => "Tanggal : ". Carbon::parse(PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->where('nama_surat', 'nomor_spk')->first()->tanggal_pembuatan)->isoFormat('DD MMMM YYYY'),

            'pekerjaan' => $kontrakkerja->nama_pekerjaan ."Belum",
            'nama_perusahaan' => $kontrakkerja->vendor->penyedia,
            'nilai_pekerjaan' => "200 juta Belum",
           


        ];
        $surat = json_decode(json_encode($surat));
        $data = [
            'logopln' => public_path('tampilan/sampul/logopln.png'),
            'baris_bawah' => public_path('tampilan/sampul/garisbawah.png'), // path ke file header gambar
            'surat' => $surat

        ];

        $pdf = PDF::loadView('plnpengadaan.kontraktahap2.Sampul.sampul', $data);
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'Sampul_' . time() . '.pdf';

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

  
}
