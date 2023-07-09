<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataVendor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [

        'id_vendor',
        'penyedia',
        'direktur',
        'alamat_jalan',
        'alamat_kota',
        'alamat_provinsi',
        'bank',
        'nomor_rek',
        'telepon',
        'website',
        'faksimili',
        'email_perusahaan',
        'pengawas_pekerjaan',
        'pengawas_k3'
    ];

    public function kontrakKerja()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrakkerja');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor');
    }
}
