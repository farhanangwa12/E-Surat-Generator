<?php

namespace App\Http\Controllers\SuratVendor;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\DokumenVendor\Datapengalaman;
use App\Models\DokumenVendor\Formpenawaranharga as DokumenVendorFormpenawaranharga;
use App\Models\DokumenVendor\Subdatapengalaman;
use App\Models\FormPenawaran\FormPenawaranHarga;
use App\Models\JenisDokumenKelengkapan;
use App\Models\KelengkapanDokumenVendor;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\TandaTangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class DataPengalamanController extends Controller
{
    public function refresh($id)
    {
        // Cek apakah terdapat data penawaran dengan id_kontrakkerja yang sesuai
        // $jenisDokumen = JenisDokumenKelengkapan::where('no_dokumen', "pakta_integritas_")
        // $kelengkapan = KelengkapanDokumenVendor::where('id_kontrakkerja',$id)->with('jenisDokumen');
        $jenisDokumen = JenisDokumenKelengkapan::where('no_dokumen', 'memiliki_pengalaman_pengadaan_sejenis_dibuktikan_dengan_salinan_kontrak_spk_')
            ->with(['kelengkapanDokumenVendors' => function ($query) use ($id) {
                $query->where('id_kontrakkerja', $id);
            }])
            ->first();

        if ($jenisDokumen->kelengkapanDokumenVendors->isEmpty()) {


            // Membuat record baru di tabel kelengkapan_dokumen_vendors
            KelengkapanDokumenVendor::create([
                'id_jenis_dokumen' => $jenisDokumen->id_jenis,
                'id_vendor' => Auth::user()->vendor_id,
                'id_kontrakkerja' => $id,
            ])->save();
        }


        $kelengkapan = KelengkapanDokumenVendor::where('id_kontrakkerja', $id)->where('id_jenis_dokumen', $jenisDokumen->id_jenis)->with('datapengalaman')->first();





        if ($kelengkapan->datapengalaman == null) {

            $datapengalaman = new Datapengalaman();
            $datapengalaman->id_dokumen = $kelengkapan->id_dokumen;
            $datapengalaman->id_vendor = Auth::user()->vendor_id;
            $datapengalaman->save();
        }

        $datapengalaman1 = Datapengalaman::where('id_vendor', $kelengkapan->id_vendor)->where('id_dokumen', $kelengkapan->id_dokumen)->first();

        return $datapengalaman1;
    }

    public function index($id)
    {
        // Membaca data dari file JSON
        $kelengkapan = $this->refresh($id);

        $datapengalaman = Subdatapengalaman::where('id_datapengalaman', $kelengkapan->id)->get();


        // $datapengalaman = 


        return view('vendor.form_penawaran.datapengalaman.index', compact('id', 'datapengalaman', 'kelengkapan'));
    }

    public function create($id)
    {
        return view('vendor.form_penawaran.datapengalaman.create', compact('id'));
    }

    public function store(Request $request, $id)
    {
        $kelengkapan = $this->refresh($id);
        $request->validate([
            'bidang_pekerjaan' => 'required',
            'sub_bidang_pekerjaan' => 'required',
            'lokasi' => 'required',
            'nama_pemberi_tugas' => 'required',
            'alamat_pemberi_tugas' => 'required',
            'no_tanggal_kontrak' => 'required',
            'nilai' => 'required',
            'kontrak' => 'required',
            'ba_serah_terima' => 'required:mimes:pdf',

        ]);

        // Simpan data ke model Datapengalaman
        $subdatapengalaman = new Subdatapengalaman();
        $subdatapengalaman->id_datapengalaman = $kelengkapan->id;

        $subdatapengalaman->bidang_pekerjaan = $request->bidang_pekerjaan;
        $subdatapengalaman->sub_bidang_pekerjaan = $request->sub_bidang_pekerjaan;
        $subdatapengalaman->lokasi = $request->lokasi;
        $subdatapengalaman->nama_pemberi_tugas = $request->nama_pemberi_tugas;
        $subdatapengalaman->alamat_pemberi_tugas = $request->alamat_pemberi_tugas;
        $subdatapengalaman->no_tanggal_kontrak = $request->no_tanggal_kontrak;
        $subdatapengalaman->nilai = $request->nilai;
        $subdatapengalaman->kontrak = $request->kontrak;

        if ($request->hasFile('ba_serah_terima')) {
            $file = $request->file('ba_serah_terima');
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::uuid() . '.' . $extension;
            $path = $file->storeAs('public/datapengalaman', $fileName);

            // Simpan path baru ke database
            // Misalnya: $pengalaman->ba_serah_terima_path = $path;
            $subdatapengalaman->ba_serah_terima = $fileName;
        }


        // Simpan data ke database
        $subdatapengalaman->save();

        return redirect()->route('vendor.datapengalaman.index', ['id' => $id])->with('success', 'Data pengalaman perusahaan berhasil ditambahkan.');
    }

    public function edit($id, $id_data)
    {
        $kelengkapan = $this->refresh($id);
        $datapengalaman = Subdatapengalaman::find($id_data);

        return view('vendor.form_penawaran.datapengalaman.edit', compact('id', 'datapengalaman'));
    }

    public function update(Request $request, $id, $id_data)
    {
        $kelengkapan = $this->refresh($id);


        $request->validate([
            'bidang_pekerjaan' => 'required',
            'sub_bidang_pekerjaan' => 'required',
            'lokasi' => 'required',
            'nama_pemberi_tugas' => 'required',
            'alamat_pemberi_tugas' => 'required',
            'no_tanggal_kontrak' => 'required',
            'nilai' => 'required',
            'kontrak' => 'required',

        ]);

        // Simpan data ke model Datapengalaman
        $subdatapengalaman = Subdatapengalaman::find($id_data);
        $subdatapengalaman->id_datapengalaman = $kelengkapan->id;

        $subdatapengalaman->bidang_pekerjaan = $request->bidang_pekerjaan;
        $subdatapengalaman->sub_bidang_pekerjaan = $request->sub_bidang_pekerjaan;
        $subdatapengalaman->lokasi = $request->lokasi;
        $subdatapengalaman->nama_pemberi_tugas = $request->nama_pemberi_tugas;
        $subdatapengalaman->alamat_pemberi_tugas = $request->alamat_pemberi_tugas;
        $subdatapengalaman->no_tanggal_kontrak = $request->no_tanggal_kontrak;
        $subdatapengalaman->nilai = $request->nilai;
        $subdatapengalaman->kontrak = $request->kontrak;
        if ($request->hasFile('ba_serah_terima')) {
            if ($subdatapengalaman->ba_serah_terima) {
                Storage::delete('public/datapengalaman/' . $subdatapengalaman->ba_serah_terima);
            }
            $file = $request->file('ba_serah_terima');
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::uuid() . '.' . $extension;
            $path = $file->storeAs('public/datapengalaman', $fileName);

            // Simpan path baru ke database
            // Misalnya: $pengalaman->ba_serah_terima_path = $path;
            $subdatapengalaman->ba_serah_terima = $fileName;
        }


        // Simpan data ke database
        $subdatapengalaman->save();

        return redirect()->route('vendor.datapengalaman.index', ['id' => $id])->with('success', 'Data pengalaman perusahaan berhasil diupdate.');
    }
    public function updateDataPengalaman(Request $request, $id, $id_data)
    {
        // Validasi input
        $validatedData = $request->validate([
            'kota_surat' => 'nullable|string',
            'tanggal_surat' => 'nullable|date',
            'nama_perusahaan' => 'nullable|string',
            'nama_jelas' => 'nullable|string',
            'jabatan' => 'nullable|string',
        ]);

        // Cari data pengalaman berdasarkan ID
        $datapengalaman = Datapengalaman::findOrFail($id_data);

        // Perbarui data pengalaman dengan input yang valid
        $datapengalaman->kota_surat = $validatedData['kota_surat'];
        $datapengalaman->tanggal_surat = $validatedData['tanggal_surat'];
        $datapengalaman->nama_perusahaan = $validatedData['nama_perusahaan'];
        $datapengalaman->nama_jelas = $validatedData['nama_jelas'];
        $datapengalaman->jabatan = $validatedData['jabatan'];

        // Simpan perubahan
        $datapengalaman->save();

        // Redirect atau melakukan tindakan lainnya setelah penyimpanan berhasil
        return redirect()->route('vendor.datapengalaman.index', $id)->with('success', 'Data pengalaman berhasil diperbarui');
    }

    public function destroy($id, $id_data)
    {

        $subdatapengalaman = Subdatapengalaman::find($id_data);
        // dd($subdatapengalaman);
        $subdatapengalaman->delete();


        return redirect()->route('vendor.datapengalaman.index', ['id' => $id])->with('success', 'Data pengalaman perusahaan berhasil diupdate.');
    }



    public function halamanttd($id)
    {

        return view('vendor.form_penawaran.datapengalaman.halamanttd', compact('id'));
    }

    public function simpanttd(Request $request, $id)
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

    public function pdf($id, $jenis)
    {

        // Membaca data dari file JSON
        $kelengkapan = $this->refresh($id);

        $datapengalaman = Subdatapengalaman::where('id_datapengalaman', $kelengkapan->id)->get();


        $formPenawaran = app(FormPenawaranHargaController::class);
        $formpenawaranData = $formPenawaran->refresh($id);

        $kopsurat = asset('/storage/' . $formpenawaranData->kopsuratpath . '/' . $formpenawaranData->kopsurat);

    
        // Informasi RKS
        $pembuatansuratkontrak = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'nomor_rks')->first();

        // Informasi Kontrakkerja
        $kontrakkerja = KontrakKerja::find($id)->with('vendor')->first();
        $data = [
            'kopsurat' => $kopsurat,
            'nama' => $kontrakkerja->vendor->direktur,
            'jabatan' => 'Direktur',
            'nama_perusahaan' =>  $kontrakkerja->vendor->penyedia,

            'kota_surat' => $formpenawaranData->nama_kota,
            'tanggal_surat' => Carbon::parse($formpenawaranData->tanggal_pembuatan_surat)->locale('id')->isoFormat('D MMMM YYYY'),

            'datapengalaman' => $datapengalaman
        ];

        // Generate the PDF using laravel-dompdf


        $pdf = PDF::loadView('vendor.form_penawaran.datapengalaman.pdf', $data);

        $namefile = 'Data Pengalaman' . time() . '.pdf';

        if ($jenis == 1) {

            // Menampilkan output di browser
            return $pdf->stream($namefile);
        } else if ($jenis == 2) {


            // Download file
            return $pdf->download($namefile);
        } else {
            return "Parameter tidak valid";
        }
    }
}
