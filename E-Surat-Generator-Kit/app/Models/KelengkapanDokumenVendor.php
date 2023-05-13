<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelengkapanDokumenVendor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_dokumen';
    protected $fillable = [
        'id_jenis_dokumen', 'id_vendor', 'file', 'tanggal_upload'
    ];
    public function jenisdokumen()
    {
        $this->belongsTo(JenisDokumenKelengkapan::class, 'id_jenis', 'id_jenis_dokumen');
    }

    public function kelengkapandokumen()
    {
        $this->belongsTo(Vendor::class,'id_vendor','id_vendor');
    }
}
