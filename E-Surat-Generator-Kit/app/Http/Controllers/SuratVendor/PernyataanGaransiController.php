<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PernyataanGaransiController extends Controller
{
    public function index($id)
    {
        return view('vendor.form_penawaran.pernyataan_garansi');
    }

    public function create($id)
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
        $data = json_decode(json_encode($data));

        return view('vendor.form_penawaran.pernyataangaransi.create', compact('id', 'data'));
    }

    public function update(Request $request, $id)
    {
         // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'bertindak_untuk' => 'required',
            'atas_nama' => 'required',
            'alamat' => 'required',
            'telepon_fax' => 'required',
            'email' => 'required|email',
        ]);

        dd($validatedData);

        return redirect()->route('pernyataan.garansi.index');
    }

    public function halamanttd($id)
    {
        return view('vendor.form_penawaran.halamanttd');
    }

    public function simpanttd(Request $request,$id)
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
