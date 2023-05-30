<?php

namespace App\Models;

use App\Models\FormPenawaran\FormPenawaranHarga;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_vendor';
    protected $fillable = [
        'penyedia', 'direktur', 'alamat', 'bank', 'nomor_rek', 'alamat_jalan', 'alamat_kota', 'alamat_provinsi', 'telepon', 'webiste', 'faksimili', 'email_perusahaan'

    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }


    public function kelengkapandokumen()
    {
        return $this->hasMany(KelengkapanDokumenVendor::class, 'id_vendor', 'id_vendor');
    }

    public function dokumenkontrak()
    {
        return $this->hasMany(KontrakKerja::class, 'id_vendor', 'id_vendor');
    }


    // Form Penawaran Harga
    // Model Vendor
    public function formPenawaranHarga()
    {
        return $this->hasMany(FormPenawaranHarga::class, 'id_vendor');
    }
}
