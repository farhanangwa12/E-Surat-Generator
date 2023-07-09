<?php

namespace App\Models;

use App\Models\DokumenVendor\Datapengalaman;

use App\Models\DokumenVendor\Formpenawaranharga;

use App\Models\DokumenVendor\Lampiranpenawaranharga;
use App\Models\DokumenVendor\Neraca;
use App\Models\DokumenVendor\Paktavendor;
use App\Models\DokumenVendor\Pernyataangaransi;
use App\Models\DokumenVendor\PernyataanKesanggupan;
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
    protected $casts = [
        'data_dokumen' => 'json',
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
        return $this->hasOne(Lampiranpenawaranharga::class, 'id_dokumen');
    }
    public function paktavendor()
    {
        return $this->hasOne(Paktavendor::class, 'id_dokumen');
    }
    public function pernyataanKesanggupan()
    {
        return $this->hasOne(PernyataanKesanggupan::class, 'id_dokumen');
    }
    public function pernyataanGaransi()
    {
        return $this->hasOne(Pernyataangaransi::class, 'id_dokumen');
    }

    public function neraca()
    {
        return $this->hasOne(Neraca::class, 'id_dokumen');
    }
    public function dataPengalaman()
    {
        return $this->hasOne(Datapengalaman::class, 'id_dokumen', 'id_dokumen');
    }
    public function formPenawaranHarga()
    {
        return $this->hasOne(Formpenawaranharga::class, 'id_dokumen');
    }
}
