<?php

namespace App\Models;

use App\Models\DokumenVendor\Lampiranpenawaranharga;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelengkapanDokumenVendor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_dokumen';

    protected $fillable = [
        'id_jenis_dokumen',
        'id_vendor',
        'id_kontrakkerja',
        'file_upload',
        'tandatangan',
        'data_dokumen',
    ];
    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumenKelengkapan::class, 'id_jenis_dokumen', 'id_jenis');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function kontrakKerja()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }

    public function lampiranPenawaranHargas()
    {
        return $this->hasMany(Lampiranpenawaranharga::class, 'id_dokumen');
    }
}
