<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SampulController extends Controller
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
        $worksheet = $spreadsheet->setActiveSheetIndexByName('SAMPUL');
        $surat = [
            'nomor' => $worksheet->getCell('B20')->getCalculatedValue(),

            'tanggal' => $worksheet->getCell('B22')->getCalculatedValue(),

            'pekerjaan' => $worksheet->getCell('B26')->getCalculatedValue(),
            'nama_perusahaan' => $worksheet->getCell('B44')->getCalculatedValue(),
            'nilai_pekerjaan' => $worksheet->getCell('B48')->getCalculatedValue(),
           


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
