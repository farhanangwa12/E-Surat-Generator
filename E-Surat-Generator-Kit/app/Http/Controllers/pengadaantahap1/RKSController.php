<?php

namespace App\Http\Controllers\pengadaantahap1;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use PDF;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use DNS2D;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RKSController extends Controller
{
    public function showrks($id, $isDownload)
    {
        $kontrakkerja = KontrakKerja::find($id);
        $spreadsheet = IOFactory::load(storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster));
        $worksheet = $spreadsheet->setActiveSheetIndexByName('RKS');
        $surat = [
            'nomor' => $worksheet->getCell('F8')->getCalculatedValue(),
            'tanggal' => $worksheet->getCell('F9')->getCalculatedValue(),
            'pekerjaan' => $worksheet->getCell('F10')->getCalculatedValue(),

            // Bagian BAB 1
            'bab_1_2' =>   $worksheet->getCell('B17')->getCalculatedValue(),
            'bab_1_3_tanggal' =>   $worksheet->getCell('H21')->getCalculatedValue(),
            'bab_1_3_pukul' =>   $worksheet->getCell('H22')->getCalculatedValue(),
            'bab_1_5' =>   $worksheet->getCell('B25')->getCalculatedValue(),
            'bab_1_6' =>   $worksheet->getCell('B28')->getCalculatedValue(),
            'bab_1_7' =>   $worksheet->getCell('B31')->getCalculatedValue(),



            // Bagian BAB 2
            'bab_2_1' =>   $worksheet->getCell('B61')->getCalculatedValue(),
            'bab_2_2' =>   $worksheet->getCell('B62')->getCalculatedValue(),
            'bab_2_4_nama' =>   $worksheet->getCell('F67')->getCalculatedValue(),
            'bab_2_4_alamat' =>   $worksheet->getCell('F68')->getCalculatedValue(),

            'bab_2_5_direksipekerjaan' =>   $worksheet->getCell('H83')->getCalculatedValue(),
            'bab_2_5_pengawaspekerjaan' =>   $worksheet->getCell('H84')->getCalculatedValue(),
            'bab_2_5_pengawask3' =>   $worksheet->getCell('H85')->getCalculatedValue(),
            'bab_2_7' =>   $worksheet->getCell('B95')->getCalculatedValue(),
            'bab_2_8_kontrak' =>   $worksheet->getCell('B97')->getCalculatedValue(),
            'bab_2_8_nomor' =>   $worksheet->getCell('B98')->getCalculatedValue(),
            'bab_2_8_tanggal' =>   $worksheet->getCell('B99')->getCalculatedValue(),
            'bab_2_10_1' =>   $worksheet->getCell('C153')->getCalculatedValue(),
            'bab_2_10_4' =>   $worksheet->getCell('C155')->getCalculatedValue(),

            // Bagian BAB 6
            'bab_6_2' =>   $worksheet->getCell('B249')->getCalculatedValue(),
            'bab_6_3' =>   $worksheet->getCell('B250')->getCalculatedValue(),

            // Bagian Nama Terang Tanda tangan
            'namaterang_manager' =>   $worksheet->getCell('B263')->getCalculatedValue(),
            'namaterang_pengadaan' =>   $worksheet->getCell('I263')->getCalculatedValue(),

            // Isian Vendor
            'nama' => $worksheet->getCell('F74')->getValue(),
            'alamat' => $worksheet->getCell('F75')->getValue(),
            'telepon' => $worksheet->getCell('F76')->getValue(),
            'website' => $worksheet->getCell('F76')->getValue(),
            'faksimili' => $worksheet->getCell('F77')->getValue(),
            'email' => $worksheet->getCell('F78')->getValue(),
            'pengawasPekerjaan' => $worksheet->getCell('H88')->getValue(),
            'pengawasK3' => $worksheet->getCell('H89')->getValue()





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
        $spreadsheet = IOFactory::load(storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster));
        $worksheet = $spreadsheet->setActiveSheetIndexByName('RKS');
        $surat = [
            'nomor' => $worksheet->getCell('F8')->getCalculatedValue(),
            'tanggal' => $worksheet->getCell('F9')->getCalculatedValue(),
            'pekerjaan' => $worksheet->getCell('F10')->getCalculatedValue(),

            // Bagian BAB 1
            'bab_1_2' =>   $worksheet->getCell('B17')->getCalculatedValue(),
            'bab_1_3_tanggal' =>   $worksheet->getCell('H21')->getCalculatedValue(),
            'bab_1_3_pukul' =>   $worksheet->getCell('H22')->getCalculatedValue(),
            'bab_1_5' =>   $worksheet->getCell('B25')->getCalculatedValue(),
            'bab_1_6' =>   $worksheet->getCell('B28')->getCalculatedValue(),
            'bab_1_7' =>   $worksheet->getCell('B31')->getCalculatedValue(),



            // Bagian BAB 2
            'bab_2_1' =>   $worksheet->getCell('B61')->getCalculatedValue(),
            'bab_2_2' =>   $worksheet->getCell('B62')->getCalculatedValue(),
            'bab_2_4_nama' =>   $worksheet->getCell('F67')->getCalculatedValue(),
            'bab_2_4_alamat' =>   $worksheet->getCell('F68')->getCalculatedValue(),

            'bab_2_5_direksipekerjaan' =>   $worksheet->getCell('H83')->getCalculatedValue(),
            'bab_2_5_pengawaspekerjaan' =>   $worksheet->getCell('H84')->getCalculatedValue(),
            'bab_2_5_pengawask3' =>   $worksheet->getCell('H85')->getCalculatedValue(),
            'bab_2_7' =>   $worksheet->getCell('B95')->getCalculatedValue(),
            'bab_2_8_kontrak' =>   $worksheet->getCell('B97')->getCalculatedValue(),
            'bab_2_8_nomor' =>   $worksheet->getCell('B98')->getCalculatedValue(),
            'bab_2_8_tanggal' =>   $worksheet->getCell('B99')->getCalculatedValue(),
            'bab_2_10_1' =>   $worksheet->getCell('C153')->getCalculatedValue(),
            'bab_2_10_4' =>   $worksheet->getCell('C155')->getCalculatedValue(),

            // Bagian BAB 6
            'bab_6_2' =>   $worksheet->getCell('B249')->getCalculatedValue(),
            'bab_6_3' =>   $worksheet->getCell('B250')->getCalculatedValue(),

            // Bagian Nama Terang Tanda tangan
            'namaterang_manager' =>   $worksheet->getCell('B263')->getCalculatedValue(),
            'namaterang_pengadaan' =>   $worksheet->getCell('I263')->getCalculatedValue(),

            // Isian Vendor
            'nama' => $worksheet->getCell('F74')->getValue(),
            'alamat' => $worksheet->getCell('F75')->getValue(),
            'telepon' => $worksheet->getCell('F76')->getValue(),
            'website' => $worksheet->getCell('F76')->getValue(),
            'faksimili' => $worksheet->getCell('F77')->getValue(),
            'email' => $worksheet->getCell('F78')->getValue(),
            'pengawasPekerjaan' => $worksheet->getCell('H88')->getValue(),
            'pengawasK3' => $worksheet->getCell('H89')->getValue()







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
}
