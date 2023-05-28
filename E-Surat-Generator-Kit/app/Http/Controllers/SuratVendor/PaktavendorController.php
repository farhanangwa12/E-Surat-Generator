<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use App\Models\FormPenawaran\FormPenawaranHarga;
use Illuminate\Http\Request;
use PDF;

class PaktavendorController extends Controller
{
    public function refresh($id)
    {
        // Cek apakah terdapat data penawaran dengan id_kontrakkerja yang sesuai
        $formPenawaranHarga = FormPenawaranHarga::where('id_kontrakkerja', $id)->first();

        if ($formPenawaranHarga) {
            // Jika ada data penawaran, kembalikan data form penawaran
            if ($formPenawaranHarga->data_paktavendor == null) {
                $formPenawaranHarga1 = FormPenawaranHarga::find($formPenawaranHarga->id);

                $formPenawaranHarga1->data_paktavendor = json_encode([
                    'pekerjaan' => null,
                    'tahun_anggaran' => null,
                    'nama' =>  null,
                    'jabatan' => null,
                    'nama_perusahaan' => null,
                    'atas_nama' => null,
                    'alamat' => null,
                    'telepon_fax' => null,
                    'email_perusahaan' => null
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
            $formPenawaranHarga->id_vendor = null;
            $formPenawaranHarga->kopsurat = null;
            $formPenawaranHarga->file_path = null;
            $formPenawaranHarga->data_paktavendor = null;
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
    public function create($id)
    {
        $penawaran = json_decode($this->refresh($id)->data_paktavendor);
        // dd($penawaran);
        $data = [
            'id' => $id,
            'kopsurat' => 'path/to/kopsurat.jpg',
            'nama_pekerjaan' => "Pekerjaan",
            'nomor' => '1234',
            'lampiran' => 'Lorem Ipsum',
            'tanggal' => '2023-05-26',
            'namaPerusahaan' => 'Example Company',
            'alamatPerusahaan' => '123 Example Street, City',
            'pekerjaan' => $penawaran->pekerjaan,
            'tahun_anggaran' => $penawaran->tahun_anggaran,
            'nama' =>  $penawaran->nama,
            'jabatan' => $penawaran->jabatan,
            'nama_perusahaan' => $penawaran->bertindak_untuk,
            'atas_nama' => $penawaran->atas_nama,
            'alamat' => $penawaran->alamat,
            'telepon_fax' => $penawaran->telepon_fax,
            'email_perusahaan' => $penawaran->email,
            'kota' => 'City',
            'tanggal_surat' => '2023-05-26',
            'namaterang' => 'Example Terang',
        ];
        return view('vendor.form_penawaran.paktavendor.create', $data);
    }

    public function update(Request $request, $id)
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
        $id_penawaran = $this->refresh($id)->id;
        $penawaran = FormPenawaranHarga::find($id_penawaran);

        
        $penawaran->data_paktavendor = json_encode($validatedData);
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

        return redirect()->route('paktavendor.index');
    }

    public function pdf($id)
    {
        $penawaran = json_decode($this->refresh($id)->data_paktavendor);

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
            'nama' =>  $penawaran->nama,
            'jabatan' => $penawaran->jabatan,
            'nama_perusahaan' => $penawaran->bertindak_untuk,
            'atas_nama' => $penawaran->atas_nama,
            'alamat' => $penawaran->alamat,
            'telepon_fax' => $penawaran->telepon_fax,
            'email_perusahaan' => $penawaran->email,
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
