<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use App\Models\FormPenawaran\FormPenawaranHarga;
use App\Models\KontrakKerja;
use Illuminate\Http\Request;
use PDF;

class PernyataanGaransiController extends Controller
{
    public function refresh($id)
    {
        // Cek apakah terdapat data penawaran dengan id_kontrakkerja yang sesuai
        $formPenawaranHarga = FormPenawaranHarga::where('id_kontrakkerja', $id)->first();

        if ($formPenawaranHarga) {
            // Jika ada data penawaran, kembalikan data form penawaran
            return $formPenawaranHarga;
        } else {
            // Jika tidak ada data penawaran, generate form penawaran dengan array JSON kosong
            $formPenawaranHarga = new FormPenawaranHarga();
            $formPenawaranHarga->id_kontrakkerja = $id;
            $formPenawaranHarga->id_vendor = null;
            $formPenawaranHarga->kopsurat = null;
            $formPenawaranHarga->file_path = null;
            $formPenawaranHarga->data_paktavendor = [];
            $formPenawaranHarga->data_lamp_nego = [];
            $formPenawaranHarga->data_pernyataan_kesanggupan = [];
            $formPenawaranHarga->data_pernyataan_garansi = [];
            $formPenawaranHarga->neraca = [];
            $formPenawaranHarga->data_pengalaman = [];
            $formPenawaranHarga->file_tandatangan = null;
            $formPenawaranHarga->no_unik_ttd = null;
            $formPenawaranHarga->tanggal_tandatangan = null;
            $formPenawaranHarga->save();

            return $formPenawaranHarga;
        }
    }
    public function index($id)
    {
        return view('vendor.form_penawaran.pernyataan_garansi');
    }

    public function create($id)
    {
        $penawaran = json_decode($this->refresh($id)->data_pernyataan_kesanggupan);
      
        $data = [
            'nama' => $penawaran->nama,
            'jabatan' => $penawaran->jabatan,
            'nama_perusahaan' =>  $penawaran->bertindak_untuk,
            'atas_nama' =>  $penawaran->atas_nama,
            'alamat_perusahaan' =>  $penawaran->alamat,
            'telepon_fax' =>  $penawaran->telepon_fax,
            'email_perusahaan' =>  $penawaran->email,
            'nama_pekerjaan' => strtoupper(KontrakKerja::find($id)->nama_kontrak),
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


        $id_penawaran = $this->refresh($id)->id;
        $penawaran = FormPenawaranHarga::find($id_penawaran);
        $penawaran->data_pernyataan_garansi = json_encode($validatedData);
        $penawaran->save();
        return redirect()->route('vendor.kontrakkerja.detail', $id);
    }

    public function halamanttd($id)
    {
        return view('vendor.form_penawaran.halamanttd');
    }

    public function simpanttd(Request $request, $id)
    {
        // Logika menyimpan tanda tangan

        return redirect()->route('pernyataan.garansi.index');
    }
    public function pdf($id)
    {
        $penawaran = json_decode($this->refresh($id)->data_pernyataan_garansi);
    
        $data = [
            'nama' => $penawaran->nama,
            'jabatan' => $penawaran->jabatan,
            'nama_perusahaan' =>  $penawaran->bertindak_untuk,
            'atas_nama' =>  $penawaran->atas_nama,
            'alamat_perusahaan' =>  $penawaran->alamat,
            'telepon_fax' =>  $penawaran->telepon_fax,
            'email_perusahaan' =>  $penawaran->email,
            'nama_pekerjaan' => strtoupper(KontrakKerja::find($id)->nama_kontrak),
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
