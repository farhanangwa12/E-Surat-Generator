<?php

namespace App\Http\Controllers;

use App\Http\Controllers\pengadaantahap1\BOQController;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use App\Models\SumberAnggaran;
use App\Models\TandaTangan;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KontrakKerjaController extends Controller
{



    private function dateConverter($date)
    {
        return str_replace("/", "-", $date);
    }
    public function changeStatus($id, $status, $routeName)
    {
        $kontrak = KontrakKerja::find($id);
        $kontrak->status = $status;
        $kontrak->save();
        return redirect()->route($routeName);
    }

    public function index()
    {
        $status = [
            'Dokumen Input Pengadaan Tahap 1',
            'Kontrak dibatalkan vendor',
            'Kontrak Kerja Berjalan'
        ];
        $kontrak = KontrakKerja::with('vendor')->whereIn('status', $status)->get();


        // print_r($kontrak[0]['vendor']['penyedia']);
        return view('plnpengadaan.kontraktahap1.pengajuankontrak', compact('kontrak'));
    }
    public function create()
    {
        $vendor = Vendor::all();

        return view('plnpengadaan.kontraktahap1.create', compact('vendor'));
    }
    // Download File di tambah kontrak
    public function downloadTemplate()
    {
        $filePath = 'public/templateformat/isi2tahap2.xlsx';
        $storagePath = storage_path('app/' . $filePath);

        if (!Storage::exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($storagePath, 'isi2tahap.xlsx');
    }
    // Upload file excel di tambah kontrak dan edit kontrak
    public function uploadFileExcel(Request $request)
    {
        // Ambil file dari request
        $file = $request->file('input_file');


        // Validasi apakah file sudah di-upload
        if (!empty($file)) {
            // Validasi apakah file adalah tipe file yang diizinkan
            $allowedTypes = ['xls', 'xlsx'];
            if (in_array($file->getClientOriginalExtension(), $allowedTypes)) {
                // Simpan file ke storage
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/latihan', $fileName);

                $spreadsheet = IOFactory::load(storage_path('app/' . $path));
                $worksheetMaster = $spreadsheet->setActiveSheetIndexByName('MASTER');
                /* 
                       Memindahkan file upload ke template
                */

                // Mendapatkan path file template
                $templatePath = storage_path('app/public/templateformat/template.xlsx');

                // Memuat file template XLSX menggunakan PhpSpreadsheet lalu set ke Worksheet MASTER
                $templateSpreadsheet = IOFactory::load($templatePath);
                $templateWorksheet = $templateSpreadsheet->setActiveSheetIndexByName('MASTER');
                // Menyalin file uploadan worksheet master ke template
                $templateWorksheet->setCellValue('C6', $worksheetMaster->getCell('C6')->getCalculatedValue());
                $templateWorksheet->setCellValue('C12', strtoupper($worksheetMaster->getCell('C12')->getCalculatedValue()));
                $templateWorksheet->setCellValue('K5', $worksheetMaster->getCell('K5')->getCalculatedValue());
                $templateWorksheet->setCellValue('K6', $worksheetMaster->getCell('K6')->getCalculatedValue());
                $templateWorksheet->setCellValue('K7', $worksheetMaster->getCell('K7')->getCalculatedValue());
                $templateWorksheet->setCellValue('C22', $worksheetMaster->getCell('C22')->getCalculatedValue());

                // SPMK
                $templateWorksheet->setCellValue('C8', $worksheetMaster->getCell('C8')->getCalculatedValue());
                $templateWorksheet->setCellValue('C9', $worksheetMaster->getCell('C9')->getCalculatedValue());

                // Tanggal Pengerjaan Dokumen
                $L10master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L10')->getCalculatedValue());
                $L11master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L11')->getCalculatedValue());
                $L12master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L12')->getCalculatedValue());
                $L13master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L13')->getCalculatedValue());
                $L14master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L14')->getCalculatedValue());
                $L18master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L18')->getCalculatedValue());
                $L19master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L19')->getCalculatedValue());
                $L20master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L20')->getCalculatedValue());
                $L21master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L21')->getCalculatedValue());
                $L22master =  Date::excelToDateTimeObject($worksheetMaster->getCell('L22')->getCalculatedValue());

                $templateWorksheet->setCellValue('L10', $L10master->format('d/m/Y'));
                $templateWorksheet->setCellValue('L11', $L11master->format('d/m/Y'));
                $templateWorksheet->setCellValue('L12', $L12master->format('d/m/Y'));
                $templateWorksheet->setCellValue('L13', $L13master->format('d/m/Y'));
                $templateWorksheet->setCellValue('L14', $L14master->format('d/m/Y'));


                $templateWorksheet->setCellValue('L18', $L18master->format('d/m/Y'));
                $templateWorksheet->setCellValue('L19', $L19master->format('d/m/Y'));
                $templateWorksheet->setCellValue('L20', $L20master->format('d/m/Y'));
                $templateWorksheet->setCellValue('L21', $L21master->format('d/m/Y'));
                $templateWorksheet->setCellValue('L22', $L22master->format('d/m/Y'));


                $C26template =  Date::excelToDateTimeObject($worksheetMaster->getCell('C27')->getCalculatedValue());
                // Anggaran
                $templateWorksheet->setCellValue('C26', $worksheetMaster->getCell('C26')->getCalculatedValue());
                $templateWorksheet->setCellValue('C27',  $C26template->format('d/m/Y'));

                // Vendor
                $templateWorksheet->setCellValue('F29', $worksheetMaster->getCell('F29')->getCalculatedValue());
                $templateWorksheet->setCellValue('F30', $worksheetMaster->getCell('F30')->getCalculatedValue());
                $templateWorksheet->setCellValue('F31', $worksheetMaster->getCell('F31')->getCalculatedValue());
                $templateWorksheet->setCellValue('F32', $worksheetMaster->getCell('F32')->getCalculatedValue());
                $templateWorksheet->setCellValue('F34', $worksheetMaster->getCell('F34')->getCalculatedValue());
                $templateWorksheet->setCellValue('F35', $worksheetMaster->getCell('F35')->getCalculatedValue());


                // Penyelenggara
                $templateWorksheet->setCellValue('F37', $worksheetMaster->getCell('F37')->getCalculatedValue());
                $templateWorksheet->setCellValue('F38', $worksheetMaster->getCell('F38')->getCalculatedValue());
                $templateWorksheet->setCellValue('F40', $worksheetMaster->getCell('F40')->getCalculatedValue());
                $templateWorksheet->setCellValue('F41', $worksheetMaster->getCell('F41')->getCalculatedValue());
                $templateWorksheet->setCellValue('F42', $worksheetMaster->getCell('F42')->getCalculatedValue());
                $templateWorksheet->setCellValue('F43', $worksheetMaster->getCell('F43')->getCalculatedValue());


                // Menyimpan ke kontrak
                // $newFileName = 'dokumenmeong_' . uniqid() . '.xlsx';
                $newFileName = 'dokumen_' . uniqid() . '.xlsx';
                // Simpan ke database 
                $kontrakkerja = new KontrakKerja();
                $kontrakkerja->nama_kontrak = $templateWorksheet->getCell('C12')->getCalculatedValue();
                $kontrakkerja->tanggal_pekerjaan = date('Y-m-d', strtotime($this->dateConverter($templateWorksheet->getCell('C10')->getCalculatedValue())));

                $kontrakkerja->tanggal_akhir_pekerjaan = date('Y-m-d', strtotime($this->dateConverter($templateWorksheet->getCell('C10')->getCalculatedValue()) . ' + ' . $this->dateConverter($templateWorksheet->getCell('C6')->getCalculatedValue()) . ' days '));
                $kontrakkerja->id_vendor = 1;
                $kontrakkerja->lokasi_pekerjaan = $templateWorksheet->getCell('C22')->getValue();
                $kontrakkerja->status = "Dokumen Input Pengadaan Tahap 1";
                $kontrakkerja->no_urut = $templateWorksheet->getCell('K5')->getValue();
                $kontrakkerja->tahun = $templateWorksheet->getCell('K6')->getValue();
                $kontrakkerja->kode_masalah = $templateWorksheet->getCell('K7')->getValue();
                $kontrakkerja->filemaster = $newFileName;

                $kontrakkerja->save();
                $id = $kontrakkerja->id_kontrakkerja;

                // SumberAnggaran
                $anggaran = new SumberAnggaran();
                $anggaran->id_kontrakkerja = $id;
                $anggaran->skk_ao = $templateWorksheet->getCell('C66')->getCalculatedValue();

                $anggaran->tanggal_anggaran = $templateWorksheet->getCell('C67')->getCalculatedValue();

                $anggaran->save();


                //Penyelenggara
                $penyelenggaraArr =  [
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'manager',
                        'nama_pengguna' => $templateWorksheet->getCell('F37')->getCalculatedValue()
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'pejabat_pelaksana_pengadaan',
                        'nama_pengguna' => $templateWorksheet->getCell('F38')->getCalculatedValue()
                    ],

                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'direksi',
                        'nama_pengguna' => $templateWorksheet->getCell('F40')->getCalculatedValue()


                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'pengawas_pekerjaan',
                        'nama_pengguna' => $templateWorksheet->getCell('F41')->getCalculatedValue()
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'pengawas_k3',
                        'nama_pengguna' => $templateWorksheet->getCell('F42')->getCalculatedValue()
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'pengawas_lapangan',
                        'nama_pengguna' => $templateWorksheet->getCell('F43')->getCalculatedValue()
                    ],




                ];
                foreach ($penyelenggaraArr as $key) {
                    Penyelenggara::create($key);
                }


                //PembuatansuratKontrak
                $pembuatansuratkontrak =  [
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_rks',
                        'no_surat' => $worksheetMaster->getCell('K10')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L10')->getCalculatedValue())))
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_hps',
                        'no_surat' => $worksheetMaster->getCell('K11')->getCalculatedValue(),
                        'tanggal_pembuatan' => date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L11')->getCalculatedValue())))
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_pakta_pejabat',
                        'no_surat' => $worksheetMaster->getCell('K12')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L12')->getCalculatedValue())))
                    ],

                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_undangan',
                        'no_surat' => $worksheetMaster->getCell('K13')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L13')->getCalculatedValue())))
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_pakta_pengguna',
                        'no_surat' => $worksheetMaster->getCell('K14')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L14')->getCalculatedValue())))
                    ],

                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_ba_buka',
                        'no_surat' => $worksheetMaster->getCell('K18')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L18')->getCalculatedValue())))
                    ],

                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_ba_evaluasi',
                        'no_surat' => $worksheetMaster->getCell('K19')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L19')->getCalculatedValue())))
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_ba_negosiasi',
                        'no_surat' => $worksheetMaster->getCell('K20')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L20')->getCalculatedValue())))
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_ba_hasil_pl',
                        'no_surat' => $worksheetMaster->getCell('K21')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L21')->getCalculatedValue())))
                    ],

                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_spk',
                        'no_surat' => $worksheetMaster->getCell('K22')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheetMaster->getCell('L22')->getCalculatedValue())))
                    ],





                ];
                foreach ($pembuatansuratkontrak as $key) {
                    PembuatanSuratKontrak::create($key);
                }



                // Menulis perubahan ke file template.xlsx
                $writer = new Xlsx($templateSpreadsheet);
                // Generate Random Filename

                $writer->save(storage_path('app/public/dokumenpenawaran/' . $newFileName));












                $worksheet = $spreadsheet->getSheetByName('BOQ');
                // $cellValue = $worksheet->getCell('C14')->getCalculatedValue();


                // Get highest column and row
                $highestColumn = $worksheet->getHighestColumn();
                $highestRow = $worksheet->getHighestDataRow();
                $barisTerakhir = '';
                // Loop through each row
                for ($row = 1; $row <= $highestRow; $row++) {
                    // Loop through each column
                    for ($col = 'A'; $col <= $highestColumn; $col++) {
                        // Get cell coordinate
                        $cellCoordinate = $col . $row;

                        // Get cell value
                        $cellValue = $worksheet->getCell($cellCoordinate)->getValue();

                        // Check if cell value is "JUMLAH HARGA"
                        if ($cellValue == "JUMLAH HARGA") {

                            $barisTerakhir = preg_replace("/[^0-9]/", "", $cellCoordinate) - 1;

                            break 2;
                        }
                    }
                }

                // // Menghapus baris
                // $worksheet->removeRow(18,$barisTerakhir-18);

                // Mendapatkan koordinat cell terakhir
                $highestColumn = $worksheet->getHighestColumn();
                $highestRow = $worksheet->getHighestRow();
                // Tempat menyimpan data dari excel
                $data = [];
                // Mengulangi setiap baris dari baris 18 hingga baris 39

                for ($row = 18; $row <= $barisTerakhir; $row++) {

                    $column = [];
                    // Mengulangi setiap kolom dari kolom B hingga K
                    for ($col = 'B'; $col <= "K"; $col++) {

                        // Mengambil nilai cell pada kolom dan baris tertentu
                        $cellValue = $worksheet->getCell(strval($col . $row))->getCalculatedValue();
                        // Lakukan sesuatu dengan nilai cell yang diambil
                        // echo "Nilai cell " . $col . $row . " adalah: " . $cellValue . "\n";
                        $column[] = $cellValue;
                    }
                    $data[] = $column;
                }





                // Pembersihan Data Array yang kosong
                $datanonnull = array_filter($data, function ($value) {

                    $count = 0;
                    foreach ($value as $fr) {
                        if (empty($fr)) {

                            $count++;
                        }
                    }


                    // print_r($count);
                    if ($count < 9) {
                        return true;
                    } else {
                        return false;
                    }
                });
                // Menentukan tipenya berdasarkan jenis
                $dataurutan = array_values($datanonnull);



                $nojenis = 0;
                $nobarjas = 0;
                $nosubbarjas = 0;

                $datahasil = [];
                // $jenis = [];
                // $barjas = [];
                // $subbarjas = [];
                foreach ($dataurutan as $data) {

                    // check apakah romawi diikuti titik ex : I.
                    if (preg_match("/^(M{0,3})(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})\.$/", $data[0])) {
                        $nojenis++;

                        $datahasil[$nojenis] =  [
                            'id_jenis' => $data[0],
                            'nama_jenis' => $data[2],

                            'data' => null

                        ];
                    }
                    // Uraian
                    if (preg_match("/\d/", $data[0])) {
                        $nobarjas++;



                        $datahasil[$nojenis]['data'][$nobarjas] =  [
                            'id_barjas' => $data[0],
                            'nama' => $data[2],
                            'vol' => $data[6],
                            'sat' => $data[7],
                            'sub_data' => null

                        ];
                    }
                    if (preg_match("/^[-].*$/", $data[2])) {
                        $nosubbarjas++;


                        $datahasil[$nojenis]['data'][$nobarjas]['sub_data'][$nosubbarjas] =  [
                            'id_subbarjas' => $data[0],
                            'nama' => $data[2],
                            'vol' => $data[6],
                            'sat' => $data[7]
                        ];
                    }
                }



                // Mengurutkan index key
                // $dataolahurutindex = [];
                // foreach ($datahasil as $data) {
                //     $data.
                // }

                // print_r($data);
                // Masukkan ke database
                $hasildataolehurut = [];
                foreach ($datahasil as $jenis) {
                    $jenis_kontrak = new JenisKontrak;
                    $jenis_kontrak->id_kontrak = $id;
                    $jenis_kontrak->nama_jenis = $jenis['nama_jenis'];
                    $jenis_kontrak->save();
                    if ($jenis['data'] != null) {
                        foreach ($jenis['data'] as $data) {
                            $bar_jas = new BarJas;
                            $bar_jas->id_jenis_kontrak = $jenis_kontrak->id;
                            $bar_jas->uraian = $data['nama'];
                            $bar_jas->volume = $data['vol'];
                            $bar_jas->satuan = $data['sat'];
                            // $bar_jas->harga_satuan = 5000;
                            // $bar_jas->jumlah = $data['vol'] * 5000;
                            $bar_jas->save();
                            if ($data['sub_data'] != null) {
                                foreach ($data['sub_data'] as $subdata) {
                                    $sub_barjas = new SubBarjas;
                                    $sub_barjas->id_barjas = $bar_jas->id;
                                    $sub_barjas->uraian = $subdata['nama'];
                                    $sub_barjas->volume = $subdata['vol'];
                                    $sub_barjas->satuan = $subdata['sat'];
                                    // $sub_barjas->harga_satuan = 5000;
                                    // $sub_barjas->jumlah = $subdata['vol'] * 5000;
                                    $sub_barjas->save();
                                }
                            }
                        }
                    }
                }


                if (file_exists(storage_path('app/' . $path))) {
                    // dd(file_exists(storage_path('app/' . $path)));
                    // File ada di penyimpanan
                    unlink(storage_path('app/' . $path));
                    // echo 'File ditemukan.';
                }
                // else {
                //     // File tidak ada di penyimpanan
                //     // echo 'File tidak ditemukan.';
                // }

                return redirect()->route('pengajuankontrak.index');

                // $writter = IOFactory::createWriter($spreadsheet, 'Xlsx');
                // $writter->save(storage_path('app/public/template/mantap.xlsx'));








                // // Redirect ke halaman success
                // return redirect()->route('success_upload');
            } else {
                // Jika tipe file tidak diizinkan, kirim pesan error
                return back()->with('error', 'Tipe file tidak diizinkan. Hanya file Xlsx yang diizinkan.');
            }
        } else {
            // Jika file tidak ada, kirim pesan error
            return back()->with('error', 'File belum di-upload.');
        }
    }
    public function store(Request $request)
    {

        // $data = $request->validate([
        //     'nama_kontrak' => 'required|string|max:255',
        //     // 'id_vendor' => 'required|exists:vendors,id',
        //     'tanggal_pekerjaan' => 'required|date',
        //     'tanggal_akhir_pekerjaan' => 'required|date',
        //     // 'filemaster' => 'nullable|string|max:255',
        // ]);

        // Generate Random Filename
        $newFileName = 'dokumen_' . uniqid() . '.xlsx';




        // Validasi pengisian ke excel
        $rules = [
            'nama_kontrak' => 'required|max:255',
            'no_urut' => 'required|numeric',
            'tahun' => 'required|date_format:Y',
            'lokasi_pekerjaan' => 'required|max:255',
            'lama_pekerjaan' => 'required|max:255',
            'kode_masalah' => 'required|max:255',
            'tanggal_spmk' => 'required|date',
            'nomor_spmk' => 'required|max:255',
            'skk-ao' => 'required|max:255',
            'tanggal_anggaran' => 'required|date',
            'penyedia' => 'required',
            'direktur' => 'required',
            'alamat_penyedia' => 'required',
            'nama_bank' => 'required',
            'nomor_rekening' => 'required',
            'manager' => 'required',



        ];



        $validator = Validator::make($request->all(), $rules);




        // Pengisian Excel 
        // Fungsi terbilang


        // Manipulasi phpspreadsheet
        $spreadsheet = IOFactory::load(storage_path('app/public/templateformat/template.xlsx'));
        // Get the active worksheet
        $worksheet = $spreadsheet->setActiveSheetIndexByName('MASTER');



        // $C6Val = $worksheet->getCell('C6')->getCalculatedValue();
        // $worksheet->setCellValue('D6', '=PROPER("' . $this->terbilang($C6Val) . '") & " Hari Kalender"');



        // Mengisi bagian kontrak

        $worksheet->setCellValue('C6', $request->input('lama_pekerjaan'));
        $worksheet->setCellValue('C12', strtoupper($request->input('nama_kontrak')));
        $worksheet->setCellValue('K5', $request->input('no_urut'));
        $worksheet->setCellValue('K6', $request->input('tahun'));
        $worksheet->setCellValue('K7', $request->input('kode_masalah'));
        $worksheet->setCellValue('C22', $request->input('lokasi_pekerjaan'));

        // SPMK
        $worksheet->setCellValue('C8', $request->input('tanggal_spmk'));
        $worksheet->setCellValue('C9', $request->input('nomor_spmk'));

        // Tanggal Pengerjaan Dokumen
        $worksheet->setCellValue('L10', date("d/m/Y", strtotime($request->input('tanggal_rks'))));
        $worksheet->setCellValue('L11', date("d/m/Y", strtotime($request->input('tanggal_hps'))));
        $worksheet->setCellValue('L12', date("d/m/Y", strtotime($request->input('tanggal_pakta_pejabat'))));
        $worksheet->setCellValue('L13', date("d/m/Y", strtotime($request->input('tanggal_undangan'))));
        $worksheet->setCellValue('L14', date("d/m/Y", strtotime($request->input('tanggal_pakta_pengguna'))));


        $worksheet->setCellValue('L18', date("d/m/Y", strtotime($request->input('tanggal_ba_buka'))));
        $worksheet->setCellValue('L19', date("d/m/Y", strtotime($request->input('tanggal_ba_evaluasi'))));
        $worksheet->setCellValue('L20', date("d/m/Y", strtotime($request->input('tanggal_ba_negosiasi'))));
        $worksheet->setCellValue('L21', date("d/m/Y", strtotime($request->input('tanggal_ba_hasil_pl'))));
        $worksheet->setCellValue('L22', date("d/m/Y", strtotime($request->input('tanggal_spk'))));


        // Anggaran
        $worksheet->setCellValue('C26', $request->input('skk-ao'));
        $worksheet->setCellValue('C27', $request->input('tanggal_anggaran'));

        // Vendor
        $worksheet->setCellValue('F29', $request->input('penyedia'));
        $worksheet->setCellValue('F30', $request->input('direktur'));
        $worksheet->setCellValue('F31', $request->input('alamat_jalan'));
        $worksheet->setCellValue('F32', $request->input('alamat_kota') . ',' . $request->input('alamat_provinsi'));
        $worksheet->setCellValue('F34', $request->input('nama_bank'));
        $worksheet->setCellValue('F35', $request->input('nomor_rekening'));


        // Penyelenggara
        $worksheet->setCellValue('F37', $request->input('manager'));
        $worksheet->setCellValue('F38', $request->input('pejabat_pelaksana_pengadaan'));
        $worksheet->setCellValue('F40', $request->input('direksi'));
        $worksheet->setCellValue('F41', $request->input('pengawas_pekerjaan'));
        $worksheet->setCellValue('F42', $request->input('pengawas_k3'));
        $worksheet->setCellValue('F43', $request->input('pengawas_lapangan'));

        // Simpan ke database 
        $kontrakkerja = new KontrakKerja();
        $kontrakkerja->nama_kontrak = $worksheet->getCell('C12')->getCalculatedValue();
        $kontrakkerja->tanggal_pekerjaan = date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('C10')->getCalculatedValue())));

        $kontrakkerja->tanggal_akhir_pekerjaan = date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('C10')->getCalculatedValue()) . ' + ' . $this->dateConverter($worksheet->getCell('C6')->getCalculatedValue()) . ' days '));
        $kontrakkerja->id_vendor = $request->input('ven');
        $kontrakkerja->lokasi_pekerjaan = $worksheet->getCell('C22')->getValue();
        $kontrakkerja->no_urut = $worksheet->getCell('K5')->getValue();
        $kontrakkerja->tahun = $worksheet->getCell('K6')->getValue();
        $kontrakkerja->kode_masalah = $worksheet->getCell('K7')->getValue();
        $kontrakkerja->filemaster = $newFileName;
        $kontrakkerja->status = "Dokumen Input Pengadaan Tahap 1";
        $kontrakkerja->save();
        $id = $kontrakkerja->id_kontrakkerja;

        // SumberAnggaran
        $anggaran = new SumberAnggaran();
        $anggaran->id_kontrakkerja = $id;
        $anggaran->skk_ao = $request->input('skk-ao');
        $anggaran->tanggal_anggaran = $request->input('tanggal_anggaran');
        $anggaran->save();


        //Penyelenggara
        $penyelenggaraArr =  [
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'manager',
                'nama_pengguna' => $worksheet->getCell('F37')->getValue()
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pejabat_pelaksana_pengadaan',
                'nama_pengguna' => $worksheet->getCell('F38')->getValue()
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'direksi',
                'nama_pengguna' => $worksheet->getCell('F40')->getValue()
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_pekerjaan',
                'nama_pengguna' => $worksheet->getCell('F41')->getValue()
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_k3',
                'nama_pengguna' => $worksheet->getCell('F42')->getValue()
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_lapangan',
                'nama_pengguna' => $worksheet->getCell('F43')->getValue()
            ],




        ];
        foreach ($penyelenggaraArr as $key) {
            Penyelenggara::create($key);
        }


        //PembuatansuratKontrak
        $pembuatansuratkontrak =  [
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_rks',
                'no_surat' => $request->input('nomor_rks'),
                'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L10')->getValue())))
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_hps',
                'no_surat' => $request->input('nomor_hps'),
                'tanggal_pembuatan' => date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L11')->getValue())))
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_pakta_pejabat',
                'no_surat' => $request->input('nomor_pakta_pejabat'),
                'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L12')->getValue())))
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_undangan',
                'no_surat' => $request->input('nomor_undangan'),
                'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L13')->getValue())))
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_pakta_pengguna',
                'no_surat' => $request->input('nomor_pakta_pengguna'),
                'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L14')->getValue())))
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_buka',
                'no_surat' => $request->input('nomor_ba_buka'),
                'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L18')->getValue())))
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_evaluasi',
                'no_surat' => $request->input('nomor_ba_evaluasi'),
                'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L19')->getValue())))
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_negosiasi',
                'no_surat' => $request->input('nomor_ba_negosiasi'),
                'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L20')->getValue())))
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_hasil_pl',
                'no_surat' => $request->input('nomor_ba_hasil_pl'),
                'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L21')->getValue())))
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_spk',
                'no_surat' => $request->input('nomor_spk'),
                'tanggal_pembuatan' =>  date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('L22')->getValue())))
            ],





        ];
        foreach ($pembuatansuratkontrak as $key) {
            PembuatanSuratKontrak::create($key);
        }


        // Save the updated spreadsheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(storage_path('app/public/dokumenpenawaran/' . $newFileName));

        // Mengatur Jenis Data

        $datajenis = [];
        if ($kontrakkerja->kode_masalah == 'DAN.01.01') {
            $datajenis = [
                [
                    'id_kontrak' => $id,
                    'nama_jenis' => 'Pengadaan Barang'
                ]

            ];
        }
        if ($kontrakkerja->kode_masalah == 'DAN.01.02') {
            $datajenis = [
                [
                    'id_kontrak' => $id,
                    'nama_jenis' => 'Pengadaan Jasa'
                ]


            ];
        }
        if ($kontrakkerja->kode_masalah == 'DAN.01.03') {
            $datajenis[0] = [
                'id_kontrak' => $id,
                'nama_jenis' => 'Pengadaan Barang'

            ];
            $datajenis[1] = [
                'id_kontrak' => $id,
                'nama_jenis' => 'Pengadaan Jasa'

            ];
        }
        foreach ($datajenis as $jenis) {
            JenisKontrak::create($jenis);
        }









        return redirect()->route('pengajuankontrak.index')
            ->with('success', 'Data kontrak kerja berhasil disimpan.');
    }

    public function edit($id)
    {
        $kontrakkerja = KontrakKerja::find($id);
        $sumberanggaran = SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->get();
        $penyelenggaraData = Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->get()->toArray();

        // dd($penyelenggaraData);
        $penyelenggara = array();
        foreach ($penyelenggaraData as $key => $value) {
            $penyelenggara[$value['nama_jabatan']] = [
                'nama_pengguna' => $value['nama_pengguna']

            ];
        }
        $penyelenggara = json_decode(json_encode($penyelenggara));

        $pembuatansuratData = PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->get()->toArray();
        $pembuatansurat = array();
        foreach ($pembuatansuratData as $key) {
            $pembuatansurat[$key['nama_surat']] = [
                'tanggal_surat' => $key['tanggal_pembuatan']

            ];
        }
        $pembuatansurat = json_decode(json_encode($pembuatansurat));


        // Path File
        $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();

        // Edit Detail Kontrak
        $kontrak = [
            'id_kontrakkerja' => $kontrakkerja->id_kontrakkerja,
            'nama_kontrak' => $worksheet->getCell('C12')->getCalculatedValue(),
            'no_urut' => $worksheet->getCell('K5')->getCalculatedValue(),
            'tahun' => $worksheet->getCell('K6')->getCalculatedValue(),
            'lama_pekerjaan' => $worksheet->getCell('C6')->getCalculatedValue(),
            'kode_masalah' => $worksheet->getCell('K7')->getCalculatedValue(),
            'lokasi_pekerjaan' => $worksheet->getCell('C22')->getCalculatedValue(),
            'tanggal_spmk' => $worksheet->getCell('C8')->getCalculatedValue(),
            'nomor_spmk' => $worksheet->getCell('C9')->getCalculatedValue(),

            'skk-ao' => $worksheet->getCell('C26')->getCalculatedValue(),
            'tanggal_anggaran' => $worksheet->getCell('C27')->getCalculatedValue(),

            'penyedia' => $worksheet->getCell('F29')->getCalculatedValue(),
            'direktur' => $worksheet->getCell('F30')->getCalculatedValue(),
            'alamat_penyedia' => $worksheet->getCell('F31')->getCalculatedValue(),
            'nama_bank' => $worksheet->getCell('F34')->getCalculatedValue(),
            'nomor_rekening' => $worksheet->getCell('F35')->getCalculatedValue(),

            'manager' => $worksheet->getCell('F37')->getCalculatedValue(),
            'pengawas_lapangan' => $worksheet->getCell('F43')->getCalculatedValue(),
            'pejabat_pelaksana_pengadaan' => $worksheet->getCell('F38')->getCalculatedValue(),
            'pengawas_k3' => $worksheet->getCell('F42')->getCalculatedValue(),
            'direksi' => $worksheet->getCell('F40')->getCalculatedValue(),
            'pengawas_pekerjaan' => $worksheet->getCell('F41')->getCalculatedValue(),

            'rks' => $this->dateConverter($worksheet->getCell('L10')->getCalculatedValue()),
            'hps' => $this->dateConverter($worksheet->getCell('L11')->getCalculatedValue()),
            'pakta_pejabat' => $this->dateConverter($worksheet->getCell('L12')->getCalculatedValue()),
            'undangan' => $this->dateConverter($worksheet->getCell('L13')->getCalculatedValue()),
            'pakta_pengguna' => $this->dateConverter($worksheet->getCell('L14')->getCalculatedValue()),

            'ba_buka' => $this->dateConverter($worksheet->getCell('L18')->getCalculatedValue()),
            'ba_evaluasi' => $this->dateConverter($worksheet->getCell('L19')->getCalculatedValue()),
            'ba_negosiasi' => $this->dateConverter($worksheet->getCell('L20')->getCalculatedValue()),
            'ba_hasil_pl' => $this->dateConverter($worksheet->getCell('L21')->getCalculatedValue()),
            'spk' => $this->dateConverter($worksheet->getCell('L22')->getCalculatedValue())


        ];

        $vendor = Vendor::all();


        return view('plnpengadaan.kontraktahap1.edit', compact('kontrak', 'kontrakkerja', 'vendor', 'penyelenggara', 'pembuatansurat', 'sumberanggaran'));
    }

    public function update(Request $request, $id)
    {





        // Validasi pengisian ke excel
        $rules = [
            'nama_kontrak' => 'required|max:255',
            'no_urut' => 'required|numeric',
            'tahun' => 'required|date_format:Y',
            'lokasi_pekerjaan' => 'required|max:255',
            'lama_pekerjaan' => 'required|max:255',
            'kode_masalah' => 'required|max:255',
            'tanggal_spmk' => 'required|date',
            'nomor_spmk' => 'required|max:255',
            'skk-ao' => 'required|max:255',
            'tanggal_anggaran' => 'required|date',
            'penyedia' => 'required',
            'direktur' => 'required',
            'alamat_penyedia' => 'required',
            'nama_bank' => 'required',
            'nomor_rekening' => 'required',
            'manager' => 'required',



        ];



        $validator = Validator::make($request->all(), $rules);




        // Mengambil data dari database
        $kontrakkerja = KontrakKerja::find($id);

        // Lokasi File Path
        $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);
        // Manipulasi phpspreadsheet
        $spreadsheet = IOFactory::load($path);
        // Get the active worksheet
        $worksheet = $spreadsheet->setActiveSheetIndexByName('MASTER');


        // $C6Val = $worksheet->getCell('C6')->getCalculatedValue();
        // $worksheet->setCellValue('D6', '=PROPER("' . $this->terbilang($C6Val) . '") & " Hari Kalender"');



        // Mengisi bagian kontrak

        $worksheet->setCellValue('C6', $request->input('lama_pekerjaan'));
        $worksheet->setCellValue('C12', strtoupper($request->input('nama_kontrak')));
        $worksheet->setCellValue('K5', $request->input('no_urut'));
        $worksheet->setCellValue('K6', $request->input('tahun'));
        $worksheet->setCellValue('K7', $request->input('kode_masalah'));
        $worksheet->setCellValue('C22', $request->input('lokasi_pekerjaan'));

        // SPMK
        $worksheet->setCellValue('C8', $request->input('tanggal_spmk'));
        $worksheet->setCellValue('C9', $request->input('nomor_spmk'));

        // Tanggal Pengerjaan Dokumen
        $worksheet->setCellValue('L10', date("d/m/Y", strtotime($request->input('tanggal_rks'))));
        $worksheet->setCellValue('L11', date("d/m/Y", strtotime($request->input('tanggal_hps'))));
        $worksheet->setCellValue('L12', date("d/m/Y", strtotime($request->input('tanggal_pakta_pejabat'))));
        $worksheet->setCellValue('L13', date("d/m/Y", strtotime($request->input('tanggal_undangan'))));
        $worksheet->setCellValue('L14', date("d/m/Y", strtotime($request->input('tanggal_pakta_pengguna'))));


        $worksheet->setCellValue('L18', date("d/m/Y", strtotime($request->input('tanggal_ba_buka'))));
        $worksheet->setCellValue('L19', date("d/m/Y", strtotime($request->input('tanggal_ba_evaluasi'))));
        $worksheet->setCellValue('L20', date("d/m/Y", strtotime($request->input('tanggal_ba_negosiasi'))));
        $worksheet->setCellValue('L21', date("d/m/Y", strtotime($request->input('tanggal_ba_hasil_pl'))));
        $worksheet->setCellValue('L22', date("d/m/Y", strtotime($request->input('tanggal_spk'))));



        // Anggaran
        $worksheet->setCellValue('C26', $request->input('skk-ao'));
        $worksheet->setCellValue('C27', $request->input('tanggal_anggaran'));

        // Vendor
        $worksheet->setCellValue('F29', $request->input('penyedia'));
        $worksheet->setCellValue('F30', $request->input('direktur'));
        $worksheet->setCellValue('F31', $request->input('alamat_penyedia'));
        $worksheet->setCellValue('F34', $request->input('nama_bank'));
        $worksheet->setCellValue('F35', $request->input('nomor_rekening'));


        // Penyelenggara
        $worksheet->setCellValue('F37', $request->input('manager'));
        $worksheet->setCellValue('F38', $request->input('pejabat_pelaksana_pengadaan'));
        $worksheet->setCellValue('F40', $request->input('direksi'));
        $worksheet->setCellValue('F41', $request->input('pengawas_pekerjaan'));
        $worksheet->setCellValue('F42', $request->input('pengawas_k3'));
        $worksheet->setCellValue('F43', $request->input('pengawas_lapangan'));















        // Simpan ke database 
        $kontrakkerja->nama_kontrak = $worksheet->getCell('C12')->getCalculatedValue();
        $kontrakkerja->tanggal_pekerjaan = date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('C10')->getCalculatedValue())));

        $kontrakkerja->tanggal_akhir_pekerjaan = date('Y-m-d', strtotime($this->dateConverter($worksheet->getCell('C10')->getCalculatedValue()) . ' + ' . $this->dateConverter($worksheet->getCell('C6')->getCalculatedValue()) . ' days '));
        $kontrakkerja->id_vendor = $request->input('ven');
        $kontrakkerja->lokasi_pekerjaan = $worksheet->getCell('C22')->getValue();
        $kontrakkerja->no_urut = $worksheet->getCell('K5')->getValue();
        $kontrakkerja->tahun = $worksheet->getCell('K6')->getValue();
        $kontrakkerja->kode_masalah = $worksheet->getCell('K5')->getValue();
        $kontrakkerja->save();
        $id = $kontrakkerja->id_kontrakkerja;

        // SumberAnggaran
        $anggaran = SumberAnggaran::where('id_kontrakkerja', $id)->first();

        $anggaran1 = SumberAnggaran::find($anggaran->id);

        $anggaran1->skk_ao = $request->input('skk-ao');
        $anggaran1->tanggal_anggaran = $request->input('tanggal_anggaran');
        $anggaran1->save();


        //Penyelenggara
        //Penyelenggara
        $penyelenggaraArr =  [
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'manager',
                'nama_pengguna' => $worksheet->getCell('F37')->getValue()
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pejabat_pelaksana_pengadaan',
                'nama_pengguna' => $worksheet->getCell('F38')->getValue()
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'direksi',
                'nama_pengguna' => $worksheet->getCell('F40')->getValue()
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_pekerjaan',
                'nama_pengguna' => $worksheet->getCell('F41')->getValue()
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_k3',
                'nama_pengguna' => $worksheet->getCell('F42')->getValue()
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_lapangan',
                'nama_pengguna' => $worksheet->getCell('F43')->getValue()
            ],




        ];
        foreach ($penyelenggaraArr as $key) {
            $penyelenggara = Penyelenggara::where('nama_jabatan', $key['nama_jabatan'])->where('id_kontrakkerja', $id)->first();

            $penyelenggara1 = Penyelenggara::find($penyelenggara->id_penyelenggara);
            $penyelenggara1->nama_pengguna = $key['nama_pengguna'];

            $penyelenggara1->save();
        }


        //PembuatansuratKontrak
        $pembuatansuratkontrak =  [
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_rks',
                'no_surat' => $request->input('nomor_rks'),
                'tanggal_pembuatan' => $request->input('tanggal_rks')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_hps',
                'no_surat' => $request->input('nomor_hps'),
                'tanggal_pembuatan' => $request->input('tanggal_hps')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_pakta_pejabat',
                'no_surat' => $request->input('nomor_pakta_pejabat'),
                'tanggal_pembuatan' => $request->input('tanggal_pakta_pejabat')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_pakta_pengguna',
                'no_surat' => $request->input('nomor_pakta_pengguna'),
                'tanggal_pembuatan' => $request->input('tanggal_pakta_pengguna')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_undangan',
                'no_surat' => $request->input('nomor_undangan'),
                'tanggal_pembuatan' => $request->input('tanggal_undangan')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_buka',
                'no_surat' => $request->input('nomor_ba_buka'),
                'tanggal_pembuatan' => $request->input('tanggal_ba_buka')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_evaluasi',
                'no_surat' => $request->input('nomor_ba_evaluasi'),
                'tanggal_pembuatan' => $request->input('tanggal_ba_evaluasi')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_negosiasi',
                'no_surat' => $request->input('nomor_ba_negosiasi'),
                'tanggal_pembuatan' => $request->input('tanggal_ba_negosiasi')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_hasil_pl',
                'no_surat' => $request->input('nomor_ba_hasil_pl'),
                'tanggal_pembuatan' => $request->input('tanggal_ba_hasil_pl')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_spk',
                'no_surat' => $request->input('nomor_spk'),
                'tanggal_pembuatan' => $request->input('tanggal_spk')
            ],





        ];
        foreach ($pembuatansuratkontrak as $key) {
            $pembuatansurat = PembuatanSuratKontrak::where('nama_surat', $key['nama_surat'])->where('id_kontrakkerja', $id)->first();
            $pembuatansurat1 = PembuatanSuratKontrak::find($pembuatansurat->id);
            $pembuatansurat1->no_surat = $key['no_surat'];
            $pembuatansurat1->tanggal_pembuatan = $key['tanggal_pembuatan'];
            $pembuatansurat1->save($key);
        }

        // Save the updated spreadsheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($path);

        return redirect()->route('pengajuankontrak.index')
            ->with('success', 'Data kontrak kerja berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kontrakkerja = KontrakKerja::find($id);
        // Meload Path lokasi file disimpan

        $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        // Menghapus dokumen dari database 
        $kontrakkerja->pembuatansuratkontrak()->delete();
        $kontrakkerja->penyelenggara()->delete();
        $kontrakkerja->sumberanggaran()->delete();
        $kontrakkerja->tandatangan()->delete();


        $kontrakkerja->delete();

        // Menghapus File jika berhasil redirect
        if (unlink($path)) {
            return redirect()->route('pengajuankontrak.index')
                ->with('success', 'Data kontrak kerja berhasil dihapus.');
        } else {
            echo "Gagal Menghapus file";
        }
    }
    // Halaman Detail
    public function detailkontrak($id)
    {

        $kontrakkerja = KontrakKerja::find($id);

        // Path File
        $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        // dd();
        // Edit Detail Kontrak

        $kontrak1 = [
            'nama_kontrak' => $worksheet->getCell('C12')->getValue(),
            'lama_pekerjaan' => $worksheet->getCell('C6')->getValue(),
            'no_urut' => $worksheet->getCell('K5')->getValue(),
            'tahun' => $worksheet->getCell('K6')->getValue(),
            'kode_masalah' => $worksheet->getCell('K7')->getValue(),
            'lokasi_pekerjaan' => $worksheet->getCell('C22')->getValue(),

            // SPMK
            'tanggal_spmk' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('C8')->getValue()))),
            'nomor_spmk' => $worksheet->getCell('C9')->getValue(),

            // Tanggal Pengerjaan Dokumen
            'tanggal_rks' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L10')->getCalculatedValue()))),
            'tanggal_hps' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L11')->getCalculatedValue()))),
            'tanggal_pakta_pejabat' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L12')->getCalculatedValue()))),
            'tanggal_undangan' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L13')->getCalculatedValue()))),
            'tanggal_pakta_pengguna' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L14')->getCalculatedValue()))),

            'tanggal_ba_buka' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L18')->getValue()))),
            'tanggal_ba_evaluasi' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L19')->getValue()))),
            'tanggal_ba_negosiasi' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L20')->getValue()))),
            'tanggal_ba_hasil_pl' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L21')->getValue()))),
            'tanggal_spk' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L22')->getValue()))),

            // Anggaran
            'skk_ao' => $worksheet->getCell('C26')->getValue(),
            'tanggal_anggaran' =>  date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('C27')->getValue()))),

            // Vendor
            'penyedia' => $worksheet->getCell('F29')->getValue(),
            'direktur' => $worksheet->getCell('F30')->getValue(),
            'alamat_jalan' => $worksheet->getCell('F31')->getValue(),
            'alamat_kota' => $worksheet->getCell('F32')->getValue(),
            'nama_bank' => $worksheet->getCell('F34')->getValue(),
            'nomor_rekening' => $worksheet->getCell('F35')->getValue(),

            // Penyelenggara
            'manager' => $worksheet->getCell('F37')->getValue(),
            'pejabat_pelaksana_pengadaan' => $worksheet->getCell('F38')->getValue(),
            'direksi' => $worksheet->getCell('F40')->getValue(),
            'pengawas_pekerjaan' => $worksheet->getCell('F41')->getValue(),
            'pengawas_k3' => $worksheet->getCell('F42')->getValue(),
            'pengawas_lapangan' => $worksheet->getCell('F43')->getValue()
        ];
        $kontrak = json_decode(json_encode($kontrak1));

        $jenis_kontrak = JenisKontrak::where('id_kontrak', $id)->get();

        return  view('plnpengadaan.kontraktahap1.detail', compact('kontrakkerja', 'kontrak', 'jenis_kontrak', 'id'));
    }
    // DownloadDokumenVendor
    public function DownloadVendorDoc($id)
    {

        // // Create a new zip archive
        // $zipname = 'namaFileZip.zip';
        // $zip = new \ZipArchive;

        // if ($zip->open($zipname, \ZipArchive::CREATE) === TRUE) {

        //     $fileContent = BOQController::detail($id, 'D');
        //     $zip->addFromString('gugu', $fileContent);
        //     $zip->close();

        //     return response()->download(public_path($zipname));
        // } else {
        //     dd('Gagal membuka arsip.');
        // }
    }






    // Nego Harga
    public function negoharga()
    {
        $status = [
            'Dokumen Input Pengadaan Tahap 2'
        ];
        $kontrak = KontrakKerja::with('vendor')->whereIn('status', $status)->get();
        return view('plnpengadaan.kontraktahap2.negoharga', compact('kontrak'));
    }
    // Halaman Detail
    public function detailnego($id)
    {

        $kontrakkerja = KontrakKerja::find($id);

        // Path File
        $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->setActiveSheetIndexByName('MASTER');
        // Edit Detail Kontrak
        $kontrak1 = [
            'nama_kontrak' => $worksheet->getCell('C12')->getValue(),
            'lama_pekerjaan' => $worksheet->getCell('C6')->getValue(),
            'no_urut' => $worksheet->getCell('K5')->getValue(),
            'tahun' => $worksheet->getCell('K6')->getValue(),
            'kode_masalah' => $worksheet->getCell('K7')->getValue(),
            'lokasi_pekerjaan' => $worksheet->getCell('C22')->getValue(),

            // SPMK
            'tanggal_spmk' => $worksheet->getCell('C8')->getValue(),
            'nomor_spmk' => $worksheet->getCell('C9')->getValue(),

            // Tanggal Pengerjaan Dokumen
            'tanggal_rks' => date("Y-m-d", strtotime($worksheet->getCell('L10')->getValue())),
            'tanggal_hps' => date("Y-m-d", strtotime($worksheet->getCell('L11')->getValue())),
            'tanggal_pakta_pejabat' => date("Y-m-d", strtotime($worksheet->getCell('L12')->getValue())),
            'tanggal_undangan' => date("Y-m-d", strtotime($worksheet->getCell('L13')->getValue())),
            'tanggal_pakta_pengguna' => date("Y-m-d", strtotime($worksheet->getCell('L14')->getValue())),

            'tanggal_ba_buka' => date("Y-m-d", strtotime($worksheet->getCell('L18')->getValue())),
            'tanggal_ba_evaluasi' => date("Y-m-d", strtotime($worksheet->getCell('L19')->getValue())),
            'tanggal_ba_negosiasi' => date("Y-m-d", strtotime($worksheet->getCell('L20')->getValue())),
            'tanggal_ba_hasil_pl' => date("Y-m-d", strtotime($worksheet->getCell('L21')->getValue())),
            'tanggal_spk' => date("Y-m-d", strtotime($worksheet->getCell('L22')->getValue())),

            // Anggaran
            'skk_ao' => $worksheet->getCell('C26')->getValue(),
            'tanggal_anggaran' => $worksheet->getCell('C27')->getValue(),

            // Vendor
            'penyedia' => $worksheet->getCell('F29')->getValue(),
            'direktur' => $worksheet->getCell('F30')->getValue(),
            'alamat_jalan' => $worksheet->getCell('F31')->getValue(),
            'alamat_kota' => $worksheet->getCell('F32')->getValue(),
            'nama_bank' => $worksheet->getCell('F34')->getValue(),
            'nomor_rekening' => $worksheet->getCell('F35')->getValue(),

            // Penyelenggara
            'manager' => $worksheet->getCell('F37')->getValue(),
            'pejabat_pelaksana_pengadaan' => $worksheet->getCell('F38')->getValue(),
            'direksi' => $worksheet->getCell('F40')->getValue(),
            'pengawas_pekerjaan' => $worksheet->getCell('F41')->getValue(),
            'pengawas_k3' => $worksheet->getCell('F42')->getValue(),
            'pengawas_lapangan' => $worksheet->getCell('F43')->getValue()
        ];
        $kontrak = json_decode(json_encode($kontrak1));
        // Tutup instance setelah digunakan
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
        return  view('plnpengadaan.kontraktahap2.detail', compact('kontrakkerja', 'kontrak'));
    }




    public function tandatanganpengadaan()
    {
        $status = [
            'Validasi Dokumen Pengadaan Tahap 1',
        ];
        $kontrak = KontrakKerja::with('vendor')->whereIn('status', $status)->get();
        return view('plnpengadaan.tandatanganpengadaan.tandatangan', compact('kontrak'));
    }
    public function simpanttd(Request $request)
    {
        $file = $request->file('file');
        $id = $request->input('id');
        $status = $request->input('status');

        $kontrak = KontrakKerja::find($id);
        $kontrak->status = $status;
        $kontrak->save();
        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->move(storage_path('app/public/tandatangan'), $fileName);

        $path = storage_path('app/public/dokumenpenawaran/' . $kontrak->filemaster);
        $tandatangan = TandaTangan::where('id_kontrakkerja', $id)->get();

        if (!count($tandatangan) > 0) {
            $data = [
                'id_kontrakkerja' => $id,
                'tandatangan_pengadaan' => $fileName,
                'tanggal_tandatangan_pengadaan' => Carbon::now(),

            ];
            $ttd = TandaTangan::create($data);
        } else {
            $ttd = TandaTangan::find($tandatangan->id);
            $ttd->id_kontrakkerja = $id;
            $ttd->tandatangan_pengadaan = $fileName;
            $ttd->tanggal_tandatangan_pengadaan = Carbon::now();
            $ttd->save();
        }

        // $spreadsheet = IOFactory::load($path);
        // $worksheet = $spreadsheet->setActiveSheetIndexByName('UND');
        // $worksheet->setCellValue('B2', 'Test');
        // // Ambil file gambar dari storage
        // $imagePath = storage_path('app/public/tandatangan/'.$fileName);

        // // Membuat nama file
        // $filename = $fileName;

        // // Membuat object lokasi gambar pada sheet
        // $drawing = new Drawing();
        // $drawing->setName($filename);
        // $drawing->setDescription($filename);
        // $drawing->setPath($imagePath);
        // $drawing->setOffsetX(5);
        // $drawing->setOffsetY(5);
        // $drawing->setWidth(120);
        // $drawing->setHeight(120);
        // $drawing->setWorksheet($spreadsheet->getActiveSheet());

        // // Memasukkan object drawing pada sheet pada cell C25
        // $spreadsheet->getActiveSheet()->setCellValue('C25', $drawing->getName());
        // $spreadsheet->getActiveSheet()->getRowDimension(25)->setRowHeight(120);
        // $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(120);

        // Output the spreadsheet file
        // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('app/public/dokumenpenawaran/' . $kontrak->filemaster);
        return response()->json([
            'data' => $request->all()
        ]);
    }
    public function detailttd($id)
    {

        $kontrakkerja = KontrakKerja::find($id);

        // Path File
        $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->setActiveSheetIndexByName('MASTER');
        // Edit Detail Kontrak
        $kontrak1 = [
            'nama_kontrak' => $worksheet->getCell('C12')->getValue(),
            'lama_pekerjaan' => $worksheet->getCell('C6')->getValue(),
            'no_urut' => $worksheet->getCell('K5')->getValue(),
            'tahun' => $worksheet->getCell('K6')->getValue(),
            'kode_masalah' => $worksheet->getCell('K7')->getValue(),
            'lokasi_pekerjaan' => $worksheet->getCell('C22')->getValue(),

            // SPMK
            'tanggal_spmk' => $worksheet->getCell('C8')->getValue(),
            'nomor_spmk' => $worksheet->getCell('C9')->getValue(),

            // Tanggal Pengerjaan Dokumen
            'tanggal_rks' => date("Y-m-d", strtotime($worksheet->getCell('L10')->getValue())),
            'tanggal_hps' => date("Y-m-d", strtotime($worksheet->getCell('L11')->getValue())),
            'tanggal_pakta_pejabat' => date("Y-m-d", strtotime($worksheet->getCell('L12')->getValue())),
            'tanggal_undangan' => date("Y-m-d", strtotime($worksheet->getCell('L13')->getValue())),
            'tanggal_pakta_pengguna' => date("Y-m-d", strtotime($worksheet->getCell('L14')->getValue())),

            'tanggal_ba_buka' => date("Y-m-d", strtotime($worksheet->getCell('L18')->getValue())),
            'tanggal_ba_evaluasi' => date("Y-m-d", strtotime($worksheet->getCell('L19')->getValue())),
            'tanggal_ba_negosiasi' => date("Y-m-d", strtotime($worksheet->getCell('L20')->getValue())),
            'tanggal_ba_hasil_pl' => date("Y-m-d", strtotime($worksheet->getCell('L21')->getValue())),
            'tanggal_spk' => date("Y-m-d", strtotime($worksheet->getCell('L22')->getValue())),

            // Anggaran
            'skk_ao' => $worksheet->getCell('C26')->getValue(),
            'tanggal_anggaran' => $worksheet->getCell('C27')->getValue(),

            // Vendor
            'penyedia' => $worksheet->getCell('F29')->getValue(),
            'direktur' => $worksheet->getCell('F30')->getValue(),
            'alamat_jalan' => $worksheet->getCell('F31')->getValue(),
            'alamat_kota' => $worksheet->getCell('F32')->getValue(),
            'nama_bank' => $worksheet->getCell('F34')->getValue(),
            'nomor_rekening' => $worksheet->getCell('F35')->getValue(),

            // Penyelenggara
            'manager' => $worksheet->getCell('F37')->getValue(),
            'pejabat_pelaksana_pengadaan' => $worksheet->getCell('F38')->getValue(),
            'direksi' => $worksheet->getCell('F40')->getValue(),
            'pengawas_pekerjaan' => $worksheet->getCell('F41')->getValue(),
            'pengawas_k3' => $worksheet->getCell('F42')->getValue(),
            'pengawas_lapangan' => $worksheet->getCell('F43')->getValue()
        ];
        $kontrak = json_decode(json_encode($kontrak1));
        // Tutup instance setelah digunakan
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
        return  view('plnpengadaan.tandatanganpengadaan.detail', compact('kontrakkerja', 'kontrak'));
    }

    public function tandatanganmanager()
    {
        $status = [
            'Kontrak disetujui',
            'Tanda Tangan Manager',
            'Kontrak Kerja Berjalan'
        ];
        $kontrak = KontrakKerja::with('vendor')->whereIn('status', $status)->get();


        return view('plnmanager.tandatangan', compact('kontrak'));
    }
    public function detailkontrakmanager($id)
    {
        $kontrakkerja = KontrakKerja::find($id);

        // Path File
        $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->setActiveSheetIndexByName('MASTER');
        // dd();
        // Edit Detail Kontrak

        $kontrak1 = [
            'nama_kontrak' => $worksheet->getCell('C12')->getValue(),
            'lama_pekerjaan' => $worksheet->getCell('C6')->getValue(),
            'no_urut' => $worksheet->getCell('K5')->getValue(),
            'tahun' => $worksheet->getCell('K6')->getValue(),
            'kode_masalah' => $worksheet->getCell('K7')->getValue(),
            'lokasi_pekerjaan' => $worksheet->getCell('C22')->getValue(),

            // SPMK
            'tanggal_spmk' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('C8')->getValue()))),
            'nomor_spmk' => $worksheet->getCell('C9')->getValue(),

            // Tanggal Pengerjaan Dokumen
            'tanggal_rks' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L10')->getCalculatedValue()))),
            'tanggal_hps' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L11')->getCalculatedValue()))),
            'tanggal_pakta_pejabat' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L12')->getCalculatedValue()))),
            'tanggal_undangan' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L13')->getCalculatedValue()))),
            'tanggal_pakta_pengguna' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L14')->getCalculatedValue()))),

            'tanggal_ba_buka' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L18')->getValue()))),
            'tanggal_ba_evaluasi' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L19')->getValue()))),
            'tanggal_ba_negosiasi' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L20')->getValue()))),
            'tanggal_ba_hasil_pl' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L21')->getValue()))),
            'tanggal_spk' => date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('L22')->getValue()))),

            // Anggaran
            'skk_ao' => $worksheet->getCell('C26')->getValue(),
            'tanggal_anggaran' =>  date("Y-m-d", strtotime($this->dateConverter($worksheet->getCell('C27')->getValue()))),

            // Vendor
            'penyedia' => $worksheet->getCell('F29')->getValue(),
            'direktur' => $worksheet->getCell('F30')->getValue(),
            'alamat_jalan' => $worksheet->getCell('F31')->getValue(),
            'alamat_kota' => $worksheet->getCell('F32')->getValue(),
            'nama_bank' => $worksheet->getCell('F34')->getValue(),
            'nomor_rekening' => $worksheet->getCell('F35')->getValue(),

            // Penyelenggara
            'manager' => $worksheet->getCell('F37')->getValue(),
            'pejabat_pelaksana_pengadaan' => $worksheet->getCell('F38')->getValue(),
            'direksi' => $worksheet->getCell('F40')->getValue(),
            'pengawas_pekerjaan' => $worksheet->getCell('F41')->getValue(),
            'pengawas_k3' => $worksheet->getCell('F42')->getValue(),
            'pengawas_lapangan' => $worksheet->getCell('F43')->getValue()
        ];
        $kontrak = json_decode(json_encode($kontrak1));

        $jenis_kontrak = JenisKontrak::where('id_kontrak', $id)->get();
        // dd($kontrak->nama_kontrak);

        unset($spreadsheet);

        return view('plnmanager.detail', compact('kontrakkerja', 'kontrak', 'jenis_kontrak', 'id'));
    }
}
