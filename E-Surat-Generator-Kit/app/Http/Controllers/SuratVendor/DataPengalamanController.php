<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use App\Models\FormPenawaran\FormPenawaranHarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class DataPengalamanController extends Controller
{
    private function refresh($id)
    {
        // Cek apakah terdapat data penawaran dengan id_kontrakkerja yang sesuai
        $formPenawaranHarga = FormPenawaranHarga::where('id_kontrakkerja', $id)->first();
        if ($formPenawaranHarga) {
            // Jika ada data penawaran, kembalikan data form penawaran
            if ($formPenawaranHarga->data_pengalaman == null) {
                $formPenawaranHarga1 = FormPenawaranHarga::find($formPenawaranHarga->id);

                $formPenawaranHarga1->data_pengalaman = json_encode([
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
    public function index()
    {
        // Membaca data dari file JSON
        $datapengalaman = $this->getDataPengalaman();

       
        return view('vendor.form_penawaran.datapengalaman.index', compact('datapengalaman'));
    }

    public function create()
    {
        return view('vendor.form_penawaran.datapengalaman.create');
    }

    public function store(Request $request, $id)
    {
        // Mendapatkan data yang dikirimkan melalui form
        $data = $request->all();

        // Menambahkan data baru ke dalam array
        $datapengalaman = $this->getDataPengalaman();
        $datapengalaman[] = $data;

        // Menyimpan data ke file JSON
        $this->saveDataPengalaman($datapengalaman);

        return redirect()->route('vendor.datapengalaman.index')->with('success', 'Data pengalaman perusahaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Mendapatkan data pengalaman perusahaan berdasarkan ID
        $datapengalaman = $this->getDataPengalaman();

        if (isset($datapengalaman[$id])) {
            $data = $datapengalaman[$id];
            return view('datapengalaman.edit', compact('id', 'data'));
        }

        return redirect()->route('vendor.datapengalaman.index')->with('error', 'Data pengalaman perusahaan tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        // Mendapatkan data yang dikirimkan melalui form
        $data = $request->all();

        // Mendapatkan data pengalaman perusahaan
        $datapengalaman = $this->getDataPengalaman();

        if (isset($datapengalaman[$id])) {
            // Mengganti data yang ada dengan data yang baru
            $datapengalaman[$id] = $data;

            // Menyimpan data ke file JSON
            $this->saveDataPengalaman($datapengalaman);

            return redirect()->route('vendor.datapengalaman.index')->with('success', 'Data pengalaman perusahaan berhasil diperbarui.');
        }

        return redirect()->route('vendor.datapengalaman.index')->with('error', 'Data pengalaman perusahaan tidak ditemukan.');
    }

    public function destroy($id)
    {
        // Mendapatkan data pengalaman perusahaan
        $datapengalaman = $this->getDataPengalaman();

        if (isset($datapengalaman[$id])) {
            // Menghapus data berdasarkan ID
            unset($datapengalaman[$id]);

            // Menyimpan data ke file JSON
            $this->saveDataPengalaman($datapengalaman);

            return redirect()->route('vendor.datapengalaman.index')->with('success', 'Data pengalaman perusahaan berhasil dihapus.');
        }

        return redirect()->route('vendor.datapengalaman.index')->with('error', 'Data pengalaman perusahaan tidak ditemukan.');
    }

    private function getDataPengalaman()
    {
        $file = Storage::disk('public')->get('datapengalaman.json');
        $datapengalaman = json_decode($file, true) ?? [];

        return $datapengalaman;
    }

    private function saveDataPengalaman($datapengalaman)
    {
        $json = json_encode($datapengalaman);
        Storage::disk('public')->put('datapengalaman.json', $json);
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
