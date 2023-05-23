<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class FormPenawaranHargaController extends Controller
{
    public function index()
    {
        return view('vendor.form_penawaran.formpenharga.index');
    }
    public function create()
    {
        return view('vendor.form_penawaran.formpenharga.create');
    }


    public function store(Request $request)
    {
        // Mendapatkan data dari request
        $data = [
            'nomor1' => $request->input('nomor1'),
            'nomor2' => $request->input('nomor2'),
            'nama' => $request->input('nama'),
            'jabatan' => $request->input('jabatan'),
            'perusahaan' => $request->input('perusahaan'),
            'atas_nama' => $request->input('atas_nama'),
            'alamat' => $request->input('alamat'),
            'telepon_fax' => $request->input('telepon_fax'),
            'email' => $request->input('email'),
            'rks_nomor' => $request->input('rks_nomor'),
            'rks_tanggal' => $request->input('rks_tanggal'),
            'harga_penawaran' => $request->input('harga_penawaran')
        ];

        // Mengubah data menjadi format JSON
        $jsonData = json_encode($data);

        // Menyimpan data ke dalam file formpenawaran.json
        $filePath = public_path('formpenawaran.json');
        file_put_contents($filePath, $jsonData);

        // Lakukan operasi lain sesuai kebutuhan

        // return redirect()->route('vendor.kontrakkerja.detail', ['id' => $id]);
        return redirect()->route('vendor.kontrakkerja.detail', ['id' => 12]);
        
    }


    public function halamanttd()
    {
        return view('vendor.form_penawaran.formpenharga.halamanttd');
    }


    public function simpanttd(Request $request)
    {
        // Logika menyimpan tanda tangan

        return redirect()->route('vendor.formpenawaranharga.index');
    }

    public function pdf()
    {
        $pdf = PDF::loadView('vendor.form_penawaran.formpenharga.pdf');
        return $pdf->stream('form_penawaran.pdf');
    }
}
