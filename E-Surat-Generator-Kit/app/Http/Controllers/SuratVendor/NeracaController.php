<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
class NeracaController extends Controller
{
    public function create($id)
    {
        $data = [

            'id' => $id,
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

        return view('vendor.form_penawaran.neraca.create', $data);

    }

    public function update(Request $request, $id)
    {
         // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            'aktiva_lancar' => 'required|numeric',
            'utang_jangka_pendek' => 'required|numeric',
            'kas' => 'required|numeric',
            'utang_dagang' => 'required|numeric',
            'bank' => 'required|numeric',
            'utang_pajak' => 'required|numeric',
            'piutang' => 'required|numeric',
            'utang_lainnya' => 'required|numeric',
            'persediaan_barang' => 'required|numeric',
            'pekerjaan_dalam_proses' => 'required|numeric',
            'jumlah_a' => 'required|numeric',
            'aktiva_tetap' => 'required|numeric',
            'kekayaan_bersih' => 'required|numeric',
            'peralatan_dan_mesin_1' => 'required|numeric',
            'peralatan_dan_mesin_2' => 'required|numeric',
            'inventaris' => 'required|numeric',
            'gedung_gedung' => 'required|numeric',
            'jumlah_b' => 'required|numeric',
            'jumlah_a_b' => 'required|numeric',
            'jumlah_d' => 'required|numeric',
        ]);

        dd($validatedData);
        // Implementasi logika update data pengalaman
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
