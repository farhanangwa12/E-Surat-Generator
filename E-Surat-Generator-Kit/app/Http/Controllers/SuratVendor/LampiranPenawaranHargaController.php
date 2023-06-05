<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use App\Models\HPS;
use App\Models\KontrakKerja;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DNS2D;
use PDF;

class LampiranPenawaranHargaController extends Controller
{
    public function index()
    {
        return view('vendor.form_penawaran.lampiranpenawaranharga');
    }

    public function create()
    {

        return view('vendor.form_penawaran.lampiranpenawaranharga.create');
    }

    public function update(Request $request)
    {
        // Logika update data

        return redirect()->route('lampiranpenawaranharga.index');
    }

    public function halamanttd()
    {
        return view('vendor.form_penawaran.halamanttd');
    }
    public function pdf($id)
    {

        $kontrakbaru = [];

        $jenis_kontraks = JenisKontrak::where('id_kontrak', $id)->get()->toArray();

        foreach ($jenis_kontraks as $jenis_kontrak) {

            $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->with('barjasHPS')->get()->toArray();
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
                        'harga_satuan' => "Garong",
                        'jumlah' => "Garong",
                        'sub_data' => $sub_data

                    ];
                }
            }

            $kontrakbaru[] = [
                'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
                'data' => $data

            ];
        }

        $kontrak = KontrakKerja::find($id); // contoh data kontrak. Sesuaikan dengan kebutuhan Anda.


        $nama_pekerjaan = $kontrak->nama_kontrak;
        $data2 = [
            'nama_pekerjaan' => $nama_pekerjaan,
            'tanggal_pekerjaan' => 2002 - 12 - 20,
            'penyedia' => 'Mamang Garox',
            'nama_direktur' => "Hai Mamank",
            'jumlah_harga' => 20000,
            'dibulatkan' =>20000,
            'rok_10' => 20000,
            'ppn_11' => 20000,
            'harga_total' => 20000,


        ];

        $pdf = PDF::loadView('vendor.form_penawaran.lampiranpenawaranharga.pdf', compact('data2', 'kontrakbaru'));
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'HPS_' . time() . '.pdf';
        return $pdf->stream($namefile);
       
       
    }
    public function simpanttd(Request $request)
    {
        // Logika menyimpan tanda tangan

        return redirect()->route('lampiranpenawaranharga.index');
    }
}
