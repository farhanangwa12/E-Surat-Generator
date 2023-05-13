<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BANegoController extends Controller
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
        $worksheet = $spreadsheet->setActiveSheetIndexByName('BA NEGO');
        $surat = [
            'nomor' => $worksheet->getCell('B8')->getCalculatedValue(),
            'pekerjaan' => $worksheet->getCell('D11')->getCalculatedValue(),

            //    isi surat

            'paragraf_1' => $worksheet->getCell('B16')->getCalculatedValue(),
            
            
            'penawaran_semula' => $worksheet->getCell('G22')->getCalculatedValue(),
            'penawaran_negosiasi' => $worksheet->getCell('G23')->getCalculatedValue(),

            // tanda Tangan
            'namaperusahaan' => $worksheet->getCell('B31')->getCalculatedValue(),
            
            // Nama Terang
            'vendor' => $worksheet->getCell('B31')->getCalculatedValue(),
            'pengadaan' => $worksheet->getCell('G38')->getCalculatedValue(),
            'manager' => $worksheet->getCell('A50')->getCalculatedValue()







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
