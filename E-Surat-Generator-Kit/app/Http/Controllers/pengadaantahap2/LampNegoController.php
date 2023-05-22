<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\BOQ;
use App\Models\HPS;
use App\Models\KontrakKerja;
use App\Models\Penyelenggara;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use App\Models\Vendor;
use Illuminate\Http\Request;
use PDF;

class LampNegoController extends Controller
{


    // Menampilkan detail data
    public function show($id, $isDownload)
    {
        $kontrak = KontrakKerja::with('vendor')->find($id); // contoh data kontrak. Sesuaikan dengan kebutuhan Anda.
        
        $jenis_kontraks = JenisKontrak::where('id_kontrak', $kontrak->id_kontrakkerja)->get()->toArray();
        $kontrakbaru = [];

        foreach ($jenis_kontraks as $jenis_kontrak) {

            $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->with('barJasBOQs', 'barjasHPS')->get()->toArray();
         
            $data = [];
            if (count($databarjas) != 0) {

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
                        'harga_satuan_penawaran' => empty($barjas['barjas_h_p_s']) ? '' :  $barjas['barjas_h_p_s'][0]['harga_satuan'],
                        'jumlah_penawaran' => empty($barjas['barjas_h_p_s']) ? '' : $barjas['barjas_h_p_s'][0]['jumlah'],
                        'sat' => $barjas['satuan'],
                        'harga_satuan_negosiasi' => empty($barjas['bar_jas_b_o_qs']) ? '' :  $barjas['bar_jas_b_o_qs'][0]['harga_satuan'],
                        'jumlah_negosiasi' => empty($barjas['bar_jas_b_o_qs']) ? '' : $barjas['bar_jas_b_o_qs'][0]['jumlah'],
                        'sub_data' => $sub_data

                    ];
                }
            }

            $kontrakbaru[] = [
                'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
                'data' => $data

            ];
        }
       
        $boq = BOQ::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->first();
        $hps = HPS::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->first();
         
        $data2 = [
            'logokiri' => public_path('undangan/kiri.jpg'),
            'logo' => public_path('undangan/logo.png'), // path ke file header gambar
            'jumlah_harga_penawaran' => $hps == null ? '0' : $hps->total_jumlah,
            'jumlah_harga_negosiasi' => $boq == null ? '0' : $boq->total_jumlah ,
            
            'pembulatan_harga_penawaran' => $hps == null ? '0' : $hps->dibulatkan,
            'pembulatan_harga_negosiasi' => $boq == null ? '0' : $boq->dibulatkan ,
            
            'ppn11_harga_penawaran' => $hps == null ? '0' : $hps->dibulatkan * 0.11,
            'ppn11_harga_negosiasi' => $boq == null ? '0' : $boq->dibulatkan * 0.11 ,

            'total_harga_penawaran' => $hps == null ? '0' : ($hps->dibulatkan * 0.11) + $hps->dibulatkan,
            'total_harga_negosiasi' => $boq == null ? '0' : ($boq->dibulatkan * 0.11) +  $boq->dibulatkan,

            'harga_disepakati' =>  null,
            "penyedia" => $kontrak->vendor->penyedia,
            "tandatangan_direktur" => "Budi Susanti Direktur",
            'direktur' => $kontrak->vendor->direktur,
            "tandatangan_pengadaan" => "Untung dan Berkah Pengadaan",
            'pejabat_pelaksana_pengadaan' => Penyelenggara::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_jabatan', 'pejabat_pelaksana_pengadaan')->first()->nama_pengguna,
            "tandatangan_manager" => "Selamet Dunia Akhirat Manager",
            'manager' => Penyelenggara::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_jabatan','manager')->first()->nama_pengguna,


        ];
        $data2['harga_disepakati'] =  $boq == null ? '0' : ($boq->dibulatkan * 0.11) +  $boq->dibulatkan;
        // dd($data);

        $pdf = PDF::loadView('plnpengadaan.kontraktahap2.LampNego.lampnego', compact('data2', 'kontrakbaru'));
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'LampNego_' . time() . '.pdf';

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
