<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_vendor';
    protected $fillable = [
        'id_akun', 'penyedia', 'direktur', 'alamat', 'bank', 'nomor_rek', 'alamat_jalan','alamat_kota','alamat_provinsi'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kelengkapandokumen()
    {
        return $this->hasMany(KelengkapanDokumenVendor::class,'id_vendor','id_vendor');
    }

    public function dokumenkontrak()
    {
        return $this->hasMany(KontrakKerja::class, 'id_vendor','id_vendor');
    }
}
