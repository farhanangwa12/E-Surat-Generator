<?php

namespace App\Http\Controllers;

use App\Http\Controllers\pengadaantahap1\BOQController;
use App\Http\Controllers\pengadaantahap1\HPSController;
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

use App\Models\HPS;
use App\Models\Dokumen\RKS;
use App\Models\Dokumen\UND;
use App\Models\JenisDokumenKelengkapan;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Http\Controllers\pengadaantahap1\UndanganController;
use App\Http\Controllers\pengadaantahap1\RKSController;

class KontrakKerjaController extends Controller
{



    private function dateConverter($date)
    {
        return str_replace("/", "-", $date);
    }

    private function dateConvertertoInd($date)
    {
        // Mengatur lokal bahasa indonesia
        Carbon::setLocale('id');
        $tanggalString = $date;
        $date = Carbon::createFromFormat('Y-m-d', $tanggalString);
        $formattedDate = $date->isoFormat('dddd, D MMMM YYYY');
        return $formattedDate;
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


                // Menyimpan ke kontrak
                // $newFileName = 'dokumenmeong_' . uniqid() . '.xlsx';
                // $newFileName = 'dokumen_' . uniqid() . '.xlsx';
                // Simpan ke database 
                $kontrakkerja = new KontrakKerja();
                $kontrakkerja->nama_kontrak = $worksheetMaster->getCell('C12')->getCalculatedValue();
                $kontrakkerja->tanggal_kontrak =  $worksheetMaster->getCell('C7')->getFormattedValue() == '' ? '' : Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('C7')->getCalculatedValue()))->toDateString();
                $kontrakkerja->tanggal_pekerjaan =  $worksheetMaster->getCell('C10')->getFormattedValue() == '' ? '' :  Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('C10')->getCalculatedValue()))->toDateString();


                $kontrakkerja->tanggal_akhir_pekerjaan =  $worksheetMaster->getCell('C11')->getFormattedValue() == '' ? '' : Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('C11')->getCalculatedValue()))->toDateString();

                $vendor = Vendor::where('penyedia', $worksheetMaster->getCell('F29')->getFormattedValue())->first();

                if (!$vendor) {

                    $vendor1 = new Vendor();
                    $vendor1->penyedia = $worksheetMaster->getCell('F29')->getFormattedValue();
                    $vendor1->direktur = $worksheetMaster->getCell('F30')->getFormattedValue();


                    $vendor1->alamat_jalan = $worksheetMaster->getCell('F31')->getFormattedValue();

                    $vendor1->alamat_kota = explode(', ', $worksheetMaster->getCell('F32')->getFormattedValue())[0];
                    $vendor1->alamat_provinsi =  explode(', ', $worksheetMaster->getCell('F32')->getFormattedValue())[1];
                    $vendor1->direktur = $worksheetMaster->getCell('F30')->getFormattedValue();
                    $vendor1->bank =  $worksheetMaster->getCell('F34')->getFormattedValue();
                    $vendor1->nomor_rek =  $worksheetMaster->getCell('F35')->getFormattedValue();
                    $vendor1->save();
                } else {
                    $vendor1 = Vendor::find($vendor->id_vendor);
                    $vendor1->penyedia = $worksheetMaster->getCell('F29')->getFormattedValue();
                    $vendor1->direktur = $worksheetMaster->getCell('F30')->getFormattedValue();


                    $vendor1->alamat_jalan = $worksheetMaster->getCell('F31')->getFormattedValue();

                    $vendor1->alamat_kota = explode(', ', $worksheetMaster->getCell('F32')->getFormattedValue())[0];
                    $vendor1->alamat_provinsi =  explode(', ', $worksheetMaster->getCell('F32')->getFormattedValue())[1];
                    $vendor1->direktur = $worksheetMaster->getCell('F30')->getFormattedValue();
                    $vendor1->bank =  $worksheetMaster->getCell('F34')->getFormattedValue();
                    $vendor1->nomor_rek =  $worksheetMaster->getCell('F35')->getFormattedValue();
                    $vendor1->save();
                }


                $kontrakkerja->id_vendor = $vendor1->id_vendor;

                $kontrakkerja->lokasi_pekerjaan = $worksheetMaster->getCell('C22')->getValue();

                $kontrakkerja->tanggal_spmk  = $worksheetMaster->getCell('C8')->getFormattedValue() == '' ? null : Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('C8')->getCalculatedValue()))->toDateString();

                $kontrakkerja->no_spmk = $worksheetMaster->getCell('C9')->getCalculatedValue(); // Nomor SPMK
                $kontrakkerja->status = "Dokumen Input Pengadaan Tahap 1";
                $kontrakkerja->no_urut = $worksheetMaster->getCell('K5')->getCalculatedValue();
                $kontrakkerja->tahun = $worksheetMaster->getCell('K6')->getCalculatedValue();

                $kontrakkerja->kode_masalah = $worksheetMaster->getCell('K7')->getFormattedValue();

                // $kontrakkerja->filemaster = $newFileName;

                $kontrakkerja->save();
                $id = $kontrakkerja->id_kontrakkerja;

                // SumberAnggaran
                $anggaran = new SumberAnggaran();
                $anggaran->id_kontrakkerja = $id;
                $anggaran->skk_ao = $worksheetMaster->getCell('C26')->getCalculatedValue();



                $anggaran->tanggal_anggaran = $worksheetMaster->getCell('C27')->getCalculatedValue() == null ? null : Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('C27')->getCalculatedValue()))->toDateString();



                $anggaran->save();


                //Penyelenggara
                $penyelenggaraArr =  [
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'manager',
                        'nama_pengguna' => $worksheetMaster->getCell('F37')->getCalculatedValue()
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'pejabat_pelaksana_pengadaan',
                        'nama_pengguna' => $worksheetMaster->getCell('F38')->getCalculatedValue()
                    ],

                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'direksi',
                        'nama_pengguna' => $worksheetMaster->getCell('F40')->getCalculatedValue()


                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'pengawas_pekerjaan',
                        'nama_pengguna' => $worksheetMaster->getCell('F41')->getCalculatedValue()
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'pengawas_k3',
                        'nama_pengguna' => $worksheetMaster->getCell('F42')->getCalculatedValue()
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_jabatan' => 'pengawas_lapangan',
                        'nama_pengguna' => $worksheetMaster->getCell('F43')->getCalculatedValue()
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
                        'tanggal_pembuatan' =>  $worksheetMaster->getCell('L10')->getFormattedValue() == '' ? null : Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L10')->getCalculatedValue()))->toDateString(),
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_hps',
                        'no_surat' => $worksheetMaster->getCell('K11')->getCalculatedValue(),
                        'tanggal_pembuatan' => $worksheetMaster->getCell('L11')->getFormattedValue() == '' ? null :
                            Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L11')->getCalculatedValue()))->toDateString()
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_pakta_pejabat',
                        'no_surat' => $worksheetMaster->getCell('K12')->getCalculatedValue(),
                        'tanggal_pembuatan' => $worksheetMaster->getCell('L12')->getFormattedValue() == '' ? null :
                            Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L12')->getCalculatedValue()))->toDateString()
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_pakta_pengguna',
                        'no_surat' => $worksheetMaster->getCell('K14')->getCalculatedValue(),
                        'tanggal_pembuatan' => $worksheetMaster->getCell('L14')->getFormattedValue() == '' ? null : Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L14')->getCalculatedValue()))->toDateString()
                    ],

                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_undangan',
                        'no_surat' => $worksheetMaster->getCell('K13')->getCalculatedValue(),
                        'tanggal_pembuatan' => $worksheetMaster->getCell('L13')->getFormattedValue() == '' ? null :
                            Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L13')->getCalculatedValue()))->toDateString()
                    ],


                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'batas_akhir_dokumen_penawaran',
                        'no_surat' => null,
                        'tanggal_pembuatan' => $worksheetMaster->getCell('L15')->getFormattedValue() == '' ? null :
                            Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L15')->getCalculatedValue()))->toDateString()
                    ],


                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_ba_buka',
                        'no_surat' => $worksheetMaster->getCell('K18')->getCalculatedValue(),
                        'tanggal_pembuatan' =>  $worksheetMaster->getCell('L18')->getFormattedValue() == '' ? null :
                            Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L18')->getCalculatedValue()))->toDateString()
                    ],

                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_ba_evaluasi',
                        'no_surat' => $worksheetMaster->getCell('K19')->getCalculatedValue(),
                        'tanggal_pembuatan' => $worksheetMaster->getCell('L19')->getFormattedValue() == '' ? null :
                            Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L19')->getCalculatedValue()))->toDateString()

                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_ba_negosiasi',
                        'no_surat' => $worksheetMaster->getCell('K20')->getCalculatedValue(),
                        'tanggal_pembuatan' => $worksheetMaster->getCell('L20')->getFormattedValue() == '' ? null : Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L20')->getCalculatedValue()))->toDateString()
                    ],
                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_ba_hasil_pl',
                        'no_surat' => $worksheetMaster->getCell('K21')->getCalculatedValue(),
                        'tanggal_pembuatan' => $worksheetMaster->getCell('L21')->getFormattedValue() == '' ? null : Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L21')->getCalculatedValue()))->toDateString()
                    ],

                    [
                        'id_kontrakkerja' => $id,
                        'nama_surat' => 'nomor_spk',
                        'no_surat' => $worksheetMaster->getCell('K22')->getCalculatedValue(),
                        'tanggal_pembuatan' => $worksheetMaster->getCell('L22')->getFormattedValue() == '' ? null : Carbon::createFromDate(Date::excelToDateTimeObject($worksheetMaster->getCell('L22')->getCalculatedValue()))->toDateString()
                    ],





                ];
                foreach ($pembuatansuratkontrak as $key) {
                    PembuatanSuratKontrak::create($key);
                }

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

                return redirect()->route('pengajuankontrak.index')->with('success', 'Data Pengajuan Berhasil Ditambahkan');


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

        // Simpan ke database 
        $kontrakkerja = new KontrakKerja();
        $kontrakkerja->nama_kontrak = strtoupper($request->input('nama_kontrak'));

        $kontrakkerja->id_vendor = $request->input('ven');
        $kontrakkerja->lokasi_pekerjaan = $request->input('lokasi_pekerjaan');
        $kontrakkerja->no_urut = $request->input('no_urut');
        $kontrakkerja->tahun = $request->input('tahun');
        $kontrakkerja->kode_masalah =  $request->input('kode_masalah');
        $kontrakkerja->status = "Dokumen Input Pengadaan Tahap 1";


        $kontrakkerja->tanggal_spmk = $request->input('tanggal_spmk'); // Tanggal SPMK
        $kontrakkerja->no_spmk = $request->input('nomor_spmk'); // Nomor SPMK

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
                'nama_pengguna' => $request->input('manager')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pejabat_pelaksana_pengadaan',
                'nama_pengguna' => $request->input('pejabat_pelaksana_pengadaan')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'direksi',
                'nama_pengguna' => $request->input('direksi')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_pekerjaan',
                'nama_pengguna' =>  $request->input('pengawas_pekerjaan')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_k3',
                'nama_pengguna' => $request->input('pengawas_k3')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_lapangan',
                'nama_pengguna' => $request->input('pengawas_lapangan')
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
                'tanggal_pembuatan' =>  $request->input('tanggal_rks')
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
                'tanggal_pembuatan' =>  $request->input('tanggal_pakta_pejabat')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_pakta_pengguna',
                'no_surat' => $request->input('nomor_pakta_pengguna'),
                'tanggal_pembuatan' =>  $request->input('tanggal_pakta_pengguna')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_undangan',
                'no_surat' => $request->input('nomor_undangan'),
                'tanggal_pembuatan' => $request->input('tanggal_undangan')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'batas_akhir_dokumen_penawaran',
                'no_surat' => null,
                'tanggal_pembuatan' => $request->input('batas_akhir_dokumen_penawaran')
            ],



            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_buka',
                'no_surat' => $request->input('nomor_ba_buka'),
                'tanggal_pembuatan' =>  $request->input('tanggal_ba_buka')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_evaluasi',
                'no_surat' => $request->input('nomor_ba_evaluasi'),
                'tanggal_pembuatan' =>  $request->input('tanggal_ba_evaluasi')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_negosiasi',
                'no_surat' => $request->input('nomor_ba_negosiasi'),
                'tanggal_pembuatan' =>  $request->input('tanggal_ba_negosiasi')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_hasil_pl',
                'no_surat' => $request->input('nomor_ba_hasil_pl'),
                'tanggal_pembuatan' =>  $request->input('tanggal_ba_hasil_pl')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_spk',
                'no_surat' => $request->input('nomor_spk'),
                'tanggal_pembuatan' =>  $request->input('tanggal_spk')
            ],





        ];
        foreach ($pembuatansuratkontrak as $key) {
            PembuatanSuratKontrak::create($key);
        }
        $tanggal_pekerjaan = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'nomor_spk')->first()->tanggal_pembuatan;
        $kontrakkerja = Kontrakkerja::find($id);
        $kontrakkerja->tanggal_kontrak = $tanggal_pekerjaan;
        $kontrakkerja->tanggal_pekerjaan = $kontrakkerja->tanggal_kontrak;

        $kontrakkerja->tanggal_akhir_pekerjaan = date('Y-m-d', strtotime($kontrakkerja->tanggal_pekerjaan . ' + ' .  $request->input('lama_pekerjaan') . ' days '));
        $kontrakkerja->save();


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
        $kontrakkerja = KontrakKerja::with('vendor')->find($id);

        $sumberanggaran = SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first();
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



        // Edit Detail Kontrak
        $kontrak = [
            'id_kontrakkerja' => $kontrakkerja->id_kontrakkerja,
            'nama_kontrak' => $kontrakkerja->nama_kontrak,
            'no_urut' => $kontrakkerja->no_urut,
            'tahun' => $kontrakkerja->tahun,
            'lama_pekerjaan' => Carbon::parse($kontrakkerja->tanggal_pekerjaan)->diffInDays($kontrakkerja->tanggal_akhir_pekerjaan),
            'kode_masalah' => $kontrakkerja->kode_masalah,
            'lokasi_pekerjaan' => $kontrakkerja->lokasi_pekerjaan,
            'tanggal_spmk' => $kontrakkerja->tanggal_spmk,
            'nomor_spmk' => $kontrakkerja->no_spmk,

            'skk-ao' =>  $sumberanggaran->skk_ao,
            'tanggal_anggaran' => $sumberanggaran->tanggal_anggaran,

            'penyedia' => $kontrakkerja->vendor->penyedia,
            'direktur' => $kontrakkerja->vendor->direktur,
            'alamat_penyedia' => $kontrakkerja->alamat,
            'nama_bank' => $kontrakkerja->nama_bank,
            'nomor_rekening' => $kontrakkerja->no_rek,

            'manager' => $penyelenggara->manager->nama_pengguna,
            'pengawas_lapangan' => $penyelenggara->pengawas_lapangan->nama_pengguna,
            'pejabat_pelaksana_pengadaan' => $penyelenggara->pejabat_pelaksana_pengadaan->nama_pengguna,
            'pengawas_k3' => $penyelenggara->pengawas_k3->nama_pengguna,
            'direksi' => $penyelenggara->direksi->nama_pengguna,
            'pengawas_pekerjaan' => $penyelenggara->pengawas_pekerjaan->nama_pengguna,

            // 'rks' => $this->dateConverter($pembuatansurat->nomor_rks->tanggal_pembuatan),
            // 'hps' => $this->dateConverter($pembuatansurat->nomor_hps->tanggal_pembuatan),
            // 'pakta_pejabat' => $this->dateConverter($pembuatansurat->nomor_pakta_pejabat->tanggal_pembuatan),
            // 'undangan' => $this->dateConverter($pembuatansurat->nomor_undangan->tanggal_pembuatan),
            // 'pakta_pengguna' => $this->dateConverter($pembuatansurat->nomor_pakta_pengguna->tanggal_pembuatan),

            // 'ba_buka' => $this->dateConverter($pembuatansurat->nomor_ba_buka->tanggal_pembuatan),
            // 'ba_evaluasi' => $this->dateConverter($worksheet->getCell('L19')->getCalculatedValue()),
            // 'ba_negosiasi' => $this->dateConverter($worksheet->getCell('L20')->getCalculatedValue()),
            // 'ba_hasil_pl' => $this->dateConverter($worksheet->getCell('L21')->getCalculatedValue()),
            // 'spk' => $this->dateConverter($worksheet->getCell('L22')->getCalculatedValue())


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











        $kontrakkerja->nama_kontrak = strtoupper($request->input('nama_kontrak'));

        $kontrakkerja->id_vendor = $request->input('ven');
        $kontrakkerja->lokasi_pekerjaan = $request->input('lokasi_pekerjaan');
        $kontrakkerja->no_urut = $request->input('no_urut');
        $kontrakkerja->tahun = $request->input('tahun');
        $kontrakkerja->kode_masalah =  $request->input('kode_masalah');



        $kontrakkerja->tanggal_spmk = $request->input('tanggal_spmk'); // Tanggal SPMK
        $kontrakkerja->no_spmk = $request->input('nomor_spmk'); // Nomor SPMK

        // dd($kontrakkerja->no_spmk);
        $kontrakkerja->save();
        $id = $kontrakkerja->id_kontrakkerja;


        // SumberAnggaran
        $anggaran = SumberAnggaran::where('id_kontrakkerja', $id)->first();

        $anggaran1 = SumberAnggaran::find($anggaran->id);

        $anggaran1->id_kontrakkerja = $id;
        $anggaran1->skk_ao = $request->input('skk-ao');
        $anggaran1->tanggal_anggaran = $request->input('tanggal_anggaran');
        $anggaran1->save();


        //Penyelenggara
        $penyelenggaraArr =  [
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'manager',
                'nama_pengguna' => $request->input('manager')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pejabat_pelaksana_pengadaan',
                'nama_pengguna' => $request->input('pejabat_pelaksana_pengadaan')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'direksi',
                'nama_pengguna' => $request->input('direksi')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_pekerjaan',
                'nama_pengguna' =>  $request->input('pengawas_pekerjaan')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_k3',
                'nama_pengguna' => $request->input('pengawas_k3')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_jabatan' => 'pengawas_lapangan',
                'nama_pengguna' => $request->input('pengawas_lapangan')
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
                'tanggal_pembuatan' =>  $request->input('tanggal_rks')
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
                'tanggal_pembuatan' =>  $request->input('tanggal_pakta_pejabat')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_pakta_pengguna',
                'no_surat' => $request->input('nomor_pakta_pengguna'),
                'tanggal_pembuatan' =>  $request->input('tanggal_pakta_pengguna')
            ],


            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_undangan',
                'no_surat' => $request->input('nomor_undangan'),
                'tanggal_pembuatan' => $request->input('tanggal_undangan')
            ],


            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'batas_akhir_dokumen_penawaran',
                'no_surat' => null,
                'tanggal_pembuatan' => $request->input('batas_akhir_dokumen_penawaran')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_buka',
                'no_surat' => $request->input('nomor_ba_buka'),
                'tanggal_pembuatan' =>  $request->input('tanggal_ba_buka')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_evaluasi',
                'no_surat' => $request->input('nomor_ba_evaluasi'),
                'tanggal_pembuatan' =>  $request->input('tanggal_ba_evaluasi')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_negosiasi',
                'no_surat' => $request->input('nomor_ba_negosiasi'),
                'tanggal_pembuatan' =>  $request->input('tanggal_ba_negosiasi')
            ],
            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_ba_hasil_pl',
                'no_surat' => $request->input('nomor_ba_hasil_pl'),
                'tanggal_pembuatan' =>  $request->input('tanggal_ba_hasil_pl')
            ],

            [
                'id_kontrakkerja' => $id,
                'nama_surat' => 'nomor_spk',
                'no_surat' => $request->input('nomor_spk'),
                'tanggal_pembuatan' =>  $request->input('tanggal_spk')
            ],





        ];
        foreach ($pembuatansuratkontrak as $key) {
            $pembuatansurat = PembuatanSuratKontrak::where('nama_surat', $key['nama_surat'])->where('id_kontrakkerja', $id)->first();
            $pembuatansurat1 = PembuatanSuratKontrak::find($pembuatansurat->id);
            $pembuatansurat1->no_surat = $key['no_surat'];
            $pembuatansurat1->tanggal_pembuatan = $key['tanggal_pembuatan'];
            $pembuatansurat1->save($key);
        }
        $tanggal_pekerjaan = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'nomor_spk')->first()->tanggal_pembuatan;
        $kontrakkerja = Kontrakkerja::find($id);
        $kontrakkerja->tanggal_kontrak = $tanggal_pekerjaan;
        $kontrakkerja->tanggal_pekerjaan = $kontrakkerja->tanggal_kontrak;

        $kontrakkerja->tanggal_akhir_pekerjaan = date('Y-m-d', strtotime($kontrakkerja->tanggal_pekerjaan . ' + ' .  $request->input('lama_pekerjaan') . ' days '));
        $kontrakkerja->save();


        return redirect()->route('pengajuankontrak.index')
            ->with('success', 'Data kontrak kerja berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kontrakkerja = KontrakKerja::find($id);
        $kontrakkerja->delete();
        return redirect()->route('pengajuankontrak.index')
            ->with('success', 'Data kontrak kerja berhasil dihapus.');
        // //   Menghapus File jika berhasil redirect
        // if ($kontrakkerja->exist()) {

        // } else {
        //     echo "Gagal Menghapus file";
        // }
        // // Meload Path lokasi file disimpan

        // $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        // // Menghapus dokumen dari database 
        // $kontrakkerja->pembuatansuratkontrak()->delete();
        // $kontrakkerja->penyelenggara()->delete();
        // $kontrakkerja->sumberanggaran()->delete();
        // $kontrakkerja->tandatangan()->delete();




        // Menghapus File jika berhasil redirect
        // if (unlink($path)) {
        //     return redirect()->route('pengajuankontrak.index')
        //         ->with('success', 'Data kontrak kerja berhasil dihapus.');
        // } else {
        //     echo "Gagal Menghapus file";
        // }
        // if (unlink($path)) {
        //     return redirect()->route('pengajuankontrak.index')
        //         ->with('success', 'Data kontrak kerja berhasil dihapus.');
        // } else {
        //     echo "Gagal Menghapus file";
        // }
    }
    // Halaman Detail
    public function detailkontrak($id)
    {

        $kontrakkerja = KontrakKerja::with('vendor')->find($id);

        $sumberanggaran = SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first();
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
                'nomor_surat' => $key['no_surat'],
                'tanggal_surat' => $key['tanggal_pembuatan']

            ];
        }
        $pembuatansurat = json_decode(json_encode($pembuatansurat));

        // Detail Kontrak
        $kontrak = [
            'id_kontrakkerja' => $kontrakkerja->id_kontrakkerja,
            'nama_kontrak' => $kontrakkerja->nama_kontrak,
            'no_urut' => $kontrakkerja->no_urut,
            'tahun' => $kontrakkerja->tahun,
            'lama_pekerjaan' => Carbon::parse($kontrakkerja->tanggal_pekerjaan)->diffInDays($kontrakkerja->tanggal_akhir_pekerjaan),
            'kode_masalah' => $kontrakkerja->kode_masalah,
            'lokasi_pekerjaan' => $kontrakkerja->lokasi_pekerjaan,
            'tanggal_spmk' => $kontrakkerja->tanggal_spmk == null ? '' : $this->dateConvertertoInd($kontrakkerja->tanggal_spmk),
            'nomor_spmk' => $kontrakkerja->no_spmk,

            'skk_ao' =>  $sumberanggaran->skk_ao,
            'tanggal_anggaran' => $sumberanggaran->tanggal_anggaran == null ? '' : $this->dateConvertertoInd($sumberanggaran->tanggal_anggaran),

            'penyedia' => $kontrakkerja->vendor->penyedia,
            'direktur' => $kontrakkerja->vendor->direktur,
            'nama_bank' => $kontrakkerja->vendor->bank,
            'nomor_rekening' => $kontrakkerja->vendor->nomor_rek,
            'alamat_jalan' => $kontrakkerja->vendor->alamat_jalan,
            'alamat_kota' => $kontrakkerja->vendor->alamat_kota,
            'alamat_provinsi' => $kontrakkerja->vendor->alamat_provinsi,


            'manager' => $penyelenggara->manager->nama_pengguna,
            'pengawas_lapangan' => $penyelenggara->pengawas_lapangan->nama_pengguna,
            'pejabat_pelaksana_pengadaan' => $penyelenggara->pejabat_pelaksana_pengadaan->nama_pengguna,
            'pengawas_k3' => $penyelenggara->pengawas_k3->nama_pengguna,
            'direksi' => $penyelenggara->direksi->nama_pengguna,
            'pengawas_pekerjaan' => $penyelenggara->pengawas_pekerjaan->nama_pengguna,

            'tanggal_rks' => $pembuatansurat->nomor_rks->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_rks->tanggal_surat),

            'nomor_rks' => $pembuatansurat->nomor_rks->nomor_surat,

            'tanggal_hps' => $pembuatansurat->nomor_hps->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_hps->tanggal_surat),
            'nomor_hps' => $pembuatansurat->nomor_hps->nomor_surat,

            'tanggal_pakta_pejabat' => $pembuatansurat->nomor_pakta_pejabat->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_pakta_pejabat->tanggal_surat),
            'nomor_pakta_pejabat' => $pembuatansurat->nomor_pakta_pejabat->nomor_surat,

            'tanggal_undangan' => $pembuatansurat->nomor_undangan->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_undangan->tanggal_surat),
            'nomor_undangan' => $pembuatansurat->nomor_undangan->nomor_surat,


            'tanggal_pakta_pengguna' => $pembuatansurat->nomor_pakta_pengguna->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_pakta_pengguna->tanggal_surat),
            'nomor_pakta_pengguna' => $pembuatansurat->nomor_pakta_pengguna->nomor_surat,

            'tanggal_ba_buka' => $pembuatansurat->nomor_ba_buka->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_buka->tanggal_surat),
            'nomor_ba_buka' => $pembuatansurat->nomor_ba_buka->nomor_surat,


            'tanggal_ba_evaluasi' => $pembuatansurat->nomor_ba_evaluasi->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_evaluasi->tanggal_surat),
            'nomor_ba_evaluasi' => $pembuatansurat->nomor_ba_evaluasi->nomor_surat,



            'tanggal_ba_negosiasi' => $pembuatansurat->nomor_ba_negosiasi->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_negosiasi->tanggal_surat),
            'nomor_ba_negosiasi' => $pembuatansurat->nomor_ba_negosiasi->nomor_surat,

            'tanggal_ba_hasil_pl' => $pembuatansurat->nomor_ba_hasil_pl->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_hasil_pl->tanggal_surat),
            'nomor_ba_hasil_pl' => $pembuatansurat->nomor_ba_hasil_pl->nomor_surat,


            'tanggal_spk' => $pembuatansurat->nomor_spk->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_spk->tanggal_surat),
            'nomor_spk' => $pembuatansurat->nomor_spk->nomor_surat,





        ];
        $kontrak = json_decode(json_encode($kontrak));

        $jenis_kontrak = JenisKontrak::where('id_kontrak', $id)->get();

        app(HPSController::class)->refresh($id);
        app(UndanganController::class)->refresh($id);
        app(RKSController::class)->refresh($id);

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

        $kontrakkerja = KontrakKerja::with('vendor')->find($id);

        $sumberanggaran = SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first();
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
                'nomor_surat' => $key['no_surat'],
                'tanggal_surat' => $key['tanggal_pembuatan']

            ];
        }
        $pembuatansurat = json_decode(json_encode($pembuatansurat));

        // Detail Kontrak
        $kontrak = [
            'id_kontrakkerja' => $kontrakkerja->id_kontrakkerja,
            'nama_kontrak' => $kontrakkerja->nama_kontrak,
            'no_urut' => $kontrakkerja->no_urut,
            'tahun' => $kontrakkerja->tahun,
            'lama_pekerjaan' => Carbon::parse($kontrakkerja->tanggal_pekerjaan)->diffInDays($kontrakkerja->tanggal_akhir_pekerjaan),
            'kode_masalah' => $kontrakkerja->kode_masalah,
            'lokasi_pekerjaan' => $kontrakkerja->lokasi_pekerjaan,
            'tanggal_spmk' => $kontrakkerja->tanggal_spmk == null ? '' : $this->dateConvertertoInd($kontrakkerja->tanggal_spmk),
            'nomor_spmk' => $kontrakkerja->no_spmk,

            'skk_ao' =>  $sumberanggaran->skk_ao,
            'tanggal_anggaran' => $sumberanggaran->tanggal_anggaran == null ? '' : $this->dateConvertertoInd($sumberanggaran->tanggal_anggaran),

            'penyedia' => $kontrakkerja->vendor->penyedia,
            'direktur' => $kontrakkerja->vendor->direktur,
            'nama_bank' => $kontrakkerja->vendor->bank,
            'nomor_rekening' => $kontrakkerja->vendor->nomor_rek,
            'alamat_jalan' => $kontrakkerja->vendor->alamat_jalan,
            'alamat_kota' => $kontrakkerja->vendor->alamat_kota,
            'alamat_provinsi' => $kontrakkerja->vendor->alamat_provinsi,


            'manager' => $penyelenggara->manager->nama_pengguna,
            'pengawas_lapangan' => $penyelenggara->pengawas_lapangan->nama_pengguna,
            'pejabat_pelaksana_pengadaan' => $penyelenggara->pejabat_pelaksana_pengadaan->nama_pengguna,
            'pengawas_k3' => $penyelenggara->pengawas_k3->nama_pengguna,
            'direksi' => $penyelenggara->direksi->nama_pengguna,
            'pengawas_pekerjaan' => $penyelenggara->pengawas_pekerjaan->nama_pengguna,

            'tanggal_rks' => $pembuatansurat->nomor_rks->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_rks->tanggal_surat),

            'nomor_rks' => $pembuatansurat->nomor_rks->nomor_surat,

            'tanggal_hps' => $pembuatansurat->nomor_hps->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_hps->tanggal_surat),
            'nomor_hps' => $pembuatansurat->nomor_hps->nomor_surat,

            'tanggal_pakta_pejabat' => $pembuatansurat->nomor_pakta_pejabat->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_pakta_pejabat->tanggal_surat),
            'nomor_pakta_pejabat' => $pembuatansurat->nomor_pakta_pejabat->nomor_surat,

            'tanggal_undangan' => $pembuatansurat->nomor_undangan->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_undangan->tanggal_surat),
            'nomor_undangan' => $pembuatansurat->nomor_undangan->nomor_surat,


            'tanggal_pakta_pengguna' => $pembuatansurat->nomor_pakta_pengguna->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_pakta_pengguna->tanggal_surat),
            'nomor_pakta_pengguna' => $pembuatansurat->nomor_pakta_pengguna->nomor_surat,

            'tanggal_ba_buka' => $pembuatansurat->nomor_ba_buka->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_buka->tanggal_surat),
            'nomor_ba_buka' => $pembuatansurat->nomor_ba_buka->nomor_surat,


            'tanggal_ba_evaluasi' => $pembuatansurat->nomor_ba_evaluasi->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_evaluasi->tanggal_surat),
            'nomor_ba_evaluasi' => $pembuatansurat->nomor_ba_evaluasi->nomor_surat,



            'tanggal_ba_negosiasi' => $pembuatansurat->nomor_ba_negosiasi->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_negosiasi->tanggal_surat),
            'nomor_ba_negosiasi' => $pembuatansurat->nomor_ba_negosiasi->nomor_surat,

            'tanggal_ba_hasil_pl' => $pembuatansurat->nomor_ba_hasil_pl->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_hasil_pl->tanggal_surat),
            'nomor_ba_hasil_pl' => $pembuatansurat->nomor_ba_hasil_pl->nomor_surat,


            'tanggal_spk' => $pembuatansurat->nomor_spk->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_spk->tanggal_surat),
            'nomor_spk' => $pembuatansurat->nomor_spk->nomor_surat,



        ];
        $kontrak = json_decode(json_encode($kontrak));
        $jenisDokumenKelengkapans =  JenisDokumenKelengkapan::with('kelengkapanDokumenVendors')->get()->toArray();
        // dd($jenisDokumenKelengkapans[0]['kelengkapan_dokumen_vendors'][0]['id_dokumen']);

        return  view('plnpengadaan.kontraktahap2.detail', compact('kontrakkerja', 'kontrak', 'jenisDokumenKelengkapans'));
    }




    public function tandatanganpengadaan()
    {
        $status = [
            'Validasi Dokumen Pengadaan Tahap 1',
            'Validasi Dokumen Pengadaan Tahap 2'
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

        $kontrakkerja = KontrakKerja::with('vendor')->find($id);

        $sumberanggaran = SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first();
        $penyelenggaraData = Penyelenggara::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->get()->toArray();

        // dd($penyelenggaraData);
        $penyelenggara = array();
        foreach ($penyelenggaraData as $key => $value) {
            $penyelenggara[$value['nama_jabatan']] = [
                'nama_pengguna' => $value['nama_pengguna']

            ];
        }
        $penyelenggara = json_decode(json_encode($penyelenggara));

        $pembuatansuratData = PembuatanSuratKontrak::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)
            ->with('hps')
            ->get();

        $pembuatansurat = $pembuatansuratData->groupBy('nama_surat')->toArray();


        // dd($pembuatansurat);

        // dd($pembuatansurat['nomor_rks']);
        // Detail Kontrak
        $kontrak = [
            'id_kontrakkerja' => $kontrakkerja->id_kontrakkerja,
            'nama_kontrak' => $kontrakkerja->nama_kontrak,
            'no_urut' => $kontrakkerja->no_urut,
            'tahun' => $kontrakkerja->tahun,
            'lama_pekerjaan' => Carbon::parse($kontrakkerja->tanggal_pekerjaan)->diffInDays($kontrakkerja->tanggal_akhir_pekerjaan),
            'kode_masalah' => $kontrakkerja->kode_masalah,
            'lokasi_pekerjaan' => $kontrakkerja->lokasi_pekerjaan,
            'tanggal_spmk' => $kontrakkerja->tanggal_spmk == null ? '' : $this->dateConvertertoInd($kontrakkerja->tanggal_spmk),
            'nomor_spmk' => $kontrakkerja->no_spmk,

            'skk_ao' =>  $sumberanggaran->skk_ao,
            'tanggal_anggaran' => $sumberanggaran->tanggal_anggaran == null ? '' : $this->dateConvertertoInd($sumberanggaran->tanggal_anggaran),

            'penyedia' => $kontrakkerja->vendor->penyedia,
            'direktur' => $kontrakkerja->vendor->direktur,
            'nama_bank' => $kontrakkerja->vendor->bank,
            'nomor_rekening' => $kontrakkerja->vendor->nomor_rek,
            'alamat_jalan' => $kontrakkerja->vendor->alamat_jalan,
            'alamat_kota' => $kontrakkerja->vendor->alamat_kota,
            'alamat_provinsi' => $kontrakkerja->vendor->alamat_provinsi,


            'manager' => $penyelenggara->manager->nama_pengguna,
            'pengawas_lapangan' => $penyelenggara->pengawas_lapangan->nama_pengguna,
            'pejabat_pelaksana_pengadaan' => $penyelenggara->pejabat_pelaksana_pengadaan->nama_pengguna,
            'pengawas_k3' => $penyelenggara->pengawas_k3->nama_pengguna,
            'direksi' => $penyelenggara->direksi->nama_pengguna,
            'pengawas_pekerjaan' => $penyelenggara->pengawas_pekerjaan->nama_pengguna,

            'tanggal_rks' => $pembuatansurat['nomor_rks'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_rks'][0]['tanggal_pembuatan']),

            'nomor_rks' => $pembuatansurat['nomor_rks'][0]['no_surat'],
            'rks' => RKS::where('id_kontrakkerja', $id)->first(),
            'tanggal_hps' => $pembuatansurat['nomor_hps'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_hps'][0]['tanggal_pembuatan']),
            'nomor_hps' => $pembuatansurat['nomor_hps'][0]['no_surat'],
            'hps' => $pembuatansurat['nomor_hps'][0]['hps'],

            'tanggal_pakta_pejabat' => $pembuatansurat['nomor_pakta_pejabat'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_pakta_pejabat'][0]['tanggal_pembuatan']),
            'nomor_pakta_pejabat' => $pembuatansurat['nomor_pakta_pejabat'][0]['no_surat'],

            'tanggal_undangan' => $pembuatansurat['nomor_undangan'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_undangan'][0]['tanggal_pembuatan']),
            'nomor_undangan' => $pembuatansurat['nomor_undangan'][0]['no_surat'],
            'undangan' => UND::where('id_kontrakkerja', $id)->first(),
            'tanggal_pakta_pengguna' => $pembuatansurat['nomor_pakta_pengguna'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_pakta_pengguna'][0]['tanggal_pembuatan']),
            'nomor_pakta_pengguna' => $pembuatansurat['nomor_pakta_pengguna'][0]['no_surat'],

            'tanggal_ba_buka' => $pembuatansurat['nomor_ba_buka'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_ba_buka'][0]['tanggal_pembuatan']),
            'nomor_ba_buka' => $pembuatansurat['nomor_ba_buka'][0]['no_surat'],


            'tanggal_ba_evaluasi' => $pembuatansurat['nomor_ba_evaluasi'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_ba_evaluasi'][0]['tanggal_pembuatan']),
            'nomor_ba_evaluasi' => $pembuatansurat['nomor_ba_evaluasi'][0]['no_surat'],



            'tanggal_ba_negosiasi' => $pembuatansurat['nomor_ba_negosiasi'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_ba_negosiasi'][0]['tanggal_pembuatan']),
            'nomor_ba_negosiasi' => $pembuatansurat['nomor_ba_negosiasi'][0]['no_surat'],

            'tanggal_ba_hasil_pl' => $pembuatansurat['nomor_ba_hasil_pl'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_ba_hasil_pl'][0]['tanggal_pembuatan']),
            'nomor_ba_hasil_pl' => $pembuatansurat['nomor_ba_hasil_pl'][0]['no_surat'],


            'tanggal_spk' => $pembuatansurat['nomor_spk'][0]['tanggal_pembuatan'] == null ? '' : $this->dateConvertertoInd($pembuatansurat['nomor_spk'][0]['tanggal_pembuatan']),
            'nomor_spk' => $pembuatansurat['nomor_spk'][0]['no_surat'],



        ];
        $kontrak = json_decode(json_encode($kontrak));
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
        $kontrakkerja = KontrakKerja::with('vendor')->find($id);

        $sumberanggaran = SumberAnggaran::where('id_kontrakkerja', $kontrakkerja->id_kontrakkerja)->first();
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
                'nomor_surat' => $key['no_surat'],
                'tanggal_surat' => $key['tanggal_pembuatan']

            ];
        }
        $pembuatansurat = json_decode(json_encode($pembuatansurat));

        // Detail Kontrak
        $kontrak = [
            'id_kontrakkerja' => $kontrakkerja->id_kontrakkerja,
            'nama_kontrak' => $kontrakkerja->nama_kontrak,
            'no_urut' => $kontrakkerja->no_urut,
            'tahun' => $kontrakkerja->tahun,
            'lama_pekerjaan' => Carbon::parse($kontrakkerja->tanggal_pekerjaan)->diffInDays($kontrakkerja->tanggal_akhir_pekerjaan),
            'kode_masalah' => $kontrakkerja->kode_masalah,
            'lokasi_pekerjaan' => $kontrakkerja->lokasi_pekerjaan,
            'tanggal_spmk' => $kontrakkerja->tanggal_spmk == null ? '' : $this->dateConvertertoInd($kontrakkerja->tanggal_spmk),
            'nomor_spmk' => $kontrakkerja->no_spmk,

            'skk_ao' =>  $sumberanggaran->skk_ao,
            'tanggal_anggaran' => $sumberanggaran->tanggal_anggaran == null ? '' : $this->dateConvertertoInd($sumberanggaran->tanggal_anggaran),

            'penyedia' => $kontrakkerja->vendor->penyedia,
            'direktur' => $kontrakkerja->vendor->direktur,
            'nama_bank' => $kontrakkerja->vendor->bank,
            'nomor_rekening' => $kontrakkerja->vendor->nomor_rek,
            'alamat_jalan' => $kontrakkerja->vendor->alamat_jalan,
            'alamat_kota' => $kontrakkerja->vendor->alamat_kota,
            'alamat_provinsi' => $kontrakkerja->vendor->alamat_provinsi,


            'manager' => $penyelenggara->manager->nama_pengguna,
            'pengawas_lapangan' => $penyelenggara->pengawas_lapangan->nama_pengguna,
            'pejabat_pelaksana_pengadaan' => $penyelenggara->pejabat_pelaksana_pengadaan->nama_pengguna,
            'pengawas_k3' => $penyelenggara->pengawas_k3->nama_pengguna,
            'direksi' => $penyelenggara->direksi->nama_pengguna,
            'pengawas_pekerjaan' => $penyelenggara->pengawas_pekerjaan->nama_pengguna,

            'tanggal_rks' => $pembuatansurat->nomor_rks->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_rks->tanggal_surat),

            'nomor_rks' => $pembuatansurat->nomor_rks->nomor_surat,
            'rks' => RKS::where('id_kontrakkerja', $id)->first(),
            'tanggal_hps' => $pembuatansurat->nomor_hps->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_hps->tanggal_surat),
            'nomor_hps' => $pembuatansurat->nomor_hps->nomor_surat,
            'hps' => HPS::where('id_kontrakkerja', $id)->first(),

            'tanggal_pakta_pejabat' => $pembuatansurat->nomor_pakta_pejabat->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_pakta_pejabat->tanggal_surat),
            'nomor_pakta_pejabat' => $pembuatansurat->nomor_pakta_pejabat->nomor_surat,

            'tanggal_undangan' => $pembuatansurat->nomor_undangan->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_undangan->tanggal_surat),
            'nomor_undangan' => $pembuatansurat->nomor_undangan->nomor_surat,
            'undangan' => UND::where('id_kontrakkerja', $id)->first(),

            'tanggal_pakta_pejabat' => $pembuatansurat->nomor_pakta_pejabat->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_pakta_pejabat->tanggal_surat),
            'nomor_pakta_pejabat' => $pembuatansurat->nomor_pakta_pejabat->nomor_surat,

            'tanggal_undangan' => $pembuatansurat->nomor_undangan->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_undangan->tanggal_surat),
            'nomor_undangan' => $pembuatansurat->nomor_undangan->nomor_surat,


            'tanggal_pakta_pengguna' => $pembuatansurat->nomor_pakta_pengguna->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_pakta_pengguna->tanggal_surat),
            'nomor_pakta_pengguna' => $pembuatansurat->nomor_pakta_pengguna->nomor_surat,

            'tanggal_ba_buka' => $pembuatansurat->nomor_ba_buka->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_buka->tanggal_surat),
            'nomor_ba_buka' => $pembuatansurat->nomor_ba_buka->nomor_surat,


            'tanggal_ba_evaluasi' => $pembuatansurat->nomor_ba_evaluasi->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_evaluasi->tanggal_surat),
            'nomor_ba_evaluasi' => $pembuatansurat->nomor_ba_evaluasi->nomor_surat,



            'tanggal_ba_negosiasi' => $pembuatansurat->nomor_ba_negosiasi->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_negosiasi->tanggal_surat),
            'nomor_ba_negosiasi' => $pembuatansurat->nomor_ba_negosiasi->nomor_surat,

            'tanggal_ba_hasil_pl' => $pembuatansurat->nomor_ba_hasil_pl->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_ba_hasil_pl->tanggal_surat),
            'nomor_ba_hasil_pl' => $pembuatansurat->nomor_ba_hasil_pl->nomor_surat,


            'tanggal_spk' => $pembuatansurat->nomor_spk->tanggal_surat == null ? '' : $this->dateConvertertoInd($pembuatansurat->nomor_spk->tanggal_surat),
            'nomor_spk' => $pembuatansurat->nomor_spk->nomor_surat,



        ];
        $kontrak = json_decode(json_encode($kontrak));

        $jenis_kontrak = JenisKontrak::where('id_kontrak', $id)->get();


        return view('plnmanager.detail', compact('kontrakkerja', 'kontrak', 'jenis_kontrak', 'id'));
    }
}
