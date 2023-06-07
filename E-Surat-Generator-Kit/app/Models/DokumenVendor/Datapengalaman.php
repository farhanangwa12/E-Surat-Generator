<?php

namespace App\Models\DokumenVendor;

use App\Models\KelengkapanDokumenVendor;
use App\Models\Subdatapengalaman;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapengalaman extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_dokumen',
        'bidang_pekerjaan',
        'sub_bidang_pekerjaan',
        'lokasi',
        'nama_pemberi_tugas',
        'alamat_pemberi_tugas',
        'no_tanggal_kontrak',
        'nilai_kontrak',
        'ba_serah_terima',
    ];

    public function kelengkapanDokumenVendor()
    {
        return $this->belongsTo(KelengkapanDokumenVendor::class, 'id_dokumen', 'id_dokumen');
    }


    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }
    
    public function subdatapengalamen()
    {
        return $this->hasMany(Subdatapengalaman::class, 'id_datapengalaman');
    }
}
