<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use App\Models\BarJasHPS;
use App\Models\Dokumen\BOQ;
use App\Models\DokumenVendor\Formpenawaranharga;
use App\Models\DokumenVendor\Lampiranpenawaranharga;
use App\Models\HPS;
use App\Models\JenisDokumenKelengkapan;
use App\Models\KelengkapanDokumenVendor;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use App\Models\TandaTangan;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DNS2D;
use Illuminate\Support\Facades\Auth;
use PDF;
use Terbilang;

class LampiranPenawaranHargaController extends Controller
{
    public function refresh($id)
    {

        // Mencari record dengan no_dokumen yang sesuai di tabel jenis_dokumen_kelengkapans
        $jenisDokumen = JenisDokumenKelengkapan::where('no_dokumen', "harga_nilai_penawaran_")->with(['kelengkapanDokumenVendors' => function ($query) use ($id) {
            $query->where('id_kontrakkerja', $id);
        }])->first();

        if ($jenisDokumen->kelengkapanDokumenVendors->isEmpty()) {


            // Membuat record baru di tabel kelengkapan_dokumen_vendors
            KelengkapanDokumenVendor::create([
                'id_jenis_dokumen' => $jenisDokumen->id_jenis,
                'id_vendor' => Auth::user()->vendor_id,
                'id_kontrakkerja' => $id,
            ])->save();
        }


        $kelengkapan = KelengkapanDokumenVendor::where('id_kontrakkerja', $id)->where('id_jenis_dokumen', $jenisDokumen->id_jenis)->with('lampiranPenawaranHargas')->first();

        if (!$kelengkapan->lampiranPenawaranHargas) {
            $data = [];
            Lampiranpenawaranharga::create([
                'id_dokumen' => $kelengkapan->id_dokumen,
                'datalamp' => $data

            ])->save();
        }

        $this->getBOQData($id);
        $lampiranDokumen =  Lampiranpenawaranharga::where('id_dokumen', $kelengkapan->id_dokumen)->first();




        $jenis_kontrak = JenisKontrak::where('id_kontrak', $id)->with('barjas')->get()->toArray();

        $barjaslamp = $lampiranDokumen->datalamp;






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



        $lampiranDokumen->datalamp = $barjaslamp;
        $lampiranDokumen->save();

        return $lampiranDokumen;
    }

    public function getBOQData($id)
    {
        $kelengkapandokumenModel = KelengkapanDokumenVendor::with(['lampiranPenawaranHargas', 'jenisDokumen' => function ($query) {
            $query->where('no_dokumen', 'harga_nilai_penawaran_');
        }])->where('id_kontrakkerja', $id)->first();

        $boq = BOQ::where('id_kontrakkerja', $id)->with('barJasBOQs')->first()->toArray();
        $barjasboqdata = $boq['bar_jas_b_o_qs'];

        // $databoq = [
        //     "total_jumlah" => $boq['total_jumlah'],
        //     "dibulatkan" => $boq['dibulatkan'],
        //     "ppn11" => $boq['ppn11'],
        //     "total_harga" => $boq['total_harga']

        // ];

        // $barjasboqdata = [];
        // foreach ($boq['bar_jas_b_o_qs'] as $barjasboq) {
        //     $databoq[] = [
        //         'harga_satuan' => $barjasboq['harga_satuan'],
        //         'jumlah' => $barjasboq['jumlah']
        //     ];
        // }

        $lampiranPenawaran2 = Lampiranpenawaranharga::find($kelengkapandokumenModel->lampiranPenawaranHargas->id);
        $lampiranPenawaran2->total_jumlah = $boq['total_jumlah'];
        $lampiranPenawaran2->dibulatkan = $boq['dibulatkan'];
        $lampiranPenawaran2->ppn11 = $boq['ppn11'];
        $lampiranPenawaran2->total_harga = $boq['total_harga'];
        $lampiranPenawaran2->datalamp = $barjasboqdata;
        $lampiranPenawaran2->save();


        return $lampiranPenawaran2;
    }
    // public function create($id)
    // {

    //     // Mengambil path file JSON dari database berdasarkan ID
    //     $formPenawaranHarga = $this->refresh($id);

    //     $kontrakkerja = KontrakKerja::find($id);
    //     $jenis_kontraks = JenisKontrak::where('id_kontrak', $kontrakkerja->id_kontrakkerja)->get()->toArray();

    //     $harga_penawaran = $formPenawaranHarga->datalampiran;

    //     $kontrakbaru = [];


    //     foreach ($jenis_kontraks as $jenis_kontrak) {

    //         $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->get()->toArray();
    //         $data = [];
    //         $no = 0;
    //         if (count($databarjas) != 0) {

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
    //                     'harga_satuan' => empty($harga_penawaran[$no]) ? 0 : $harga_penawaran[$no]['harga_satuan'],
    //                     'jumlah' => empty($harga_penawaran[$no]) ? 0 : $harga_penawaran[$no]['jumlah'],
    //                     'sub_data' => $sub_data

    //                 ];
    //                 $no++;
    //             }
    //         }


    //         $kontrakbaru[] = [
    //             'jenis_kontrak' => $jenis_kontrak['nama_jenis'],
    //             'data' => $data

    //         ];
    //     }

    //     $lampiranPenawaran = $formPenawaranHarga;

    //     return view('vendor.form_penawaran.lampiranpenawaranharga.create', compact('id', 'kontrakbaru', 'lampiranPenawaran'));
    // }

    public function update(Request $request, $id)
    {


        // Mengambil path file JSON dari database berdasarkan ID
        $lampiranPenawaran = $this->refresh($id);


        $lampiranPenawaran2 = Lampiranpenawaranharga::find($lampiranPenawaran->id);

        // Perbarui nilai-nilai dalam objek $lampiranPenawaran2
        // $lampiranPenawaran2->total_jumlah = $request->input('total_jumlah');
        // $lampiranPenawaran2->dibulatkan = $request->input('dibulatkan');
        // $lampiranPenawaran2->ppn11 = $request->input('ppn11');
        // $lampiranPenawaran2->total_harga = $request->input('harga_total');
        // $lampiranPenawaran2->kota_surat = $request->input('kota_surat');
        // $lampiranPenawaran2->tanggal_surat = $request->input('tanggal_surat');
        // $pembuatansuratkontrak = PembuatanSuratKontrak::where('id_kontrakkerja', $id)
        //     ->where('nama_surat', 'nomor_rks')
        //     ->with(['boq', 'b_o_q_s.barjas_b_o_q_s'])
        //     ->first();
        $boq = BOQ::where('id_kontrakkerja', $id)->with('barJasBOQs')->first()->toArray();

        $databoq = [
            "total_jumlah" => $boq['total_jumlah'],
            "dibulatkan" => $boq['dibulatkan'],
            "ppn11" => $boq['ppn11'],
            "total_harga" => $boq['total_harga']

        ];

        $barjasboqdata = [];
        foreach ($boq['bar_jas_b_o_qs'] as $barjasboq) {
            $databoq[] = [
                'harga_satuan' => $barjasboq['harga_satuan'],
                'jumlah' => $barjasboq['jumlah']
            ];
        }
        $lampiranPenawaran2->total_jumlah = $request->input('total_jumlah');
        $lampiranPenawaran2->dibulatkan = $request->input('dibulatkan');
        $lampiranPenawaran2->ppn11 = $request->input('ppn11');
        $lampiranPenawaran2->total_harga = $request->input('harga_total');
        $lampiranPenawaran2->datalamp = $barjasboqdata;
        $lampiranPenawaran2->save();


        // $lampiranPenawaran3 = Lampiranpenawaranharga::find($lampiranPenawaran->id);
        // Bagian menyimpan file 

        // if ($request->hasFile('kopsurat')) {

        //     $file = $request->file('kopsurat');
        //     $extension = $file->extension(); // Mendapatkan ekstensi file


        //     $dataURL = $request->input('hasilkopsurat');

        //     // Mengubah data URL menjadi file gambar
        //     $fileData = explode(',', $dataURL)[1];
        //     $decodedData = base64_decode($fileData);

        //     // Menyimpan file gambar ke storage/app/public/dokumenvendor/kopsurat
        //     $filename = uniqid() . '_' . date('Ymd') . '.' . $extension;
        //     $path = $lampiranPenawaran2->kopsuratpath . '/' . $filename;
        //     Storage::disk('public')->put($path, $decodedData);

        //     $lampiranPenawaran3->kopsurat = $filename;
        // }





        // $barjaslamp = $request->input('lampiran');

        // $data = $lampiranPenawaran2->datalampiran;

        // $no = 0;

        // foreach ($barjaslamp as $bhps) {
        //     $data[$no]['harga_satuan'] = str_replace('.', '', $bhps['harga_satuan']);
        //     $data[$no]['jumlah'] =  str_replace('.', '', $bhps['jumlah']);

        //     $no++;
        // }

        // // Simpan perubahan
        // $lampiranPenawaran3->datalampiran = $data;
        // $lampiranPenawaran3->save();

        // Redirect ke route 'vendor.kontrakkerja.detail' dengan ID yang sesuai
        // return redirect()->route('vendor.kontrakkerja.detail', ['id' => $id]);
    }

    public function halamanttd($id)
    {

        return view('vendor.form_penawaran.lampiranpenawaranharga.halamanttd', compact('id'));
    }

    public function simpanttd(Request $request)
    {
        $formPenawaranHarga = $this->refresh($request->input('id'));

        // Menyimpan file tanda tangan ke storage
        $file = $request->file('file_tandatangan');

        // Generate the new filename using time(), original name, and extension
        $filename = time() . '_' . $file->getClientOriginalName();

        // Store the file with the new filename
        $filePath = $file->storeAs('public/dokumenvendor', $filename);
        $id_kontrakkerja = $request->input('id');


        // Update kolom file_tandatangan, no_unik_ttd, dan tanggal_tandatangan
        $kelengkapandokumen = KelengkapanDokumenVendor::find($formPenawaranHarga->id_dokumen);
        $kelengkapandokumen->file_upload = $filename;
        $kelengkapandokumen->tandatangan = TandaTangan::where('id', Auth::user()->id)->first()->kode_unik;
        $kelengkapandokumen->save();

        return redirect()->route('vendor.kontrakkerja.detail', ['id' => $id_kontrakkerja]);
    }
    public function pdf($id)
    {
        // Mengambil path file JSON dari database berdasarkan ID
        $lampiranPenawaran = $this->refresh($id);

        $datalampiran1 = $lampiranPenawaran->datalamp;

        $kontrakbaru = [];

        $jenis_kontraks = JenisKontrak::where('id_kontrak', $id)->get()->toArray();

        foreach ($jenis_kontraks as $jenis_kontrak) {

            $databarjas = BarJas::where('id_jenis_kontrak', $jenis_kontrak['id'])->with('barjasHPS')->get()->toArray();
            $data = [];
            if (count($databarjas) != 0) {

                foreach ($databarjas as $barjas) {


                    $sub_data = [];
                    $datasubbarjas = SubBarjas::where('id_barjas', $barjas['id'])->get()->toArray();
                    $no = 0;
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
                        'harga_satuan' => number_format(str_replace('.', '', $datalampiran1[$no]['harga_satuan']), 0, ',', '.'),
                        'jumlah' => number_format(str_replace('.', '', $datalampiran1[$no]['jumlah']), 0, ',', '.'),
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

        $kontrak = KontrakKerja::find($id); // contoh data kontrak. Sesuaikan dengan kebutuhan Anda.


        $nama_pekerjaan = $kontrak->nama_kontrak;
        $vendor = Vendor::find($kontrak->id_vendor);


        // Form Penawaran 
        $formpenawaran = Formpenawaranharga::with(['dokumen' => function ($query) use ($id) {
            $query->where('id_kontrakkerja', $id);
        }])->first();
        $kopsurat = asset('/storage/' . $formpenawaran->kopsuratpath . '/' . $formpenawaran->kopsurat);
        $data2 = [
            'kopsurat' => $kopsurat,
            'nama_pekerjaan' => $nama_pekerjaan,
            'kota_surat' => $formpenawaran->nama_kota,
            'tanggal_surat' =>  Carbon::parse($formpenawaran->tanggal_pembuatan_surat)->locale('id')->isoFormat('D MMMM YYYY'),
            'penyedia' => $vendor->penyedia,
            'nama_direktur' => $vendor->direktur,
            'jumlah_harga' => number_format(str_replace('.', '', $lampiranPenawaran->total_jumlah), 0, ',', '.'),
            'dibulatkan' => number_format(str_replace('.', '', $lampiranPenawaran->dibulatkan), 0, ',', '.'),

            'ppn_11' =>  number_format(str_replace('.', '', $lampiranPenawaran->ppn11), 0, ',', '.'),
            'harga_total' =>  number_format(str_replace('.', '', $lampiranPenawaran->total_harga), 0, ',', '.'),
            'terbilang' => ucwords(Terbilang::make(str_replace('.', '', $lampiranPenawaran->total_harga)))

        ];

        $pdf = PDF::loadView('vendor.form_penawaran.lampiranpenawaranharga.pdf', compact('data2', 'kontrakbaru'));
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'LampiranPenawaran_' . time() . '.pdf';
        return $pdf->stream($namefile);
    }
}
