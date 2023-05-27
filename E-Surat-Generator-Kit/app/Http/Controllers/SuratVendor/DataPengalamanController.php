<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class DataPengalamanController extends Controller
{
    public function index($id)
    {
        // // Mengambil data pengalaman berdasarkan ID
        // $dataPengalaman = DataPengalaman::where('id', $id)->first();

        // // Mengirim data pengalaman ke view
        // return view('datapengalaman.index', compact('dataPengalaman'));
    }

    public function create($id)
    {
        // Menampilkan form create data pengalaman
        return view('datapengalaman.create', compact('id'));
    }

    public function store(Request $request)
    {
        // // Validasi data yang dikirim dari form
        // $validatedData = $request->validate([
        //     // Tentukan aturan validasi untuk setiap field
        //     // ...
        // ]);

        // // Simpan data pengalaman baru ke database
        // DataPengalaman::create($validatedData);

        // // Redirect ke halaman index atau halaman detail data pengalaman
        // // ...
    }

    public function edit($id)
    {
        // // Mengambil data pengalaman berdasarkan ID
        // $dataPengalaman = DataPengalaman::findOrFail($id);

        // // Menampilkan form edit data pengalaman
        // return view('datapengalaman.edit', compact('dataPengalaman'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            // Tentukan aturan validasi untuk setiap field
            // ...
        ]);

        // // Perbarui data pengalaman di database
        // $dataPengalaman = DataPengalaman::findOrFail($id);
        // $dataPengalaman->update($validatedData);

        // Redirect ke halaman index atau halaman detail data pengalaman
        // ...
    }

    public function destroy($id)
    {
        // // Hapus data pengalaman dari database
        // DataPengalaman::destroy($id);

        // // Redirect ke halaman index atau halaman daftar data pengalaman
        // // ...
    }

    public function halamanttd($id)
    {
        // // Mengambil data pengalaman berdasarkan ID
        // $dataPengalaman = DataPengalaman::where('id', $id)->first();

        // // Menampilkan halaman tanda tangan
        // return view('datapengalaman.halamanttd', compact('dataPengalaman'));
    }

    public function simpanttd(Request $request, $id)
    {
        // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            // Tentukan aturan validasi untuk setiap field
            // ...
        ]);

        // // Simpan tanda tangan ke data pengalaman di database
        // $dataPengalaman = DataPengalaman::findOrFail($id);
        // $dataPengalaman->tanda_tangan = $validatedData['tanda_tangan'];
        // $dataPengalaman->save();

        // Redirect ke halaman index atau halaman detail data pengalaman
        // ...
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


        $pdf = PDF::loadView('vendor.form_penawaran.datapengalaman.pdf', $data);

        // Output the generated PDF to the browser
        return $pdf->stream('pernyataan_sanggup.pdf');
    }
}
