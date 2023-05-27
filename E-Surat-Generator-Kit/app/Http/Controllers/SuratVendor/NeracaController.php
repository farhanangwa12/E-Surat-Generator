<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
class NeracaController extends Controller
{
    public function create($id)
    {
        // Implementasi logika pembuatan data pengalaman
    }

    public function update(Request $request, $id)
    {
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
