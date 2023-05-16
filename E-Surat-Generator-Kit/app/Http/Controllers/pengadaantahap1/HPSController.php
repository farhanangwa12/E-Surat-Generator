<?php

namespace App\Http\Controllers\pengadaantahap1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PerhitunganController;
use App\Models\KontrakKerja;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;

class HPSController extends Controller
{
  
    public function detail($id, $isDownload)
    {
        $kontrak = KontrakKerja::find($id); // contoh data kontrak. Sesuaikan dengan kebutuhan Anda.
        $spreadsheet = IOFactory::load(storage_path('app/public/dokumenpenawaran/' . $kontrak->filemaster));
        $worksheet = $spreadsheet->setActiveSheetIndexByName('HPS');
        $nomor = $worksheet->getCell('B7')->getCalculatedValue();
        $tanggal = $worksheet->getCell('B8')->getFormattedValue();
        $nama_pekerjaan = $worksheet->getCell('B9')->getCalculatedValue();
        $nama_manager = $worksheet->getCell('A58')->getFormattedValue();
        $nama_pengadaan = $worksheet->getCell('J58')->getFormattedValue();

        $jenis_kontraks = JenisKontrak::where('id_kontrak', $kontrak->id_kontrakkerja)->get()->toArray();
        $kontrakbaru = [];

        foreach ($jenis_kontraks as $jenis_kontrak) {

            $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->get()->toArray();

            if (count($databarjas) != 0) {
                $data = [];
                foreach ($databarjas as $barjas) {


                    $sub_data = [];
                    $datasubbarjas = SubBarjas::where('id_barjas', $barjas['id'])->get()->toArray();
                    if (count($datasubbarjas) != 0) {
                        foreach ($datasubbarjas as $subbarjas) {
                            $sub_data[] = [
                                "id" => $subbarjas['id'],
                                "id_barjas" => $subbarjas['id_barjas'],
                                "uraian" => $subbarjas['uraian'],
                                "volume" => $subbarjas['volume'],
                                "satuan" => $subbarjas['satuan'],
                                // "harga_satuan" => $subbarjas['harga_satuan'],
                                // "jumlah" => $subbarjas['harga_satuan']
                            ];
                            # code...
                        }
                    }

                    $data[] = [
                        'id' => $barjas['id'],
                        'uraian' => $barjas['uraian'],
                        'vol' => $barjas['volume'],
                        'sat' => $barjas['satuan'],
                        // 'harga_satuan' => $barjas['harga_satuan'],
                        // 'jumlah' => $barjas['jumlah'],
                        'sub_data' => $sub_data

                    ];
                }
            }
            $kontrakbaru[] = [
                'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
                'data' => $data

            ];
        }
        $perhitungancontroller = app(PerhitunganController::class);
        $barisTerakhir =  $perhitungancontroller->mencariTotalHarga($spreadsheet, "HPS") + 0;

        $data2 = [
            'logokiri' => public_path('undangan/kiri.jpg'),
            'logo' => public_path('undangan/logo.png'), // path ke file header gambar
            // 'tandatangan' =>   DNS2D::getBarcodePNG('4', 'QRCODE'),
            // 'surat' => $surat
            'nomor' => $nomor,
            'tanggal_pekerjaan' => $tanggal,
            'nama_pekerjaan' => $nama_pekerjaan,
            'nama_manager' => $nama_manager,
            'pengadaan' => $nama_pengadaan,
            'jumlah_harga' => $worksheet->getCell('K'.$barisTerakhir)->getFormattedValue(),
            'dibulatkan' => $worksheet->getCell('K'.($barisTerakhir+1))->getFormattedValue(),
            'rok_10' => $worksheet->getCell('K'.($barisTerakhir+2))->getFormattedValue(),
            'ppn_11' => $worksheet->getCell('K'.($barisTerakhir+3))->getFormattedValue(),
            'harga_total' => $worksheet->getCell('K'.($barisTerakhir+4))->getFormattedValue(),



      


        ];

        $pdf = PDF::loadView('plnpengadaan.kontraktahap1.HPS.hps', compact('data2', 'kontrakbaru'));
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'HPS_' . time() . '.pdf';
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

    public function isi($id)
    {
        // Implementasi aksi isi
    }

    public function update(Request $request, $id)
    {
        // Implementasi aksi update
    }

 

    public function store(Request $request, $id)
    {
        // Implementasi aksi store
    }
}
