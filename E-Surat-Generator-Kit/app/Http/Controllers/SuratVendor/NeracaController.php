<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use App\Models\FormPenawaran\FormPenawaranHarga;
use Illuminate\Http\Request;
use PDF;

class NeracaController extends Controller
{
    public function refresh($id)
    {
        // Cek apakah terdapat data penawaran dengan id_kontrakkerja yang sesuai
        $formPenawaranHarga = FormPenawaranHarga::where('id_kontrakkerja', $id)->first();

        if ($formPenawaranHarga) {
            // Jika ada data penawaran, kembalikan data form penawaran
            if ($formPenawaranHarga->neraca == null) {
                $formPenawaranHarga1 = FormPenawaranHarga::find($formPenawaranHarga->id);

                $formPenawaranHarga1->neraca = json_encode([
                    'tanggal_neraca' => null,
                    'aktiva_lancar' => null,
                    'utang_jangka_pendek' => null,
                    'kas' => null,
                    'utang_dagang' => null,
                    'utang_pajak' => null,
                    'piutang' => null,
                    'persediaan_barang' => null,
                    'pekerjaan_dalam_proses' => null,
                    'aktiva_tetap' => null,
                    'kekayaan_bersih' => null,
                    'peralatan_dan_mesin_1' => null,
                    'peralatan_dan_mesin_2' => null,
                    'inventaris' => null,
                    'gedung_gedung' => null,
                    'jumlah_a_b' => null,
                    'jumlah_d' => null,
                    'piutang_jangka_pendek_sampai_6_bulan' => null,
                    'piutang_jangka_pendek_lebih_dari_6_bulan' => null,
                    'jumlah' => null,
                ]);
                $formPenawaranHarga1->save();
                return $formPenawaranHarga1;
            } else {
                return $formPenawaranHarga;
            }
        } else {
            // Jika tidak ada data penawaran, generate form penawaran dengan array JSON kosong
            $formPenawaranHarga = new FormPenawaranHarga();
            $formPenawaranHarga->id_kontrakkerja = $id;
            $formPenawaranHarga->id_vendor = 1;
            $formPenawaranHarga->kopsurat = null;
            $formPenawaranHarga->file_path = "null";
            // $formPenawaranHarga->data_paktavendor = json_encode([]);
            // $formPenawaranHarga->data_lamp_nego = json_encode([]);
            // $formPenawaranHarga->data_pernyataan_kesanggupan = json_encode([]);
            // $formPenawaranHarga->data_pernyataan_garansi = json_encode([]);
            // $formPenawaranHarga->neraca =json_encode([]);
            // $formPenawaranHarga->data_pengalaman = json_encode([]);

            $formPenawaranHarga->file_tandatangan = null;
            $formPenawaranHarga->no_unik_ttd = null;
            $formPenawaranHarga->tanggal_tandatangan = null;
            $formPenawaranHarga->save();

            return $formPenawaranHarga;
        }
    }
    public function create($id)
    {
        $penawaran = json_decode($this->refresh($id)->neraca);
        // dd($penawaran);
        $data = [
            'id' => $id,
            'tanggal_neraca' => $penawaran->tanggal_neraca, // Contoh: 10-05-2023
            'aktiva_lancar' =>  $penawaran->aktiva_lancar,
            'utang_jangka_pendek' =>  $penawaran->utang_jangka_pendek,
            'kas' =>  $penawaran->kas,
            'utang_dagang' =>  $penawaran->utang_dagang,
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

        $id_penawaran = $this->refresh($id)->id;
        $penawaran = FormPenawaranHarga::find($id_penawaran);


        $penawaran->neraca = json_encode($validatedData);
        $penawaran->save();

        return redirect()->route('vendor.kontrakkerja.detail', $id);
    }

    public function halamanttd($id)
    {
        // Implementasi logika untuk halaman tanda tangan data pengalaman
    }

    public function simpanttd(Request $request, $id)
    {
        // Implementasi logika penyimpanan tanda tangan data pengalaman
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
