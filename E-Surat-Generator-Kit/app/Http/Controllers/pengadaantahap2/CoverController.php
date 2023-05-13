<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CoverController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
    }

    // Menyimpan data baru ke dalam database
    public function store(Request $request)
    {
    }

    // Menampilkan detail data
    public function show($id, $isDownload)
    {
        $kontrakkerja = KontrakKerja::find($id);
        $spreadsheet = IOFactory::load(storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster));
        $worksheet = $spreadsheet->setActiveSheetIndexByName('COVER');
        $surat = [
            'nama_perusahaan' => $worksheet->getCell('C16')->getCalculatedValue(),

            'nomor_pihak_pertama' => $worksheet->getCell('H18')->getCalculatedValue(),

            'nomor_pihak_kedua' => $worksheet->getCell('H19')->getCalculatedValue(),
            'tanggal_awal_kontrak' => $worksheet->getCell('H20')->getCalculatedValue(),
            'tanggal_akhir_kontrak' => $worksheet->getCell('H21')->getCalculatedValue(),
            'jangka_waktu' => $worksheet->getCell('H22')->getCalculatedValue(),
            'nilai_pekerjaan' => $worksheet->getCell('H23')->getCalculatedValue(),

            'tahun' => $worksheet->getCell('C31')->getCalculatedValue()
          


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
