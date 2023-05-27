<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PaktavendorController extends Controller
{
    public function index()
    {
        return view('vendor.form_penawaran.paktavendor');
    }

    public function create()
    {
        return view('vendor.form_penawaran.create');
    }

    public function update(Request $request)
    {
        // Logika update data

        return redirect()->route('paktavendor.index');
    }

    public function halamanttd()
    {
        return view('vendor.form_penawaran.halamanttd');
    }

    public function simpanttd(Request $request)
    {
        // Logika menyimpan tanda tangan

        return redirect()->route('paktavendor.index');
    }

    public function pdf($id)
    {
        $data = [
            'kopsurat' => 'path/to/kopsurat.jpg',
            'nama_pekerjaan' => "manaf",
            'nomor' => '1234',
            'lampiran' => 'Lorem Ipsum',
            'tanggal' => '2023-05-26',
            'namaPerusahaan' => 'Example Company',
            'alamatPerusahaan' => '123 Example Street, City',
            'pekerjaan' => 'Example Job',
            'tahun_anggaran' => '2023',
            'nama' => 'John Doe',
            'jabatan' => 'Manager',
            'nama_perusahaan' => 'Example Company',
            'atas_nama' => 'John Doe',
            'alamat' => '456 Example Avenue, City',
            'telepon_fax' => '555-1234',
            'email_perusahaan' => 'info@example.com',
            'kota' => 'City',
            'tanggal_surat' => '2023-05-26',
            'namaterang' => 'Example Terang',
        ];
        // Generate the PDF using laravel-dompdf
        $pdf = PDF::loadView('vendor.form_penawaran.paktavendor.pdf', $data);

        // Set paper size and orientation
        $pdf->setPaper('letter', 'portrait');
        // Output the generated PDF to the browser
        return $pdf->stream('paktavendor.pdf');
    }
}
