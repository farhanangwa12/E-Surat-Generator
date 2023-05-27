<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PernyataanGaransiController extends Controller
{
    public function index()
    {
        return view('vendor.form_penawaran.pernyataan_garansi');
    }

    public function create()
    {
        return view('vendor.form_penawaran.create');
    }

    public function update(Request $request)
    {
        // Logika update data

        return redirect()->route('pernyataan.garansi.index');
    }

    public function halamanttd()
    {
        return view('vendor.form_penawaran.halamanttd');
    }

    public function simpanttd(Request $request)
    {
        // Logika menyimpan tanda tangan

        return redirect()->route('pernyataan.garansi.index');
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
            'no_rks' => '1234',
            'tanggal_rks' => '2023-05-26',
            'kota_surat' => 'City',
            'tanggal_surat' => '2023-05-26',
        ];

        // Generate the PDF using laravel-dompdf

        $pdf = PDF::loadView('vendor.form_penawaran.pernyataangaransi.pdf', $data);

        // Output the generated PDF to the browser
        return $pdf->stream('pernyataan_garansi.pdf');
    }
}
