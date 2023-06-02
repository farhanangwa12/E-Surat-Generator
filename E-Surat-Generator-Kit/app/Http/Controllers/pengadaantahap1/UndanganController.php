<?php

namespace App\Http\Controllers\pengadaantahap1;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\UND;
use App\Models\KontrakKerja;
use App\Models\PembuatanSuratKontrak;
use App\Models\Penyelenggara;
use App\Models\TandaTangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Terbilang;

require_once base_path('vendor/tcpdf/tcpdf.php');


class UndanganController extends Controller
{
     public function refresh($id)
     {

          // Mengecek apakah record und ada
          $und = UND::where('id_kontrakkerja', $id)->first();


          if (!$und) {
               // Buat instance und model untuk menyimpan data
               $und1 = new UND();
               $und1->id_kontrakkerja = $id; // Mengambil nilai id dari $id
               $und1->tandatangan_pengadaan = null; // Mengatur nilai tandatangan_pengadaan sebagai null
               $und1->tanggal_tandatangan_pengadaan = null; // Mengatur nilai tanggal_tandatangan_pengadaan sebagai null
               $und1->save();
          }

          return 'Data Telah Direfresh';
     }
     // Undangan Ada backup
     // Undangan
     public function Undangan($id, $isDownload)
     {
          $this->refresh($id);

          $kontrak = KontrakKerja::with('vendor')->find($id);
          $surat =  PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'nomor_undangan')->first();
          $rksnama_pekerjaan = $kontrak->nama_pekerjaan .  "PT PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR";
          $tanggalbataspenawaran = PembuatanSuratKontrak::where('id_kontrakkerja', $id)->where('nama_surat', 'batas_akhir_dokumen_penawaran')->first()->tanggal_pembuatan;
          $masterharitanggal = Carbon::createFromFormat('Y-m-d', $tanggalbataspenawaran)->locale('id')->isoFormat('dddd / D MMMM YYYY');

          $data = [
               'logokiri' => public_path('undangan/kiri.jpg'),
               'logo' => public_path('undangan/logo.png'), // path ke file header gambar
               // 'tandatangan' =>   DNS2D::getBarcodePNG('4', 'QRCODE'),
               'nomor' => $surat->no_surat,
               'tanggal_und' => 'Kupang, ' . Carbon::createFromFormat('Y-m-d', $surat->tanggal_pembuatan)->locale('id')->isoFormat('DD MMMM YYYY'),
               'alamat_jalan' => $kontrak->vendor->alamat_jalan,
               'alamat_kotaprovinsi' => $kontrak->vendor->alamat_kota . ' , ' . $kontrak->vendor->alamat_provinsi,
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

          $namefile = 'UND_' . time() . '.pdf';
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
     public function tandatangan($id, $jenis)
     {
 
 
         $und = UND::where('id_kontrakkerja', $id)->first();
 
 
         $authId = Auth::id(); // Mendapatkan ID dari sesi pengguna yang terotentikasi
         $tandatangan = TandaTangan::where('id_akun', $authId)->first();
 
         if (!$tandatangan) {
             return redirect()->route('tandatangan.detail')->withErrors('Tandatangan belum dibuat.');
         }
 
         $kodeUnik = $tandatangan->kode_unik;
 
         $und2 = UND::find($und->id);
         if ($jenis === 'pengadaan') {
             $und2->tandatangan_pengadaan = $kodeUnik;
             $und2->tanggal_tandatangan_pengadaan = Carbon::now('Asia/Jakarta');
         } elseif ($jenis === 'manager') {
            
         }
 
         $und2->save();
 
         return redirect()->route('tandatangan.detail', ['id' => $id])->with('success', 'Tanda Tangan Berhasil');
     }
}
