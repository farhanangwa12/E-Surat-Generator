<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SuratVendor\LampiranPenawaranHargaController;
use App\Models\BarJasHPS;
use App\Models\Dokumen\BOQ;
use App\Models\Dokumen\LampNego;
use App\Models\DokumenVendor\Lampiranpenawaranharga;
use App\Models\HPS;
use Terbilang;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use App\Models\Vendor;
use Illuminate\Http\Request;
use PDF;

class LampNegoController extends Controller
{

    public function refresh($id)
    {
        $pembuatansuratkontrak = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'nomor_ba_negosiasi')->with('lampnego')->first();
        // dd($pembuatansuratkontrak);
        // Mengecek apakah record HPS ada

        if ($pembuatansuratkontrak->lampnego !== null) {
            // Jika record lampnego ada
            // Lakukan operasi lain yang diinginkan

            $lampnego = LampNego::find($pembuatansuratkontrak->lampnego->id);
            $lampnego->id_surat = $pembuatansuratkontrak->id;
            // Simpan data lampnego
            $lampnego->save();
        } else {
            // Jika record lampnego tidak ada

            // Buat instance lampnego model untuk menyimpan data
            $lampnego = new LampNego();
            $lampnego->id_surat = $pembuatansuratkontrak->id;
            $lampnego->datalampnego = [];
            $lampnego->total_jumlah = 0;
            $lampnego->dibulatkan = 0;
            $lampnego->ppn11 = 0;
            $lampnego->total_harga = 0;


            // Simpan data HPS
            $lampnego->save();
        }







        $jenis_kontrak = JenisKontrak::where('id_kontrak', $id)->with('barjas')->get()->toArray();

        $barjaslamp = $lampnego->datalampnego;

        $no = 0;
        foreach ($jenis_kontrak as $jen) {
            foreach ($jen['barjas'] as $barjas) {
                $barjaslamp[$no]['id_barjas'] = $barjas['id'];
                if (!array_key_exists('harga_satuan', $barjaslamp[$no])) {
                    $barjaslamp[$no]['harga_satuan'] = 0;
                }
                if (!array_key_exists('jumlah', $barjaslamp[$no])) {
                    $barjaslamp[$no]['jumlah'] = 0;
                }
                $no++;
            }
        }
        $lampnego = LampNego::find($lampnego->id);

        $lampnego->datalampnego = $barjaslamp;

        $lampnego->save();
        return $lampnego;
    }
    // Menampilkan detail data
    public function show($id, $isDownload)
    {
        $lampnego =  $this->refresh($id);
        $datalampnego = $lampnego->datalampnego;
        // $kelengkapandokumen = app(LampiranPenawaranHargaController::class);
        // $datalampiranvendor = $kelengkapandokumen->refresh($id)->datalampiran;
        $kontrak = KontrakKerja::with('vendor')->find($id); // contoh data kontrak. Sesuaikan dengan kebutuhan Anda.

        $jenis_kontraks = JenisKontrak::where('id_kontrak', $kontrak->id_kontrakkerja)->get()->toArray();
        $kontrakbaru = [];

        foreach ($jenis_kontraks as $jenis_kontrak) {

            $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->with('barJasBOQs')->get()->toArray();

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
                        'harga_satuan_penawaran' => empty($barjas['bar_jas_b_o_qs']) ? 0 : $barjas['bar_jas_b_o_qs'][0]['harga_satuan'],
                        'jumlah_penawaran' => empty($barjas['bar_jas_b_o_qs']) ? 0 : $barjas['bar_jas_b_o_qs'][0]['jumlah'],
                        'harga_satuan_negosiasi' => empty($datalampnego) ? 0 :  $datalampnego[$no]['harga_satuan'],
                        'jumlah_negosiasi' => empty($datalampnego) ? 0 :  $datalampnego[$no]['jumlah'],
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

        $boq = BOQ::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->first();


        $data2 = [
            'logokiri' => public_path('undangan/kiri.jpg'),
            'logo' => public_path('undangan/logo.png'), // path ke file header gambar
            'jumlah_harga_penawaran' => $boq == null ? '0' : number_format(str_replace('.','',$boq->total_jumlah),0,',','.'),
            'jumlah_harga_negosiasi' => $lampnego == null ? '0' : number_format(str_replace('.','',$lampnego->total_jumlah),0,',','.'),

            'pembulatan_harga_penawaran' => $boq == null ? '0' : number_format(str_replace('.','',$boq->dibulatkan),0,',','.'),
            'pembulatan_harga_negosiasi' => $lampnego == null ? '0' : number_format(str_replace('.','',$lampnego->dibulatkan),0,',','.'),

            'ppn11_harga_penawaran' => $boq == null ? '0' : number_format(str_replace('.','',$boq->dibulatkan) ,0,',','.'),
            'ppn11_harga_negosiasi' => $lampnego == null ? '0' : number_format(str_replace('.','',$lampnego->dibulatkan) ,0,',','.'),

            'total_harga_penawaran' => $boq == null ? '0' :  number_format(str_replace('.','',$boq->total_harga),0,',','.'),
            'total_harga_negosiasi' => $lampnego == null ? '0' :   number_format(str_replace('.','',$lampnego->total_harga),0,',','.'),

            'harga_disepakati' =>  $lampnego == null ? '0' :   number_format(str_replace('.','',$lampnego->total_harga),0,',','.'),
            'terbilang' => $lampnego == null ?  ucwords(Terbilang::make(0,' Rupiah ')) : ucwords(Terbilang::make($lampnego->total_harga, ' Rupiah ')),
            "penyedia" => $kontrak->vendor->penyedia,
            "tandatangan_direktur" => "Budi Susanti Direktur",
            'direktur' => $kontrak->vendor->direktur,
            "tandatangan_pengadaan" => "Untung dan Berkah Pengadaan",
            'pejabat_pelaksana_pengadaan' => Penyelenggara::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_jabatan', 'pejabat_pelaksana_pengadaan')->first()->nama_pengguna,
            "tandatangan_manager" => "Selamet Dunia Akhirat Manager",
            'manager' => Penyelenggara::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_jabatan', 'manager')->first()->nama_pengguna,


        ];

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
    public function create($id)
    {
        $lampnego =  $this->refresh($id);
        $datalampnego = $lampnego->datalampnego;

        $jenis_kontraks = JenisKontrak::where('id_kontrak', $id)->get()->toArray();
        $boq = BOQ::where('id_kontrakkerja', $id)->first();

        $kontrakbaru = [];


        foreach ($jenis_kontraks as $jenis_kontrak) {

            $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->with('barJasBOQs')->get()->toArray();

            $data = [];
            $nobarjas = 0;
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
                        'harga_satuan_penawaran' => empty($barjas['bar_jas_b_o_qs']) ? 0 : $barjas['bar_jas_b_o_qs'][0]['harga_satuan'],
                        'jumlah_penawaran' => empty($barjas['bar_jas_b_o_qs']) ? 0 : $barjas['bar_jas_b_o_qs'][0]['jumlah'],
                        'harga_satuan_negosiasi' => empty($datalampnego) ? 0 :  $datalampnego[$nobarjas]['harga_satuan'],
                        'jumlah_negosiasi' => empty($datalampnego) ? 0 :  $datalampnego[$nobarjas]['jumlah'],
                        'sub_data' => $sub_data

                    ];
                    $nobarjas++;
                }
            }


            $kontrakbaru[] = [
                'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
                'data' => $data

            ];
        }



        return  view('plnpengadaan.kontraktahap2.LampNego.create', compact('id', 'kontrakbaru', 'boq', 'lampnego'));
    }


    // Mengupdate data ke database
    public function update(Request $request, $id)
    {
        $pembuatansuratkontrak = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'nomor_ba_negosiasi')->with('lampnego')->first();

        // dd($pembuatansuratkontrak);
        // Mengecek apakah record HPS ada

        // Menghapus titik (.) sebagai pemisah ribuan
       
        if ($pembuatansuratkontrak->lampnego !== null) {
            // Jika record lampnego ada
            // Lakukan operasi lain yang diinginkan


            $totalJumlah = str_replace('.', '',$request->input('total_jumlah_negosiasi'));
            $dibulatkan = str_replace('.', '', $request->input('dibulatkan_negosiasi'));
            $ppn11 = str_replace('.', '', $request->input('ppn11_negosiasi'));
            $totalHarga = str_replace('.', '', $request->input('harga_total_negosiasi'));

            $lampnego = LampNego::find($pembuatansuratkontrak->lampnego->id);
            $lampnego->id_surat = $pembuatansuratkontrak->id;
            $lampnego->total_jumlah = $totalJumlah;
            $lampnego->dibulatkan = $dibulatkan;
            $lampnego->ppn11 = $ppn11;
            $lampnego->total_harga = $totalHarga;

            // Simpan data lampnego
            $lampnego->save();
        } else {
            $totalJumlah = str_replace('.', '',$request->input('total_jumlah_negosiasi'));
            $dibulatkan = str_replace('.', '', $request->input('dibulatkan_negosiasi'));
            $ppn11 = str_replace('.', '', $request->input('ppn11_negosiasi'));
            $totalHarga = str_replace('.', '', $request->input('harga_total_negosiasi'));
            // Jika record lampnego tidak ada

            // Buat instance lampnego model untuk menyimpan data
            $lampnego = new LampNego();
            $lampnego->id_surat = $pembuatansuratkontrak->id;
            $lampnego->datalampnego = [];
            $lampnego->total_jumlah = $totalJumlah;
            $lampnego->dibulatkan = $dibulatkan;
            $lampnego->ppn11 = $ppn11;
            $lampnego->total_harga = $totalHarga;


            // Simpan data HPS
            $lampnego->save();
        }







        $jenis_kontrak = JenisKontrak::where('id_kontrak', $id)->with('barjas')->get()->toArray();

        $barjaslamp = $request->input('negosiasi');

        $no = 0;
        foreach ($jenis_kontrak as $jen) {
            foreach ($jen['barjas'] as $barjas) {
                $barjaslamp[$no]['id_barjas'] = $barjas['id'];
                // if (!array_key_exists('harga_satuan', $barjaslamp[$no])) {
                //     $barjaslamp[$no]['harga_satuan'] = 0;
                // }
                // if (!array_key_exists('jumlah', $barjaslamp[$no])) {
                //     $barjaslamp[$no]['jumlah'] = 0;
                // }
                $no++;
            }
        }
        $lampnego = LampNego::find($lampnego->id);

        $lampnego->datalampnego = $barjaslamp;

        $lampnego->save();



        return redirect()->route('negoharga.detail', ['id' => $id])->with('success', 'Data berhasil disimpan.');
    }
}
