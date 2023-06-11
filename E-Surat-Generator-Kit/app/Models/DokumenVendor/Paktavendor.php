<?php

namespace App\Models\DokumenVendor;

use App\Models\KelengkapanDokumenVendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paktavendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_dokumen',
        'pekerjaan',
        'tahun_anggaran',
        'nama',
        'jabatan',
        'nama_perusahaan',
        'atas_nama',
        'alamat',
        'telepon_fax',
        'email_perusahaan',
    ];

    public function kelengkapanDokumenVendor()
    {
        return $this->belongsTo(KelengkapanDokumenVendor::class, 'id_dokumen');
    }
}
