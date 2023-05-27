<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class PaktavendorController extends Controller
{

    public function create($id)
    {
        $data = [
            'id' => $id,
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
        return view('vendor.form_penawaran.paktavendor.create', $data);
    }

    public function update(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'pekerjaan' => 'required',
            'tahun_anggaran' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'bertindak_untuk' => 'required',
            'atas_nama' => 'required',
            'alamat' => 'required',
            'telepon_fax' => 'required',
            'email' => 'required|email',
        ]);
        dd($validatedData);

        return redirect()->route('paktavendor.index');
    }

    public function halamanttd($id)
    {
        return view('vendor.form_penawaran.halamanttd');
    }
    public function simpanttd(Request $request, $id)
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
