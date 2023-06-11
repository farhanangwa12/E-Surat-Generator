<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SuratVendor\FormPenawaranHargaController;
use App\Models\PembuatanSuratKontrak;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class LspkController extends Controller
{


    // Menampilkan detail data
    public function show($id, $isDownload)
    {



        $jenis_kontraks = JenisKontrak::where('id_kontrak', $id)->get()->toArray();

        $kontrakbaru = [];
        // nomor pihak pertama
        $pembuatansuratkontrak = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'nomor_rks')->first();
        $nomor_pihak_pertama = $pembuatansuratkontrak->no_surat;
        // Mengambil nomor vendor
        $formpenawaran = app(FormPenawaranHargaController::class)->refresh($id);
        $nomor_pihak_kedua = $formpenawaran->nomor;
        // Mengambil data lamp nego
        $lampnego = app(LampNegoController::class)->refresh($id);
        $datalampnego = $lampnego->datalampnego;

        foreach ($jenis_kontraks as $jenis_kontrak) {

            $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->get()->toArray();

            $data = [];
            if (count($databarjas) != 0) {
                $no = 0;
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
                           
                            ];
                            # code...
                        }
                    }

                    $data[] = [
                        'id' => $barjas['id'],
                        'uraian' => $barjas['uraian'],
                        'vol' => $barjas['volume'],
                        'sat' => $barjas['satuan'],
                     
                        'harga_satuan' => empty($datalampnego) ? 0 :  number_format($datalampnego[$no]['harga_satuan'], 0,',','.'),
                        'jumlah' => empty($datalampnego) ? 0 :  number_format($datalampnego[$no]['jumlah'], 0, ',', '.'),
                        'sub_data' => $sub_data

                    ];
                    $no++;
                }
            }

            $kontrakbaru[] = [
                'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
                'data' => $data

            ];
        }
        $data = [
            'logokiri' => public_path('undangan/kiri.jpg'),
            'logo' => public_path('undangan/logo.png'), // path ke file header gambar
            'nomor_pihak_pertama' => $nomor_pihak_pertama,
            'nomor_pihak_kedua' => $nomor_pihak_kedua,

            'nama_pekerjaan' => 'PEKERJAAN PENGADAAN DAN JASA INSTALASI KWH METER ENGINE PLTU JEMBER PT PLN (PERSERO) UNIT INDUK
            WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR',
            'tanggal_spk' => Carbon::parse( $pembuatansuratkontrak->tanggal_pembuatan)->locale('id')->isoFormat('DD MMMM YYYY'),
            'kontrakbaru' => $kontrakbaru,
            'jumlah_harga' => number_format($lampnego->total_jumlah, 0, ',', '.'),
            'pembulatan' => number_format($lampnego->dibulatkan, 0, ',', '.'),
            'ppn11' => number_format($lampnego->ppn11, 0, ',', '.'),
            'total_harga' => number_format($lampnego->total_harga, 0, ',', '.'),




        ];

        $pdf = PDF::loadView('plnpengadaan.kontraktahap2.lspk.lspk', $data);
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'LSPK_' . time() . '.pdf';

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
