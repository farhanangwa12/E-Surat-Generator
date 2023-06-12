<?php

namespace App\Http\Controllers\pengadaantahap1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SuratVendor\LampiranPenawaranHargaController;
use App\Models\Dokumen\BarJasBOQ;
use App\Models\Dokumen\BOQ;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\NamedRange;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use TCPDF;
use PDF;
use Terbilang;

class BOQController extends Controller
{
    public function refresh($id)
    {

        // Mengecek apakah record HPS ada
        $boq = BOQ::where('id_kontrakkerja', $id)->first();


        if ($boq) {
            // Jika record boq ada
            // Lakukan operasi lain yang diinginkan

            $boq = BOQ::find($boq->id);
            $boq->save();
        } else {
            // Jika record HPS tidak ada

            // Buat instance HPS model untuk menyimpan data
            $boq = new BOQ;
            $boq->id_kontrakkerja = $id;
            $boq->total_jumlah = 0;
            $boq->dibulatkan = 0;

            $boq->ppn11 = 0;
            $boq->total_harga = 0;
            $boq->tandatangan_direktur = null;

            // Simpan data boq
            $boq->save();
        }

        $kontrakkerja = KontrakKerja::find($id);
        $jenis_kontrak = JenisKontrak::where('id_kontrak', $kontrakkerja->id_kontrakkerja)->with('barjas')->get()->toArray();

        $barjasboq = [];

        $no = 1;
        foreach ($jenis_kontrak as $jen) {
            foreach ($jen['barjas'] as $barjas) {
                $barjasboq[$no]['id_barjas'] = $barjas['id'];
                $barjasboq[$no]['id_boq'] = $boq->id;

                $no++;
            }
        }

        foreach ($barjasboq as $bboq) {
            $databarjasBOQ = BarJasBOQ::where('id_boq', $bboq['id_boq'])->where('id_barjas', $bboq['id_barjas'])->first();

            // dd($bboq['id_boq']);
            if ($databarjasBOQ) {
                $barjasboq = BarJasBOQ::find($databarjasBOQ->id);
                $barjasboq->save();
            } else {
                // $bboq['id_boq']);
                BarJasBOQ::create([
                    'id_boq' => $bboq['id_boq'],
                    'id_barjas' => $bboq['id_barjas'],
                    'harga_satuan' => 0,
                    'jumlah' => 0,
                ]);
            }
        }
        return 'Data Telah Direfresh';
    }
    public function index($id)
    {
        return view('plnpengadaan.kontraktahap1.BOQ.boq', compact('id'));
    }
    // public function store(Request $request, $id)
    // {


    //     $boq = KontrakKerja::find($id);
    //     $spreadsheet = IOFactory::load(storage_path('app/public/dokumenpenawaran/' . $boq->filemaster));
    //     $worksheet = $spreadsheet->setActiveSheetIndexByName('BOQ');

    //     // Mencari Endline Baris
    //     $endLineCoordinat = '';
    //     // Loop Worksheet 
    //     foreach ($worksheet->getRowIterator() as $row) {
    //         foreach ($row->getCellIterator() as $cell) {
    //             // cek nilai jika memenuhi "JUMLAH HARGA"
    //             if ($cell->getValue() == "JUMLAH HARGA") {
    //                 // Mengambil koordinat
    //                 $endLineCoordinat = $cell->getCoordinate();

    //                 // Exit
    //                 break 2;
    //             }
    //         }
    //     }


    //     // // Menghapus Baris mengidentifikasi
    //     // $coordinateObject = Coordinate::coordinateFromString($endLineCoordinat);
    //     // // Get the column and row index of the starting coordinate
    //     // $row = 19 - $coordinateObject[1]-1;
    //     // $worksheet->removeRow(19, $row);

    //     // Hitung jumlah request yang masuk dikurangi token
    //     $total = count($request->all()) - 1;
    //     $worksheet->insertNewRowBefore(19, ($total - 2));


    //     // translasi Array dari request ke variabel data
    //     $data = [];
    //     foreach ($request->input('no') as $key => $value) {
    //         $data[] = [$value, $request->input('uraian')[$key], null, null, null, null, $request->input('vol')[$key], $request->input('sat')[$key], $request->input('harga_satuan')[$key], $request->input('jumlah')[$key]];
    //     }
    //     $startCol = 2;
    //     $startRow = 18;



    //     // Merge Cell pada Uraian
    //     for ($i = 0; $i < count($data); $i++) {
    //         // menentukan string referensi sel untuk sel pada kolom C-F dan baris 19-24
    //         $startCell = 'C' . $startRow;
    //         $endCell = 'F' . $startRow;

    //         // menggabungkan sel pada kolom C-F dan baris 19-24 dengan menggunakan string referensi sel
    //         $worksheet->mergeCells($startCell . ':' . $endCell);
    //     }

    //     // Mengisi data ke File
    //     foreach ($data as $row => $rowData) {

    //         foreach ($rowData as $col => $value) {

    //             $cell = $worksheet->getCell([$startCol + $col, $startRow + $row]);
    //             $cell->setValue($value);
    //         }
    //     }










    //     $writter = IOFactory::createWriter($spreadsheet, 'Xlsx');
    //     // $writter->save(storage_path('app/public/dokumenpenawaran/' . $boq->filemaster));
    //     $writter->save(storage_path('app/public/dokumenpenawaran/bug5.xlsx'));
    //     return redirect()->route('pengajuankontrak.detail', ['id' => $id]);
    // }
    // public function detail($id, $isDownloaded)
    // {
    //     $data = [
    //         'test' => 'test'

    //     ];
    //     $pdf = PDF::loadView('plnpengadaan.kontraktahap1.BOQ.boqisi', $data);
    //     $pdf->setOption(['isRemoteEnabled' => true]);

    //     $namefile = 'BOQ_' . time() . '.pdf';
    //     if ($isDownloaded == 1) {
    //         // Menampilkan output di browser
    //         return $pdf->stream($namefile);
    //     } else if ($isDownloaded == 2) {
    //         // Download file
    //         return $pdf->download($namefile);
    //     } else {
    //         return "Parameter tidak valid";
    //     }
    // }

    public function detail($id, $isDownloaded)
    {
        $this->refresh($id);
        $kontrak = KontrakKerja::find($id); // contoh data kontrak. Sesuaikan dengan kebutuhan Anda.

        $nomor = PembuatanSuratKontrak::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_surat', 'nomor_rks')->first()->no_surat;

        $tanggal = PembuatanSuratKontrak::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_surat', 'nomor_rks')->first()->tanggal_pembuatan;
        $nama_pekerjaan = $kontrak->nama_kontrak;

        $nama_perusahaan = Vendor::find($kontrak->id_vendor)->first()->penyedia;
        $nama_direktur = Vendor::find($kontrak->id_vendor)->first()->direktur;


        $jenis_kontraks = JenisKontrak::where('id_kontrak', $kontrak->id_kontrakkerja)->get()->toArray();
        $kontrakbaru = [];


        foreach ($jenis_kontraks as $jenis_kontrak) {

            $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->with('barJasBOQs')->get()->toArray();
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
                        'harga_satuan' => $barjas['bar_jas_b_o_qs'][0]['harga_satuan'],
                        'jumlah' => $barjas['bar_jas_b_o_qs'][0]['jumlah'],
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
            'tanggal_pekerjaan' => Carbon::createFromFormat('Y-m-d', $tanggal)->locale('id')->isoFormat('D MMMM YYYY'),
            'nama_pekerjaan' => $nama_pekerjaan,

            'penyedia' => $nama_perusahaan,
            'nama_direktur' => $nama_direktur,

            'jumlah_harga' => BOQ::where('id_kontrakkerja', $id)->first()->total_jumlah,
            'dibulatkan' => BOQ::where('id_kontrakkerja', $id)->first()->dibulatkan,

            'ppn_11' => BOQ::where('id_kontrakkerja', $id)->first()->ppn11,

            'harga_total' => BOQ::where('id_kontrakkerja', $id)->first()->total_harga,



            // 'jumlah_harga' => $worksheet->getCell('K' . $barisTerakhir)->getFormattedValue(),
            // 'dibulatkan' => $worksheet->getCell('K' . ($barisTerakhir + 1))->getFormattedValue(),
            // 'rok_10' => $worksheet->getCell('K' . ($barisTerakhir + 2))->getFormattedValue(),
            // 'ppn_11' => $worksheet->getCell('K' . ($barisTerakhir + 3))->getFormattedValue(),
            // 'harga_total' => $worksheet->getCell('K' . ($barisTerakhir + 4))->getFormattedValue(),






        ];

        $pdf = PDF::loadView('plnpengadaan.kontraktahap1.BOQ.boqisi',  compact('data2', 'kontrakbaru'));
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'BOQ_' . time() . '.pdf';
        if ($isDownloaded == 1) {
            // Menampilkan output di browser
            return $pdf->stream($namefile);
        } else if ($isDownloaded == 2) {
            // Download file
            return $pdf->download($namefile);
        } else {
            return "Parameter tidak valid";
        }
    }

    public function isi($id)
    {
        $this->refresh($id);
        $kontrakkerja = KontrakKerja::find($id);
        $jenis_kontraks = JenisKontrak::where('id_kontrak', $kontrakkerja->id_kontrakkerja)->get()->toArray();
        $boq = BOQ::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first();

        $kontrakbaru = [];


        foreach ($jenis_kontraks as $jenis_kontrak) {

            $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->with('barJasBOQs')->get()->toArray();
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
                        'harga_satuan' => empty($barjas['bar_jas_b_o_qs']) ? 0 : $barjas['bar_jas_b_o_qs'][0]['harga_satuan'],
                        'jumlah' => empty($barjas['bar_jas_b_o_qs']) ? 0 : $barjas['bar_jas_b_o_qs'][0]['jumlah'],
                        'sub_data' => $sub_data

                    ];
                }
            }


            $kontrakbaru[] = [
                'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
                'data' => $data

            ];
        }


        return view('plnpengadaan.kontraktahap1.BOQ.boqvendor', compact('id', 'kontrakbaru', 'boq'));
    }
    public function update(Request $request, $id)
    {
        $lampiranpenawaran = App(LampiranPenawaranHargaController::class);

        // Mengecek apakah record HPS ada
        $boq = BOQ::where('id_kontrakkerja', $id)->first();
        if ($boq) {
            // Jika record boq ada
            // Lakukan operasi lain yang diinginkan

            $boq = BOQ::find($boq->id);
            $boq->id_kontrakkerja = $id;
            $boq->total_jumlah = $request->input('total_jumlah');
            $boq->dibulatkan = $request->input('dibulatkan');

            $boq->ppn11 = $request->input('ppn11');
            $boq->total_harga = $request->input('harga_total');
            $boq->tandatangan_direktur = $request->input('tandatangan_direktur');

            // Simpan data boq
            $boq->save();
        } else {
            // Jika record HPS tidak ada

            // Buat instance HPS model untuk menyimpan data
            $boq = new BOQ();
            $boq->id_kontrakkerja = $id;
            $boq->total_jumlah = $request->input('total_jumlah');
            $boq->dibulatkan = $request->input('dibulatkan');

            $boq->ppn11 = $request->input('ppn11');
            $boq->total_harga = $request->input('harga_total');
            $boq->tandatangan_direktur = $request->input('tandatangan_direktur');

            // Simpan data boq
            $boq->save();
        }

        $kontrakkerja = KontrakKerja::find($id);
        $jenis_kontrak = JenisKontrak::where('id_kontrak', $kontrakkerja->id_kontrakkerja)->with('barjas')->get()->toArray();

        $barjasboq = $request->input('boq');
        // Merge ke lampiran untuk dikirim ke lampiranpenawranharga
        $request->merge(['lampiran'=> $barjasboq]);
        $no = 0;
        foreach ($jenis_kontrak as $jen) {
            foreach ($jen['barjas'] as $barjas) {
                $barjasboq[$no]['id_barjas'] = $barjas['id'];
                $barjasboq[$no]['id_boq'] = $boq->id;

                $no++;
            }
        }

        $boq = BOQ::where('id_kontrakkerja', $id)->first();
        foreach ($barjasboq as $bboq) {
  
            $databarjasboq = BarJasBOQ::where('id_boq', $boq->id)->where('id_barjas', $bboq['id_barjas'])->first();

            if ($databarjasboq) {
                $barjasboq = BarJasBOQ::find($databarjasboq->id);
                $barjasboq->harga_satuan = $bboq['harga_satuan'];
                $barjasboq->jumlah = $bboq['jumlah'];
                $barjasboq->save();
            } else {
                BarJasBOQ::create([
                    'id_boq' => $bboq['id_boq'],
                    'id_barjas' => $bboq['id_barjas'],
                    'harga_satuan' => $bboq['harga_satuan'],
                    'jumlah' => $bboq['jumlah'],
                ]);
            }
        }
       
        $lampiranpenawaran->refresh($id);
        $lampiranpenawaran->update($request, $id);


        // return redirect()->route('pengajuankontrak.hps.isi', ['id' => $id])->with('success', 'Data berhasil disimpan.');
        // Redirect ke route dengan parameter ID
        return redirect()->route('pengajuankontrak.boq.isi', $id)->with('success', 'Data berhasil diperbarui');


        // return view('plnpengadaan.kontraktahap1.BOQ.boq', compact('id'));
    }

    public function tandatanganvendor($id)
    {

        $this->refresh($id);
        // Logika atau proses yang ingin Anda lakukan dalam metode ini
        return view('plnpengadaan.kontraktahap1.BOQ.boqtandatangandirektur', compact('id'));
    }
    public function simpantandatangan(Request $request)
    {
        $vendor = $request->file('vendor');

        $id = $request->input('id');


        // $kontrak = KontrakKerja::find($id);


        // $fileName = time() . '_' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();

        // $file->move(storage_path('app/public/tandatangan'), $fileName);

        $tandatangan = BOQ::where('id_kontrakkerja', $id)->first();
        $this->refresh($tandatangan->id);

        // ID Tandatangan HPS

        if ($vendor) {

            if ($request->hasFile('vendor')) {

                $fileName = time() . '_' . $vendor->getClientOriginalName();
                $vendor->storeAs('public/tandatangan', $fileName);

                // Simpan nama file ke kolom tandatangan_pengadaan dalam model HPS
                $boq = BOQ::find($tandatangan->id);
                $boq->tandatangan_direktur = $fileName;
                $boq->save();

                return 'Tanda Tangan Vendor Berhasil.';
            }

            return 'Tanda Tangan Gagal karena tanda tangan tidak ada.';
        }
    }
}
