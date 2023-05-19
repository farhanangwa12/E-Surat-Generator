<?php

namespace App\Http\Controllers\pengadaantahap1;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\UND;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use App\PDF\UndanganHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PDF;
use Terbilang;

require_once base_path('vendor/tcpdf/tcpdf.php');


class UndanganController extends Controller
{
     public function refresh($id)
     {

          // Mengecek apakah record und ada
          $und = UND::where('id_kontrakkerja', $id)->first();


          if ($und) {
               // Jika record und ada
               // Lakukan operasi lain yang diinginkan

               $und = UND::find($und->id);
               $und->save();
          } else {
               // Jika record und tidak ada

               // Buat instance und model untuk menyimpan data
               $und = new UND();
   
               $und->tandatangan_pengadaan = null;
               $und->tanggal_tandatanganpengadaan = null;
               $und->id_kontrakkerja = $id;

               // Simpan data und
               $und->save();
          }

          return 'Data Telah Direfresh';
     }
     // Undangan Ada backup
     // Undangan
     public function Undangan($id, $isDownload)
     {
          $this->refresh($id);
        
          $kontrak = KontrakKerja::with('vendor')->find($id);

          $rksnama_pekerjaan = $kontrak->nama_pekerjaan .  "PT PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR";
      
          $masterharitanggal = Carbon::createFromFormat('Y-m-d', '2023-05-19')->locale('id')->isoFormat('dddd / D MMMM YYYY');

          $data = [
               'logokiri' => public_path('undangan/kiri.jpg'),
               'logo' => public_path('undangan/logo.png'), // path ke file header gambar
               // 'tandatangan' =>   DNS2D::getBarcodePNG('4', 'QRCODE'),
               'nomor' => PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'nomor_undangan')->first()->no_surat,
               'tanggal_und' => 'Kupang, ' . Carbon::createFromFormat('Y-m-d', PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'nomor_undangan')->first()->tanggal_pembuatan)->locale('id')->isoFormat('DD MMMM YYYY'),
               'alamat_jalan' => 'Jalan Simpang kepuh No 199 Belum',
               'alamat_kotaprovinsi' => 'Surabaya, Jawa Timur Belum',
               'nama_vendor' => $kontrak->vendor->penyedia,
               'paragraf1' => "Sehubungan dengan rencana $rksnama_pekerjaan, maka dengan ini kami mengundang perusahaan saudara untuk  mengikuti proses Pengadaan Barang/Jasa di lingkungan PT PLN (Persero) Unit Induk Wilayah Nusa Tenggara Timur Unit Pelaksana Pembangkitan Timor melalui metode pengadaan langsung.",
               'paragraf2' => "Terlampir kami sampaikan Rencana Kerja dan Syarat-Syarat (RKS) $rksnama_pekerjaan Pengadaan Barang/Jasa yang dimaksud.",
               'hari_tanggal' => $masterharitanggal,
               'tandatangan_pengadaan' => UND::where('id_kontrakkerja', $id)->first()->tandatangan_pengadaan == null ? 0 : UND::where('id_kontrakkerja', $id)->first()->tandatangan_pengadaan,
               'nama_pengadaan' => Penyelenggara::where('id_kontrakkerja', $kontrak->id_kontrakkerja)->where('nama_jabatan', 'pejabat_pelaksana_pengadaan')->first()->nama_pengguna,
               'footer' => public_path('undangan/footer.png'),



          ];
          $pdf = PDF::loadView('plnpengadaan.kontraktahap1.UND.undangan', compact('data'));
          $pdf->setOption(['isRemoteEnabled' => true]);

          $namefile = 'RKS_' . time() . '.pdf';
          if ($isDownload == 1) {
               // Menampilkan output di browser
               return $pdf->stream($namefile);
          } else if ($isDownload == 2) {
               // Download file
               return $pdf->download($namefile);
          } else {
               return "Parameter tidak valid";
          }
     }
     public function tandatanganpengadaan($id_kontrakkerja)
     {
 
          $this->refresh($id_kontrakkerja);
          $id = $id_kontrakkerja;
          // Logika atau proses yang ingin Anda lakukan dalam metode ini
          return  view('plnpengadaan.kontraktahap1.UND.tandatanganpengadaanund', compact('id'));
     }
     public function simpantandatangan(Request $request)
     {

          $pengadaan = $request->file('pengadaan');

          $id = $request->input('id');
          $this->refresh($id);
          $tandatangan = UND::where('id_kontrakkerja', $id)->first();
         

          // ID Tandatangan HPS

          if ($request->hasFile('pengadaan')) {
               $pengadaan = $request->file('pengadaan');
               $fileName = time() . '_' . $pengadaan->getClientOriginalName();
               $pengadaan->storeAs('public/tandatangan', $fileName);

               // Simpan nama file ke kolom tandatangan_pengadaan dalam model und
               $und = UND::find($tandatangan->id);
               $und->tandatangan_pengadaan = $fileName;
               $und->tanggal_tandatanganpengadaan = Carbon::now();
               $und->save();

               return 'Tanda Tangan Pengadaan Berhasil.';
          } else {
               return 'Tanda Tangan Gagal karena tanda tangan tidak ada.';
          }
     }
}
