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
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\IOFactory;

class HPSController extends Controller
{
    public function refresh($id)
    {

        // Mengecek apakah record HPS ada
        $hps = HPS::where('id_kontrakkerja', $id)->first();


        if ($hps) {
            // Jika record HPS ada
            // Lakukan operasi lain yang diinginkan

            $hps = HPS::find($hps->id);
            $hps->save();
        } else {
            // Jika record HPS tidak ada

            // Buat instance HPS model untuk menyimpan data
            $hps = new HPS();
            $hps->id_kontrakkerja = $id;
            $hps->total_jumlah = 0;
            $hps->dibulatkan = 0;
            $hps->rok10 = 0;
            $hps->ppn11 = 0;
            $hps->total_harga = 0;
            $hps->tandatangan_pengadaan = 0;
            $hps->tandatangan_manager = 0;

            // Simpan data HPS
            $hps->save();
        }

        $kontrakkerja = KontrakKerja::find($id);
        $jenis_kontrak = JenisKontrak::where('id_kontrak', $kontrakkerja->id_kontrakkerja)->with('barjas')->get()->toArray();

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
        return 'Data Telah Direfresh';
    }

    // public function detail($id, $isDownload)
    // {
    //     $kontrak = KontrakKerja::find($id); // contoh data kontrak. Sesuaikan dengan kebutuhan Anda.
    //     $spreadsheet = IOFactory::load(storage_path('app/public/dokumenpenawaran/' . $kontrak->filemaster));
    //     $worksheet = $spreadsheet->setActiveSheetIndexByName('HPS');
    //     $nomor = $worksheet->getCell('B7')->getCalculatedValue();
    //     $tanggal = $worksheet->getCell('B8')->getFormattedValue();
    //     $nama_pekerjaan = $worksheet->getCell('B9')->getCalculatedValue();
    //     $nama_manager = $worksheet->getCell('A58')->getFormattedValue();
    //     $nama_pengadaan = $worksheet->getCell('J58')->getFormattedValue();

    //     $jenis_kontraks = JenisKontrak::where('id_kontrak', $kontrak->id_kontrakkerja)->get()->toArray();
    //     $kontrakbaru = [];

    //     foreach ($jenis_kontraks as $jenis_kontrak) {

    //         $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->get()->toArray();

    //         if (count($databarjas) != 0) {
    //             $data = [];
    //             foreach ($databarjas as $barjas) {


    //                 $sub_data = [];
    //                 $datasubbarjas = SubBarjas::where('id_barjas', $barjas['id'])->get()->toArray();
    //                 if (count($datasubbarjas) != 0) {
    //                     foreach ($datasubbarjas as $subbarjas) {
    //                         $sub_data[] = [
    //                             "id" => $subbarjas['id'],
    //                             "id_barjas" => $subbarjas['id_barjas'],
    //                             "uraian" => $subbarjas['uraian'],
    //                             "volume" => $subbarjas['volume'],
    //                             "satuan" => $subbarjas['satuan'],
    //                             // "harga_satuan" => $subbarjas['harga_satuan'],
    //                             // "jumlah" => $subbarjas['harga_satuan']
    //                         ];
    //                         # code...
    //                     }
    //                 }

    //                 $data[] = [
    //                     'id' => $barjas['id'],
    //                     'uraian' => $barjas['uraian'],
    //                     'vol' => $barjas['volume'],
    //                     'sat' => $barjas['satuan'],
    //                     // 'harga_satuan' => $barjas['harga_satuan'],
    //                     // 'jumlah' => $barjas['jumlah'],
    //                     'sub_data' => $sub_data

    //                 ];
    //             }
    //         }
    //         $kontrakbaru[] = [
    //             'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
    //             'data' => $data

    //         ];
    //     }
    //     $perhitungancontroller = app(PerhitunganController::class);
    //     $barisTerakhir =  $perhitungancontroller->mencariTotalHarga($spreadsheet, "HPS") + 0;

    //     $data2 = [
    //         'logokiri' => public_path('undangan/kiri.jpg'),
    //         'logo' => public_path('undangan/logo.png'), // path ke file header gambar
    //         // 'tandatangan' =>   DNS2D::getBarcodePNG('4', 'QRCODE'),
    //         // 'surat' => $surat
    //         'nomor' => $nomor,
    //         'tanggal_pekerjaan' => $tanggal,
    //         'nama_pekerjaan' => $nama_pekerjaan,
    //         'nama_manager' => $nama_manager,
    //         'pengadaan' => $nama_pengadaan,
    //         'jumlah_harga' => $worksheet->getCell('K' . $barisTerakhir)->getFormattedValue(),
    //         'dibulatkan' => $worksheet->getCell('K' . ($barisTerakhir + 1))->getFormattedValue(),
    //         'rok_10' => $worksheet->getCell('K' . ($barisTerakhir + 2))->getFormattedValue(),
    //         'ppn_11' => $worksheet->getCell('K' . ($barisTerakhir + 3))->getFormattedValue(),
    //         'harga_total' => $worksheet->getCell('K' . ($barisTerakhir + 4))->getFormattedValue(),






    //     ];

    //     $pdf = PDF::loadView('plnpengadaan.kontraktahap1.HPS.hps', compact('data2', 'kontrakbaru'));
    //     $pdf->setOption(['isRemoteEnabled' => true]);

    //     $namefile = 'HPS_' . time() . '.pdf';
    //     if ($isDownload == 1) {
    //         // Menampilkan output di browser
    //         return $pdf->stream($namefile);
    //     } else if ($isDownload == 2) {
    //         // Download file
    //         return $pdf->download($namefile);
    //     } else {
    //         return "Parameter tidak valid";
    //     }
    // }

    public function detail($id, $isDownload)
    {
        $this->refresh($id);
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
                        'harga_satuan' => $barjas['barjas_h_p_s'][0]['harga_satuan'],
                        'jumlah' => $barjas['barjas_h_p_s'][0]['jumlah'],
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
            'jumlah_harga' => HPS::where('id_kontrakkerja', $id)->first()->total_jumlah,
            'dibulatkan' => HPS::where('id_kontrakkerja', $id)->first()->dibulatkan,
            'rok_10' => HPS::where('id_kontrakkerja', $id)->first()->rok10,
            'ppn_11' => HPS::where('id_kontrakkerja', $id)->first()->ppn11,
            'harga_total' => HPS::where('id_kontrakkerja', $id)->first()->total_harga,



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

    // public function isi($id)
    // {
    //     $kontrakkerja = KontrakKerja::find($id);
    //     $spreadsheet = IOFactory::load(storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster));
    //     $worksheet = $spreadsheet->setActiveSheetIndexByName('HPS');
    //     $perhitungancontroller = app(PerhitunganController::class);
    //     $koordinatawal = preg_split('/(?<=\D)(?=\d)|(?<=\d)(?=\D)/', $perhitungancontroller->mencariKoordinatCell($spreadsheet, "HPS", "URAIAN"));
    //     $koordinatawal[0] = 'B';
    //     $koordinatawal[1] = $koordinatawal[1] + 4;
    //     $koordinatakhir =  preg_split('/(?<=\D)(?=\d)|(?<=\d)(?=\D)/', $perhitungancontroller->mencariKoordinatCell($spreadsheet, "HPS", "JUMLAH HARGA"));
    //     $koordinatakhir[0] = 'B';
    //     $koordinatakhir[1] = $koordinatakhir[1] - 1;

    //     // Perulangan dari sel B18 hingga K18 sampai baris akhir
    //     $baris = [];
    //     for ($row = $koordinatawal[1]; $row <= $koordinatakhir[1]; $row++) {

    //         $kolom = [];
    //         for ($column = $koordinatawal[0]; $column <= 'K'; $column++) {
    //             $cellValue = $worksheet->getCell($column . $row)->getFormattedValue();
    //             $kolom[] = $cellValue;
    //             // Lakukan operasi yang Anda perlukan di sini
    //             // Misalnya, tampilkan nilai sel atau lakukan manipulasi lainnya
    //             // echo "Nilai sel {$column}{$row}: {$cellValue}<br>";
    //         }
    //         $baris[] = $kolom;
    //     }
    //     // Menghapus baris 18 hingga 39
    //     $worksheet->removeRow(18, 39 - 18 + 1);

    //     // Menambahkan 23 baris baru mulai dari baris 18
    //     $worksheet->insertNewRowBefore(18, 23);

    //     // Menambahkan data
    //     $koordinatawal = preg_split('/(?<=\D)(?=\d)|(?<=\d)(?=\D)/', $perhitungancontroller->mencariKoordinatCell($spreadsheet, "HPS", "URAIAN"));
    //     $koordinatawal[0] = 'B';
    //     $koordinatawal[1] = $koordinatawal[1] + 4;
    //     $koordinatakhir =  preg_split('/(?<=\D)(?=\d)|(?<=\d)(?=\D)/', $perhitungancontroller->mencariKoordinatCell($spreadsheet, "HPS", "JUMLAH HARGA"));
    //     $koordinatakhir[0] = 'B';
    //     $koordinatakhir[1] = $koordinatakhir[1] - 1;
    //     $indexrow = 0;

    //     for ($row = $koordinatawal[1]; $row <= $koordinatakhir[1]; $row++) {

    //         $indexcolumn = 0;
    //         if ($indexrow < count($baris)) {
    //             // echo "sekarang baris ke {$indexrow} dengan data : ";
    //             // print_r($baris[$indexrow]); 
    //             // echo "<br>";
    //             for ($column = 'B'; $column <= 'K'; $column++) {
    //                 // echo "sekarang baris ke {$indexrow} dan kolom ke {$indexcolumn} dengan data : ";
    //                 // print_r($baris[$indexrow][]);
    //                 // echo $baris[$indexrow][$indexcolumn];
    //                 // echo "<br>";
    //                 if ($indexcolumn < count($baris[$indexcolumn])) {
    //                     $data = $baris[$indexrow][$indexcolumn];
    //                     $worksheet->setCellValue(strval($column . $row), $data);
    //                 }
    //                 $indexcolumn++;
    //             }
    //             $indexrow++;
    //         }
    //     }
    //     // Menambahkan nilai "Hello World" pada baris ke-22 di kolom B
    //     $cell = 'D22';
    //     $worksheet->setCellValue($cell, "Hello World");
    //     $cell = 'D23';
    //     $worksheet->setCellValue($cell, "Hello World");
    //     $cell =  $worksheet->getCell('A58')->getValue();
    //     echo $cell;
    //     // // Simpan ke file
    //     // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    //     // $writer->save(storage_path('app/public/latihan/semblele.xlsx'));
    //     // return view('plnpengadaan.kontraktahap1.HPS.isihps', compact('id'));
    //     // Implementasi aksi isi
    // }
    public function isi($id)
    {
        $this->refresh($id);
        $kontrakkerja = KontrakKerja::find($id);
        $jenis_kontraks = JenisKontrak::where('id_kontrak', $kontrakkerja->id_kontrakkerja)->get()->toArray();
        $hps = HPS::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first();

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
        $hps = HPS::where('id_kontrakkerja', $id)->first();
        if ($hps) {
            // Jika record HPS ada
            // Lakukan operasi lain yang diinginkan

            $hps = HPS::find($hps->id);
            $hps->id_kontrakkerja = $id;
            $hps->dibulatkan = $request->input('dibulatkan');
            $hps->rok10 = $request->input('rok10');
            $hps->ppn11 = $request->input('ppn11');
            $hps->total_harga = $request->input('harga_total');
            $hps->tandatangan_pengadaan = $request->input('tandatangan_pengadaan');
            $hps->tandatangan_manager = $request->input('tandatangan_manager');
            // Simpan data HPS
            $hps->save();
        } else {
            // Jika record HPS tidak ada

            // Buat instance HPS model untuk menyimpan data
            $hps = new HPS();
            $hps->id_kontrakkerja = $id;
            $hps->dibulatkan = $request->input('dibulatkan');
            $hps->rok10 = $request->input('rok10');
            $hps->ppn11 = $request->input('ppn11');
            $hps->total_harga = $request->input('harga_total');
            $hps->tandatangan_pengadaan = $request->input('tandatangan_pengadaan');
            $hps->tandatangan_manager = $request->input('tandatangan_manager');

            // Simpan data HPS
            $hps->save();
        }

        $kontrakkerja = KontrakKerja::find($id);
        $jenis_kontrak = JenisKontrak::where('id_kontrak', $kontrakkerja->id_kontrakkerja)->with('barjas')->get()->toArray();

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
        // $barjas = BarJasHPS::


        return redirect()->route('pengajuankontrak.hps.isi', ['id' => $id])->with('success', 'Data berhasil disimpan.');
    }
}
