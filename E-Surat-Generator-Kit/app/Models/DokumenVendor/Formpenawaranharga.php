<?php

namespace App\Models\DokumenVendor;

use App\Models\KelengkapanDokumenVendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formpenawaranharga extends Model
{
    use HasFactory;
    protected $table = 'form_penawaran_harga'; // Ganti 'nama_tabel' dengan nama tabel yang digunakan


    protected $fillable = [
        'id_dokumen',
        'kopsurat',
        'kopsuratpath',
        'nomor',
        'lampiran',
        'nama_kota',
        'tanggal_pembuatan_surat',
        'data_surat'
        // 'nama_vendor',
        // 'jabatan',
        // 'nama_perusahaan',
 
        // 'alamat_perusahaan',
        // 'telepon_fax',
        // 'email_perusahaan',
        // 'harga_penawaran',
        // 'ppn11',
        // 'jumlah_harga',
        // 'tanggal_tandatangan',
    ];
    protected $casts = [
        'data_surat' => 'json'
    ];
    public function dokumen()
    {
        return $this->belongsTo(KelengkapanDokumenVendor::class, 'id_dokumen');
    }
}
