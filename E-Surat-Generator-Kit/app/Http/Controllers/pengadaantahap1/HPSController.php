<?php

namespace App\Http\Controllers\pengadaantahap1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PerhitunganController;
use App\Models\BarJasHPS;

use App\Models\HPS;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use App\Models\TandaTangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DNS2D;
use Illuminate\Support\Facades\Auth;

class HPSController extends Controller
{
    public function refresh($id)
    {
        $pembuatansuratkontrak = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat','nomor_hps')->with('hps')->first();
  
        // // Mengecek apakah record HPS ada
        // $hps = HPS::where('id_kontrakkerja', $id)->first();


        if (isset($hps)) {
            // Jika record HPS ada
            // Lakukan operasi lain yang diinginkan

            $hps = HPS::find($pembuatansuratkontrak->hps->id);
            $hps->save();
        } else {
            // Jika record HPS tidak ada

            // Buat instance HPS model untuk menyimpan data
            $hps = new HPS();
            $hps->id_surat = $pembuatansuratkontrak->id;
            $hps->total_jumlah = 0;
            $hps->dibulatkan = 0;
            $hps->rok10 = 0;
            $hps->ppn11 = 0;
            $hps->total_harga = 0;
            // $hps->tandatangan_pengadaan = null;
            // $hps->tandatangan_manager = null;

            // Simpan data HPS
            $hps->save();
        }

      
        $jenis_kontrak = JenisKontrak::where('id_kontrak', $id)->with('barjas')->get()->toArray();

        $barjashps = [];

        $no = 1;
        foreach ($jenis_kontrak as $jen) {
            foreach ($jen['barjas'] as $barjas) {
                $barjashps[$no]['id_barjas'] = $barjas['id'];
                $barjashps[$no]['id_hps'] = $hps->id;

                $no++;
            }
        }

        foreach ($barjashps as $bhps) {
            $databarjasHPS = BarJasHPS::where('id_hps', $bhps['id_hps'])->where('id_barjas', $bhps['id_barjas'])->first();

            if ($databarjasHPS) {
                $barjashps = BarJasHPS::find($databarjasHPS->id);
                $barjashps->save();
            } else {
                BarJasHPS::create([
                    'id_hps' => $bhps['id_hps'],
                    'id_barjas' => $bhps['id_barjas'],
                    'harga_satuan' => 0,
                    'jumlah' => 0,
                ]);
            }
        }
        $hps = HPS::find($hps->id)->with('barjasHPS')->first();

        return $hps;
    }



    public function detail($id, $isDownload)
    {
        $hps = $this->refresh($id);
        $kontrak = KontrakKerja::find($id); // contoh data kontrak. Sesuaikan dengan kebutuhan Anda.

        $nomor = PembuatanSuratKontrak::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_surat', 'nomor_hps')->first()->no_surat;

        $tanggal = PembuatanSuratKontrak::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_surat', 'nomor_hps')->first()->tanggal_pembuatan;
        $nama_pekerjaan = $kontrak->nama_kontrak;
        $nama_manager = Penyelenggara::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_jabatan', 'manager')->first()->nama_pengguna;
        $nama_pengadaan = Penyelenggara::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_jabatan', 'pejabat_pelaksana_pengadaan')->first()->nama_pengguna;

        $jenis_kontraks = JenisKontrak::where('id_kontrak', $kontrak->id_kontrakkerja)->get()->toArray();
        $kontrakbaru = [];


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
                        'harga_satuan' => number_format($barjas['barjas_h_p_s'][0]['harga_satuan'],0,',','.'),
                        'jumlah' => number_format($barjas['barjas_h_p_s'][0]['jumlah'],0,',','.'),
                        'sub_data' => $sub_data

                    ];
                }
            }

            $kontrakbaru[] = [
                'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
                'data' => $data

            ];
        }
        // $perhitungancontroller = app(PerhitunganController::class);
        // $barisTerakhir =  $perhitungancontroller->mencariTotalHarga($spreadsheet, "HPS") + 0;
        // Generate barcode 2D (QR code)



        // $tandatangan_pengadaan = HPS::where('id_kontrakkerja', $id)->first()->tandatangan_pengadaan;
        // $tandatangan_manager = HPS::where('id_kontrakkerja', $id)->first()->tandatangan_manager;




        $data2 = [
            'logokiri' => public_path('undangan/kiri.jpg'),
            'logo' => public_path('undangan/logo.png'), // path ke file header gambar
            // 'tandatangan' =>   DNS2D::getBarcodePNG('4', 'QRCODE'),
            // 'surat' => $surat
            'nomor' => $nomor,
            'tanggal_pekerjaan' => Carbon::createFromFormat('Y-m-d', $tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY'),
            'nama_pekerjaan' => $nama_pekerjaan,
            'nama_manager' => $nama_manager,
            'pengadaan' => $nama_pengadaan,
            'jumlah_harga' => number_format($hps->total_jumlah, 0, ',','.'),
            'dibulatkan' =>number_format( $hps->dibulatkan, 0, ',','.'),
            'rok_10' => number_format($hps->rok10, 0, ',','.'),
            'ppn_11' =>number_format( $hps->ppn11, 0, ',','.'),
            'harga_total' => number_format($hps->total_harga, 0, ',','.'),
            'tandatangan_pengadaan' => $hps->tandatangan_pengadaan == null ?  '0' : preg_replace("/[^0-9]/", "", $tandatangan_pengadaan),
            'tandatangan_manager' => $hps->tandatangan_manager == null ?  '0' : preg_replace("/[^0-9]/", "", $tandatangan_manager)

            // 'jumlah_harga' => $worksheet->getCell('K' . $barisTerakhir)->getFormattedValue(),
            // 'dibulatkan' => $worksheet->getCell('K' . ($barisTerakhir + 1))->getFormattedValue(),
            // 'rok_10' => $worksheet->getCell('K' . ($barisTerakhir + 2))->getFormattedValue(),
            // 'ppn_11' => $worksheet->getCell('K' . ($barisTerakhir + 3))->getFormattedValue(),
            // 'harga_total' => $worksheet->getCell('K' . ($barisTerakhir + 4))->getFormattedValue(),






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
        $hps = $this->refresh($id);
   
        $jenis_kontraks = JenisKontrak::where('id_kontrak', $id)->get()->toArray();
        // $hps = HPS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first();

        $kontrakbaru = [];


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
                        'harga_satuan' => empty($barjas['barjas_h_p_s']) ? 0 : $barjas['barjas_h_p_s'][0]['harga_satuan'],
                        'jumlah' => empty($barjas['barjas_h_p_s']) ? 0 : $barjas['barjas_h_p_s'][0]['jumlah'],
                        'sub_data' => $sub_data

                    ];
                }
            }


            $kontrakbaru[] = [
                'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
                'data' => $data

            ];
        }



        return view('plnpengadaan.kontraktahap1.HPS.isihps', compact('id', 'kontrakbaru', 'hps'));
        // Implementasi aksi isi
    }


    public function update(Request $request, $id)
    {
        // Mengecek apakah record HPS ada
        $hps = $this->refresh($id);
        if ($hps) {
            // Jika record HPS ada
            // Lakukan operasi lain yang diinginkan

            $hps = HPS::find($hps->id);
            $hps->id_surat = $id;
            $hps->total_jumlah = $request->input('total_jumlah');
            $hps->dibulatkan = $request->input('dibulatkan');
            $hps->rok10 = $request->input('rok10');
            $hps->ppn11 = $request->input('ppn11');
            $hps->total_harga = $request->input('harga_total');
            // $hps->tandatangan_pengadaan = $request->input('tandatangan_pengadaan');
            // $hps->tandatangan_manager = $request->input('tandatangan_manager');
            // Simpan data HPS
            $hps->save();
        } else {
            // Jika record HPS tidak ada

            // Buat instance HPS model untuk menyimpan data
            $hps = new HPS();
            $hps->id_surat = $id;
            $hps->total_jumlah = $request->input('total_jumlah');
            $hps->dibulatkan = $request->input('dibulatkan');
            $hps->rok10 = $request->input('rok10');
            $hps->ppn11 = $request->input('ppn11');
            $hps->total_harga = $request->input('harga_total');
            // $hps->tandatangan_pengadaan = $request->input('tandatangan_pengadaan');
            // $hps->tandatangan_manager = $request->input('tandatangan_manager');

            // Simpan data HPS
            $hps->save();
        }

        $kontrakkerja = KontrakKerja::find($id);
        $jenis_kontrak = JenisKontrak::where('id_kontrak', $id)->with('barjas')->get()->toArray();

        $barjashps = $request->input('hps');

        $no = 1;
        foreach ($jenis_kontrak as $jen) {
            foreach ($jen['barjas'] as $barjas) {
                $barjashps[$no]['id_barjas'] = $barjas['id'];
                $barjashps[$no]['id_hps'] = $hps->id;

                $no++;
            }
        }

        foreach ($barjashps as $bhps) {
            $databarjasHPS = BarJasHPS::where('id_hps', $bhps['id_hps'])->where('id_barjas', $bhps['id_barjas'])->first();

            if ($databarjasHPS) {
                $barjashps = BarJasHPS::find($databarjasHPS->id);
                $barjashps->harga_satuan = $bhps['harga_satuan'];
                $barjashps->jumlah = $bhps['jumlah'];
                $barjashps->save();
            } else {
                BarJasHPS::create([
                    'id_hps' => $bhps['id_hps'],
                    'id_barjas' => $bhps['id_barjas'],
                    'harga_satuan' => $bhps['harga_satuan'],
                    'jumlah' => $bhps['jumlah'],
                ]);
            }
        }
  


        return redirect()->route('pengajuankontrak.hps.isi', ['id' => $id])->with('success', 'Data berhasil disimpan.');
    }
    public function tandatangan($id, $jenis)
    {



        try {
            $hps = $this->refresh($id);


            $authId = Auth::id(); // Mendapatkan ID dari sesi pengguna yang terotentikasi
            $tandatangan = TandaTangan::where('id_akun', $authId)->first();

            if (!$tandatangan) {

                return redirect()->route('tandatangan.detail')->withErrors('Tandatangan belum dibuat.');
            }

            $kodeUnik = $tandatangan->kode_unik;

            $hps2 = HPS::find($hps->id);
            if ($jenis === 'pengadaan') {
                $hps2->tandatangan_pengadaan = $kodeUnik;
                $hps2->tanggal_tandatangan_pengadaan = Carbon::now();
            } elseif ($jenis === 'manager') {
                $hps2->tandatangan_manager = $kodeUnik;
                $hps2->tanggal_tandatangan_manager = Carbon::now();
            }

            $hps2->save();
         
            return redirect()->route('tandatangan.detail', ['id' => $id])->with('success', 'Tanda Tangan Berhasil');
        } catch (\Exception $e) {
            // Tangani error
            dd($e->getMessage()); // Cetak pesan error
        }
    }
}
