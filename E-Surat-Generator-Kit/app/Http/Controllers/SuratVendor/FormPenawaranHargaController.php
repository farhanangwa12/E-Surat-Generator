<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\BarJasBOQ;
use App\Models\Dokumen\BOQ;
use App\Models\DokumenVendor\Formpenawaranharga;
use App\Models\JenisDokumenKelengkapan;
use App\Models\KelengkapanDokumenVendor;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\TandaTangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use Carbon\Carbon;
use DNS2D;
use Illuminate\Support\Facades\Auth;
use Terbilang;

class FormPenawaranHargaController extends Controller
{
    public function refresh($id)
    {


        // Mencari record dengan no_dokumen yang sesuai di tabel jenis_dokumen_kelengkapans
        $jenisDokumen = JenisDokumenKelengkapan::where('no_dokumen', "nomor_tanggal_surat_penawaran_")->with(['kelengkapanDokumenVendors' => function ($query) use ($id) {
            $query->where('id_kontrakkerja', $id);
        }])->first();
        // dd($jenisDokumen);
        if ($jenisDokumen->kelengkapanDokumenVendors->isEmpty()) {


            // Membuat record baru di tabel kelengkapan_dokumen_vendors
            KelengkapanDokumenVendor::create([
                'id_jenis_dokumen' => $jenisDokumen->id_jenis,
                'id_vendor' => Auth::user()->vendor_id,
                'id_kontrakkerja' => $id,
            ])->save();
        }


        $kelengkapan = KelengkapanDokumenVendor::where('id_kontrakkerja', $id)->where('id_jenis_dokumen', $jenisDokumen->id_jenis)->with('formPenawaranHarga')->first();


        if ($kelengkapan->formPenawaranHarga === null) {
            $formpenawaranharga = new Formpenawaranharga();
            $formpenawaranharga->id_dokumen = $kelengkapan->id_dokumen;
            $formpenawaranharga->data_surat = [];
            $formpenawaranharga->save();
        }


        $kelengkapan1 = KelengkapanDokumenVendor::where('id_kontrakkerja', $id)->where('id_jenis_dokumen', $jenisDokumen->id_jenis)->with('formPenawaranHarga')->first();

        $lampiranpenawaran = app(LampiranPenawaranHargaController::class)->refresh($id);


        $formpenawaranharga1 = Formpenawaranharga::where('id_dokumen', $kelengkapan1->id_dokumen)->first();
        $kontrakkerja = KontrakKerja::with('vendor')->find($id)->first();

        if (isset($lampiranpenawaran)) {
            $formpenawaranharga = Formpenawaranharga::find($formpenawaranharga1->id);
            // $formpenawaranharga->nama_vendor = $kontrakkerja->vendor->direktur;
            // $formpenawaranharga->nama_perusahaan = $kontrakkerja->vendor->penyedia;
            // $formpenawaranharga->jabatan = "Direktur";
            // $formpenawaranharga->email_perusahaan =  $kontrakkerja->vendor->email_perusahaan;
            // $formpenawaranharga->telepon_fax = $kontrakkerja->vendor->telepon . "/" . $kontrakkerja->vendor->faximile;
            $formpenawaranharga->harga_penawaran = $lampiranpenawaran->dibulatkan;
            $formpenawaranharga->ppn11 = $lampiranpenawaran->ppn11;
            $formpenawaranharga->jumlah_harga = $lampiranpenawaran->total_harga;
            $formpenawaranharga->save();
        }
     
        return $formpenawaranharga1;
    }

    public function create($id)
    {
        // Mengambil path file JSON dari database berdasarkan ID
        $formPenawaranHarga = $this->refresh($id);

        // Mengubah JSON menjadi array asosiatif
        $data = $formPenawaranHarga;
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
        // Mendapatkan data gambar dari permintaan

        // Mengambil data dari form

        $nomor = $request->input('nomor');
        $lampiran = $request->input('lampiran');
        $nama_kota = $request->input('nama_kota');
        $tanggal_pembuatan_surat = $request->input('tanggal_pembuatan_surat');
        // $nama_vendor = $request->input('nama_vendor');
        // $jabatan = $request->input('jabatan');
        // $nama_perusahaan = $request->input('nama_perusahaan');
        // $atas_nama = $request->input('atas_nama');
        // $alamat_perusahaan = $request->input('alamat_perusahaan');
        // $telepon_fax = $request->input('telepon_fax');
        // $email_perusahaan = $request->input('email_perusahaan');
        // $harga_penawaran = $request->input('harga_penawaran');
        // $ppn11 = $request->input('ppn11');
        // $jumlah_harga = $request->input('jumlah_harga');
        // $terbilang = $request->input('terbilang');
        // $kontrakkerja = KontrakKerja::where('id_kontrakkerja', $id)->with('vendor')->first();
        // $nama_vendor = $kontrakkerja->vendor->direktur;
        // $jabatan = "Direktur";
        // $nama_perusahaan = $kontrakkerja->vendor->penyedia;
        // // $atas_nama = $request->input('atas_nama');
        // $atas_nama = "Atas Nama";
        // $alamat_perusahaan = $kontrakkerja->vendor->alamat_jalan . ' , ' . $kontrakkerja->vendor->alamat_kota . ' , ' . $kontrakkerja->vendor->alamat_provinsi;
        // $telepon_fax = $kontrakkerja->vendor->telepon_fax;
        // $email_perusahaan = $kontrakkerja->vendor->email_perusahaan;

        // $boq = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat','nomor_rks')->with('b_o_q_s.barjas_b_o_q_s')->first();
        // dd($boq);
        // $boq = BOQ::where('id_kontrakkerja', $id)->with('barJasBOQs')->first();
        // $total_jumlah = 0;
        // foreach ($boq->barJasBOQs as $bboq) {
        //     $databarjasBOQ = BarJasBOQ::where('id_boq', $bboq['id_boq'])->where('id_barjas', $bboq['id_barjas'])->first();

        //     $total_jumlah +=  str_replace(".", "", $databarjasBOQ->jumlah);
        // }

        $boq = BOQ::where('id_kontrakkerja', $id)->first();

        $harga_penawaran = $boq->jumlah_harga;
        $ppn11 = $boq->ppn11;
        $jumlah_harga = $boq->total_harga;
        // $terbilang = "Dua Ribu Rupiah";




        // $kelengkapandokumen = $this->refresh($id);


        $data = [];
        // Mengupdate nilai-nilai dalam array $data sesuai dengan data yang diberikan
        $data['nomor'] = $nomor;
        $data['lampiran'] = $lampiran;
        $data['nama_kota'] = $nama_kota;
        $data['tanggal_pembuatan_surat'] = $tanggal_pembuatan_surat;
        // $data['nama_vendor'] = $nama_vendor;
        // $data['jabatan'] = $jabatan;
        // $data['nama_perusahaan'] = $nama_perusahaan;
        // $data['atas_nama'] = $atas_nama;
        // $data['alamat_perusahaan'] = $alamat_perusahaan;
        // $data['telepon_fax'] = $telepon_fax;

        // $data['email_perusahaan'] = $email_perusahaan;
        $data['harga_penawaran'] = $harga_penawaran;
        $data['ppn11'] = $ppn11;
        $data['jumlah_harga'] = $jumlah_harga;
        // $data['terbilang'] = $terbilang;
        

        $formrefresh = $this->refresh($id);
        $formpenawaranharga = Formpenawaranharga::find($formrefresh->id);
        // Bagian menyimpan file 
        if ($request->hasFile('kopsurat')) {
            $file = $request->file('kopsurat');
            $extension = $file->extension(); // Mendapatkan ekstensi file


            $dataURL = $request->input('hasilkopsurat');

            // Mengubah data URL menjadi file gambar
            $fileData = explode(',', $dataURL)[1];
            $decodedData = base64_decode($fileData);

            // Menyimpan file gambar ke storage/app/public/dokumenvendor/kopsurat
            $filename = uniqid() . '_' . date('Ymd') . '.' . $extension;
            $path = 'dokumenvendor/kopsurat/' . $filename;
            Storage::disk('public')->put($path, $decodedData);
            $formpenawaranharga->kopsurat = $filename;
        }
        // Mengubah array menjadi JSON

        $formpenawaranharga->nomor = $data['nomor'];
        $formpenawaranharga->lampiran = $data['lampiran'];
        $formpenawaranharga->nama_kota = $data['nama_kota'];
        $formpenawaranharga->tanggal_pembuatan_surat = $data['tanggal_pembuatan_surat'];
        // $formpenawaranharga->nama_vendor = $data['nama_vendor'];
        // $formpenawaranharga->jabatan = $data['jabatan'];
        // $formpenawaranharga->nama_perusahaan = $data['nama_perusahaan'];
        // $formpenawaranharga->nama_vendor = $data['atas_nama'];
        // $formpenawaranharga->alamat_perusahaan = $data['alamat_perusahaan'];
        // $formpenawaranharga->telepon_fax = $data['telepon_fax'];
        // $formpenawaranharga->email_perusahaan = $data['email_perusahaan'];
        $formpenawaranharga->harga_penawaran = $data['harga_penawaran'];
        $formpenawaranharga->ppn11 = $data['ppn11'];
        $formpenawaranharga->jumlah_harga = $data['jumlah_harga'];
        // $formpenawaranharga->terbilang = $data['terbilang'];


        $formpenawaranharga->save();


        // Redirect ke route 'vendor.kontrakkerja.detail' dengan ID yang sesuai
        return redirect()->route('vendor.kontrakkerja.detail', ['id' => $id]);
    }

    public function halamanttd($id)
    {

        return view('vendor.form_penawaran.formpenharga.halamanttd', compact('id'));
    }

    public function simpanttd(Request $request)
    {
        // Mengambil path file JSON dari database berdasarkan ID

        $formPenawaranHarga = $this->refresh($request->input('id'));


        $kelengkapan = KelengkapanDokumenVendor::find($formPenawaranHarga->id_dokumen);


        // Menyimpan file tanda tangan ke storage
        $file = $request->file('file_tandatangan');

        // Generate the new filename using time(), original name, and extension
        $filename = time() . '_' . $file->getClientOriginalName();

        // Store the file with the new filename
        $filePath = $file->storeAs('public/dokumenvendor', $filename);
        $id_kontrakkerja = $request->input('id');


        // Update kolom file_tandatangan, no_unik_ttd, dan tanggal_tandatangan
        $kelengkapandokumen = KelengkapanDokumenVendor::find($kelengkapan->id_dokumen);

        $kelengkapandokumen->file_upload = $filename;
        $kelengkapandokumen->tandatangan = TandaTangan::where('id', Auth::user()->id)->first()->kode_unik;
        $kelengkapandokumen->save();

        return redirect()->route('vendor.kontrakkerja.detail', ['id' => $id_kontrakkerja]);
    }

    public function pdf($id, $jenis)
    {
        // Mengambil path file JSON dari database berdasarkan ID
        $data =  $this->refresh($id);
   

        $kopsurat = asset('/storage/' . $data->kopsuratpath . '/' . $data->kopsurat);

        // Load data dari kontrakkerja 
        $kontrakKerja = KontrakKerja::find($id)->with('vendor')->first();


        $nomor = $data->nomor;
        $lampiran = $data->lampiran;
        $tanggalPengadaan = $data->tanggal_pembuatan_surat;


        $date = Carbon::parse($tanggalPengadaan)->locale('id')->isoFormat('D MMMM Y');
        $localizedDate = $data->nama_kota . ', ' . $date;

        $tanggal = $localizedDate;
        $namaPerusahaan = "PT PLN (PERSERO) UPK TIMOR";
        $alamatPerusahaan = "JL. DIPONEGORO KUANINO - KUPANG";
        $nama = $kontrakKerja->vendor->direktur;
        $jabatan = "Direktur";
        $vendorperusahaan = $kontrakKerja->vendor->penyedia;
        $atasNama = $kontrakKerja->vendor->penyedia;
        $alamat = $kontrakKerja->vendor->alamat_jalan . ' , ' . $kontrakKerja->vendor->alamat_kota . ' , ' . $kontrakKerja->vendor->alamat_provinsi;;
        $telepon = $kontrakKerja->vendor->telepon .'/' . $kontrakKerja->vendor->faksimili;
        $email = $kontrakKerja->vendor->email_perusahaan;


        $pekerjaan = $kontrakKerja->nama_kontrak . " PT. PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR";
        $hargaPenawaran = $data->harga_penawaran;
        $ppn = $data->ppn11;
        $jumlahHarga = $data->jumlah_harga;

        $startDate = Carbon::parse($kontrakKerja->tanggal_pekerjaan);
        $endDate = Carbon::parse($kontrakKerja->tanggal_akhir_pekerjaan);
        $jumlahHari = $startDate->diffInDays($endDate);
        $waktuPelaksanaan = $kontrakKerja->nama_kontrak . " PT. PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR" . " adalah " . $jumlahHari . " ( " . ucfirst(Terbilang::make($jumlahHari)) . " ) " . " terhitung sejak tanggal Surat Perintah Kerja (SPK) ditandatangani oleh Pengguna Barang/jasa PT. PLN (Persero) UIW Nusa Tenggara Timur UPK Timor";

        $data = [
            'kopsurat' => $kopsurat,
            // 'kopsurat' => "test",

            'nomor' => $nomor,
            'lampiran' => $lampiran,
            'tanggal' => $tanggal,
            'namaPerusahaan' => $namaPerusahaan,
            'alamatPerusahaan' => $alamatPerusahaan,
            'nama' => $nama,
            'jabatan' => $jabatan,
            'vendorperusahaan' =>  $vendorperusahaan,
            'atasNama' => $atasNama,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'email' => $email,
            'pekerjaan' => $pekerjaan,
            'hargaPenawaran' => $hargaPenawaran,
            'ppn' => $ppn,
            'jumlahHarga' => $jumlahHarga,
            'terbilang' =>  ucwords(Terbilang::make(str_replace('.', '', $jumlahHarga), " Rupiah")),
            'waktuPelaksanaan' => $waktuPelaksanaan,

            'tanggalPengadaan' => $tanggalPengadaan,

        ];

        // Generate QR code
        // $barcode = !empty($tandatangan) ? DNS2D::getBarcodeHTML($tandatangan, 'QRCODE', 4, 4) : ' Materai Rp. 10.000,- <br> Tanda Tangan Dan Cap Perusahaan';
        // $data['barcode'] = $barcode;

        $pdf = PDF::loadView('vendor.form_penawaran.formpenharga.pdf', $data);

        $namefile = 'FORM_PENAWARAN' . time() . '.pdf';
        // dd($jenis);
        if ($jenis == 1) {
         
            // Menampilkan output di browser
            return $pdf->stream($namefile);
        } else if ($jenis == 2) {
        

            // Download file
            return $pdf->download($namefile);
        } else {
            return "Parameter tidak valid";
        }
        // if ($jenis == 1) {
        //     // Menampilkan output di browser
        //     return $pdf->stream($namefile);
        // } else if ($jenis == 2) {
        //     // Download file
        //     return $pdf->download($namefile);
        // } else {
        //     return "Parameter tidak valid";
        // }
    }
}
