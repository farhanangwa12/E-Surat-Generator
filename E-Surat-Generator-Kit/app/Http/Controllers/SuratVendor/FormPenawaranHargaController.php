<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use App\Models\FormPenawaran\FormPenawaranHarga;
use App\Models\KontrakKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use Carbon\Carbon;
use DNS2D;
use Terbilang;

class FormPenawaranHargaController extends Controller
{
    private function refresh($id)
    {
        // Mengambil data KontrakKerja dengan id_kontrakkerja = $id
        $kontrakKerja = KontrakKerja::where('id_kontrakkerja', $id)->first();

        // Mengambil data FormPenawaranHarga dengan id_kontrakkerja = $id
        $formPenawaranHarga = FormPenawaranHarga::where('id_kontrakkerja', $id)->first();


        // Jika data tidak ditemukan, membuat data baru dengan nilai-nilai null
        if (!$formPenawaranHarga) {
            // Simpan file JSON dengan data inputan
            $data = [
                'nomor' => null,
                'lampiran' => null,
                'nama_kota' => null,
                'tanggal_pembuatan_surat' => null,
                'nama_vendor' => null,
                'jabatan' => null,
                'nama_perusahaan' => null,
                'atas_nama' => null,
                'alamat_perusahaan' => null,
                'telepon_fax' => null,
                'email_perusahaan' => null,
                'harga_penawaran' => null,
                'ppn11' => null,
                'jumlah_harga' => null,
                'terbilang' => null
            ];



            $jsonData = json_encode($data);


            // simpan JSON ke dalam file dengan nama time().json
            $fileName =  "datavendor/formpenawaran/" . time() . '.json';
            Storage::put('public/' . $fileName, $jsonData);

            // Membuat instance form untuk menyimpan data
            $formPenawaranHarga = new FormPenawaranHarga();
            $formPenawaranHarga->id_kontrakkerja = $id;
            $formPenawaranHarga->id_vendor = $kontrakKerja->id_vendor;
            $formPenawaranHarga->kopsurat = null;
            $formPenawaranHarga->file_path = $fileName;
            $formPenawaranHarga->file_tandatangan = null;
            $formPenawaranHarga->no_unik_ttd = null;
            $formPenawaranHarga->tanggal_tandatangan = null;
            // Setel nilai atribut lainnya sesuai kebutuhan

            $formPenawaranHarga->save();
        }

        return $formPenawaranHarga;
    }

    public function create($id)
    {
        // Mengambil path file JSON dari database berdasarkan ID
        $formPenawaranHarga = $this->refresh($id);
        $filePath = 'public/' . $formPenawaranHarga->file_path;

        // Mengambil konten JSON dari file
        $jsonData = Storage::get($filePath);

        // Mengubah JSON menjadi array asosiatif
        $data = json_decode($jsonData, true);
        $kontrakkerja = Kontrakkerja::find($id);
        $namaPerusahaan = "PT PLN (PERSERO) UPK TIMOR";
        $alamatPerusahaan = "JL. DIPONEGORO KUANINO - KUPANG";

        $startDate = Carbon::parse($kontrakkerja->tanggal_pekerjaan);
        $endDate = Carbon::parse($kontrakkerja->tanggal_akhir_pekerjaan);
        $jumlahHari = $startDate->diffInDays($endDate);
        $waktuPelaksanaan = $kontrakkerja->nama_kontrak . " PT. PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR" . " adalah " . $jumlahHari . " (" . ucfirst(Terbilang::make($jumlahHari)) . ") " . "terhitung sejak tanggal Surat Perintah Kerja (SPK) ditandatangani oleh Pengguna Barang/jasa PT. PLN (Persero) UIW Nusa Tenggara Timur UPK Timor";
        $isi = [
            'namaPerusahaan' => $namaPerusahaan,
            'alamatPerusahaan' => $alamatPerusahaan,
            'kontrakkerja' => $kontrakkerja,
            'waktuPelaksanaan' => $waktuPelaksanaan
        ];
        $isi = json_decode(json_encode($isi));
      
        // Mengirim data ke tampilan
        return view('vendor.form_penawaran.formpenharga.create', compact('formPenawaranHarga', 'data', 'isi'));
    }

    public function store(Request $request, $id)
    {
        // Menyimpan file kopsurat
        // $kopsurat = $request->file('kopsurat');
        // Lakukan penyimpanan file kopsurat sesuai kebutuhan

        // Mengambil data dari form
        $nomor = $request->input('nomor');
        $lampiran = $request->input('lampiran');
        $nama_kota = $request->input('nama_kota');
        $tanggal_pembuatan_surat = $request->input('tanggal_pembuatan_surat');
        $nama_vendor = $request->input('nama_vendor');
        $jabatan = $request->input('jabatan');
        $nama_perusahaan = $request->input('nama_perusahaan');
        $atas_nama = $request->input('atas_nama');
        $alamat_perusahaan = $request->input('alamat_perusahaan');
        $telepon_fax = $request->input('telepon_fax');
        $email_perusahaan = $request->input('email_perusahaan');
        $harga_penawaran = $request->input('harga_penawaran');
        $ppn11 = $request->input('ppn11');
        $jumlah_harga = $request->input('jumlah_harga');
        $terbilang = $request->input('terbilang');
       


        // Simpan nama file dan data lainnya ke database
        $formPenawaranHarga = $this->refresh($id);
        $filePath = 'public/' . $formPenawaranHarga->file_path; // Ganti 'fileName' dengan nama file yang ingin Anda muat
        $jsonData = Storage::get($filePath);
        $data = json_decode($jsonData, true); // Mengubah JSON menjadi array asosiatif (associative array)
        // Mengupdate nilai-nilai dalam array $data sesuai dengan data yang diberikan
        $data['nomor'] = $nomor;
        $data['lampiran'] = $lampiran;
        $data['nama_kota'] = $nama_kota;
        $data['tanggal_pembuatan_surat'] = $tanggal_pembuatan_surat;
        $data['nama_vendor'] = $nama_vendor;
        $data['jabatan'] = $jabatan;
        $data['nama_perusahaan'] = $nama_perusahaan;
        $data['atas_nama'] = $atas_nama;
        $data['alamat_perusahaan'] = $alamat_perusahaan;
        $data['telepon_fax'] = $telepon_fax;
    
        $data['email_perusahaan'] = $email_perusahaan;
        $data['harga_penawaran'] = $harga_penawaran;
        $data['ppn11'] = $ppn11;
        $data['jumlah_harga'] = $jumlah_harga;
        $data['terbilang'] = $terbilang;

        // Mengubah array menjadi JSON
        $jsonData = json_encode($data);


        // Memeriksa apakah file JSON sudah ada
        if (Storage::exists($filePath)) {
            // Jika file sudah ada, lakukan pengupdatean seperti yang sudah dijelaskan sebelumnya
            // ...

            // Simpan file JSON dengan data yang diupdate
            $jsonData = json_encode($data);
            Storage::put($filePath, $jsonData);
        } else {
            // Jika file belum ada, buat file baru dengan data yang diberikan
            $jsonData = json_encode($data);
            Storage::put($filePath, $jsonData);
        }

        // Bagian menyimpan file 
        if ($request->hasFile('kopsurat')) {
            $file = $request->file('kopsurat');

            // Buat nama file yang unik dengan menggunakan time(), uniqid(), dan original file name beserta ekstensinya
            $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

            // Simpan file ke direktori yang ditentukan
            $filePath = $file->storeAs('datavendor/kopsurat', $fileName, 'public');

            // Simpan path file ke dalam database

            $formPenawaranHarga->kopsurat = $filePath;
        }

        $formPenawaranHarga->save();

        // Redirect ke route 'vendor.kontrakkerja.detail' dengan ID yang sesuai
        return redirect()->route('vendor.kontrakkerja.detail', ['id' => $id]);
    }

    public function halamanttd($id)
    {
        $formPenawaranHarga = $this->refresh($id);
        return view('vendor.form_penawaran.formpenharga.halamanttd', compact('formPenawaranHarga'));
    }

    public function simpanttd(Request $request)
    {
        // Menyimpan file tanda tangan ke storage
        $file = $request->file('file_tandatangan');

        // Generate the new filename using time(), original name, and extension
        $filename = time() . '_' . $file->getClientOriginalName();

        // Store the file with the new filename
        $filePath = $file->storeAs('public/dokumenvendor', $filename);
        $id_kontrakkerja = $request->input('id');


        // Mendapatkan atau membuat data FormPenawaranHarga dengan $id_kontrakkerja
        $formPenawaranHarga = $this->refresh($id_kontrakkerja);

        // Update kolom file_tandatangan, no_unik_ttd, dan tanggal_tandatangan
        $formPenawaranHarga->id_kontrakkerja = $id_kontrakkerja;
        $formPenawaranHarga->file_tandatangan = $filePath;
        $formPenawaranHarga->no_unik_ttd = uniqid();
        $formPenawaranHarga->tanggal_tandatangan = now(); // Memasukkan waktu sekarang

        $formPenawaranHarga->save();
        return redirect()->route('vendor.kontrakkerja.detail', ['id' => $id_kontrakkerja]);
    }

    public function pdf($id)
    {
        $formPenawaranHarga = $this->refresh($id);
        $kopsurat = empty($formPenawaranHarga->kopsurat) ? null : asset('storage/' . $formPenawaranHarga->kopsurat);
        // Meload File Path
        $filePath = 'public/' . $formPenawaranHarga->file_path; // Ganti 'fileName' dengan nama file yang ingin Anda muat
        $jsonData = Storage::get($filePath);
        $data = json_decode($jsonData, true); // Mengubah JSON menjadi array 

        // Load data dari kontrakkerja 
        $kontrakKerja = KontrakKerja::find($id);


        $nomor = $data['nomor'];
        $lampiran = $data['lampiran'];
        $tanggalPengadaan = $data['tanggal_pembuatan_surat'];
        $tandatangan = $formPenawaranHarga->file_uniq;

        $date = Carbon::parse($tanggalPengadaan)->locale('id')->isoFormat('D MMMM Y');
        $localizedDate = $data['nama_kota'] . ', ' . $date;

        $tanggal = $localizedDate;
        $namaPerusahaan = "PT PLN (PERSERO) UPK TIMOR";
        $alamatPerusahaan = "JL. DIPONEGORO KUANINO - KUPANG";
        $nama = $data['nama_vendor'];
        $jabatan = $data['nama_vendor'];
        $atasNama = $data['atas_nama'];
        $alamat = $data['alamat_perusahaan'];
        $telepon = $data['telepon_fax'];
        $email = $data['email_perusahaan'];


        $pekerjaan = $kontrakKerja->nama_kontrak . " PT. PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR";
        $hargaPenawaran = $data['harga_penawaran'];
        $ppn = $data['ppn11'];
        $jumlahHarga = $data['jumlah_harga'];
        $terbilang = $data['terbilang'];

        $startDate = Carbon::parse($kontrakKerja->tanggal_pekerjaan);
        $endDate = Carbon::parse($kontrakKerja->tanggal_akhir_pekerjaan);
        $jumlahHari = $startDate->diffInDays($endDate);
        $waktuPelaksanaan = $kontrakKerja->nama_kontrak . " PT. PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR" . "adalah" . $jumlahHari . "(" . ucfirst(Terbilang::make($jumlahHari)) . ")" . "terhitung sejak tanggal Surat Perintah Kerja (SPK) ditandatangani oleh Pengguna Barang/jasa PT. PLN (Persero) UIW Nusa Tenggara Timur UPK Timor";


        $data = [
            'kopsurat' => $kopsurat,
            'nomor' => $nomor,
            'lampiran' => $lampiran,
            'tanggal' => $tanggal,
            'namaPerusahaan' => $namaPerusahaan,
            'alamatPerusahaan' => $alamatPerusahaan,
            'nama' => $nama,
            'jabatan' => $jabatan,
            'atasNama' => $atasNama,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'email' => $email,
            'pekerjaan' => $pekerjaan,
            'hargaPenawaran' => $hargaPenawaran,
            'ppn' => $ppn,
            'jumlahHarga' => $jumlahHarga,
            'terbilang' => $terbilang,
            'waktuPelaksanaan' => $waktuPelaksanaan,

            'tanggalPengadaan' => $tanggalPengadaan,
            'tandatangan' => $tandatangan,
        ];

        // Generate QR code
        $barcode = !empty($tandatangan) ? DNS2D::getBarcodeHTML($tandatangan, 'QRCODE', 4, 4) : ' Materai Rp. 10.000,- <br> Tanda Tangan Dan Cap Perusahaan';
        $data['barcode'] = $barcode;

        $pdf = PDF::loadView('vendor.form_penawaran.formpenharga.pdf', $data);
        return $pdf->stream('form_penawaran.pdf');
    }
}
