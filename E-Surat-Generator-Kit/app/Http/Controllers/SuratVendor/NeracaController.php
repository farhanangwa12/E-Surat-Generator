<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use App\Models\DokumenVendor\Neraca;
use App\Models\FormPenawaran\FormPenawaranHarga;
use App\Models\JenisDokumenKelengkapan;
use App\Models\KelengkapanDokumenVendor;
use App\Models\TandaTangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class NeracaController extends Controller
{
    public function refresh($id)
    {
        // Cek apakah terdapat data penawaran dengan id_kontrakkerja yang sesuai
        // $jenisDokumen = JenisDokumenKelengkapan::where('no_dokumen', "pakta_integritas_")
        // $kelengkapan = KelengkapanDokumenVendor::where('id_kontrakkerja',$id)->with('jenisDokumen');
        $jenisDokumen = JenisDokumenKelengkapan::where('no_dokumen', 'neraca_laporan_keuangan_perusahaan_terakhir_yang_memuat_laporan_laba_rugi_')
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


        $kelengkapan = KelengkapanDokumenVendor::where('id_kontrakkerja', $id)->where('id_jenis_dokumen', $jenisDokumen->id_jenis)->with('pernyataanGaransi')->first();



        if ($kelengkapan->neraca === null) {

            $neraca = new Neraca();
            $neraca->id_dokumen = $kelengkapan->id_dokumen;

            $neraca->save();
        }

        $neraca1 = Neraca::where('id_dokumen', $kelengkapan->id_dokumen)->first();
        return $neraca1;
    }
    public function create($id)
    {
        $penawaran = $this->refresh($id);
        // dd($penawaran);
        $data = [
            'id' => $id,
            'tanggal_neraca' => $penawaran->tanggal_neraca, // Contoh: 10-05-2023
            'aktiva_lancar' =>  $penawaran->aktiva_lancar,
            'utang_jangka_pendek' =>  $penawaran->utang_jangka_pendek,
            'kas' =>  $penawaran->kas,
            'utang_dagang' =>  $penawaran->utang_dagang,
            'bank' => $penawaran->bank,
            'utang_pajak' =>  $penawaran->utang_pajak,
            'piutang' =>  $penawaran->piutang,
            'persediaan_barang' =>  $penawaran->persediaan_barang,
            'pekerjaan_dalam_proses' =>  $penawaran->pekerjaan_dalam_proses,
            'aktiva_tetap' =>  $penawaran->aktiva_tetap,
            'kekayaan_bersih' =>  $penawaran->kekayaan_bersih,
            'peralatan_dan_mesin_1' =>  $penawaran->peralatan_dan_mesin_1,
            'peralatan_dan_mesin_2' =>  $penawaran->peralatan_dan_mesin_2,
            'inventaris' =>  $penawaran->inventaris,
            'gedung_gedung' =>  $penawaran->gedung_gedung,
            'jumlah_a_b' =>  $penawaran->jumlah_a_b,
            'jumlah_d' =>  $penawaran->jumlah_d,
            'piutang_jangka_pendek_sampai_6_bulan' =>  $penawaran->piutang_jangka_pendek_sampai_6_bulan,
            'piutang_jangka_pendek_lebih_dari_6_bulan' =>  $penawaran->piutang_jangka_pendek_lebih_dari_6_bulan,
            'jumlah' =>  $penawaran->jumlah,
        ];


        // Generate the PDF using laravel-dompdf

        return view('vendor.form_penawaran.neraca.create', $data);
    }

    public function update(Request $request, $id)
    {
        $penawaran = $this->refresh($id);
        // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            'tanggal_neraca' => 'required',
            'aktiva_lancar' => 'required|numeric',
            'utang_jangka_pendek' => 'required|numeric',
            'kas' => 'required|numeric',
            'utang_dagang' => 'required|numeric',
            'utang_pajak' => 'required|numeric',
            'piutang' => 'required|numeric',
            'persediaan_barang' => 'required|numeric',
            'pekerjaan_dalam_proses' => 'required|numeric',
            'aktiva_tetap' => 'required|numeric',
            'kekayaan_bersih' => 'required|numeric',
            'peralatan_dan_mesin_1' => 'required|numeric',
            'peralatan_dan_mesin_2' => 'required|numeric',
            'inventaris' => 'required|numeric',
            'gedung_gedung' => 'required|numeric',
            'jumlah_a_b' => 'required|numeric',
            'jumlah_d' => 'required|numeric',
            'piutang_jangka_pendek_sampai_6_bulan' => 'required|numeric',
            'piutang_jangka_pendek_lebih_dari_6_bulan' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);


        $neraca = Neraca::find($penawaran->id);
  
        $neraca->tanggal_neraca = $validatedData['tanggal_neraca'];
        $neraca->aktiva_lancar = $validatedData['aktiva_lancar'];
        $neraca->utang_jangka_pendek = $validatedData['utang_jangka_pendek'];
        $neraca->kas = $validatedData['kas'];
        $neraca->utang_dagang = $validatedData['utang_dagang'];
        $neraca->utang_pajak = $validatedData['utang_pajak'];
        $neraca->piutang = $validatedData['piutang'];
        $neraca->persediaan_barang = $validatedData['persediaan_barang'];
        $neraca->pekerjaan_dalam_proses = $validatedData['pekerjaan_dalam_proses'];
        $neraca->aktiva_tetap = $validatedData['aktiva_tetap'];
        $neraca->kekayaan_bersih = $validatedData['kekayaan_bersih'];
        $neraca->peralatan_dan_mesin_1 = $validatedData['peralatan_dan_mesin_1'];
        $neraca->peralatan_dan_mesin_2 = $validatedData['peralatan_dan_mesin_2'];
        $neraca->inventaris = $validatedData['inventaris'];
        $neraca->gedung_gedung = $validatedData['gedung_gedung'];
        $neraca->jumlah_a_b = $validatedData['jumlah_a_b'];
        $neraca->jumlah_d = $validatedData['jumlah_d'];
        $neraca->piutang_jangka_pendek_sampai_6_bulan = $validatedData['piutang_jangka_pendek_sampai_6_bulan'];
        $neraca->piutang_jangka_pendek_lebih_dari_6_bulan = $validatedData['piutang_jangka_pendek_lebih_dari_6_bulan'];
        $neraca->jumlah = $validatedData['jumlah'];

        $neraca->save();

        return redirect()->route('vendor.kontrakkerja.detail', $id);
    }

    public function halamanttd($id)
    {
        // Implementasi logika untuk halaman tanda tangan data pengalaman

        return view('vendor.form_penawaran.neraca.halamanttd', compact('id'));
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

    public function pdf($id)
    {
        $data = [
            'nama' => 'John Doe',
            'jabatan' => 'Manager',
            'nama_perusahaan' => 'Example Company',
            'atas_nama' => 'John Doe',
            'alamat_perusahaan' => '456 Example Avenue, City',
            'telepon_fax' => '555-1234',
            'email_perusahaan' => 'info@example.com',
            'nama_pekerjaan' => 'Example Job',
            'nomor_rks' => '1234',
            'tanggal_rks' => '2023-05-26',
            'kota_surat' => 'City',
            'tanggal_surat' => '2023-05-26',
            'nama_terang' => 'Example Terang',
        ];

        // Generate the PDF using laravel-dompdf

        $pdf = PDF::loadView('vendor.form_penawaran.neraca.pdf', $data);

        // Output the generated PDF to the browser
        return $pdf->stream('pernyataan_sanggup.pdf');
    }
}
