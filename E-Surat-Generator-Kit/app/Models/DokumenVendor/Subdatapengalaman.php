<?php

namespace App\Models\DokumenVendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdatapengalaman extends Model
{
    use HasFactory;
    protected $table = 'subdatapengalamen';

    protected $fillable = [
        'id_datapengalaman',
        'bidang_pekerjaan',
        'sub_bidang_pekerjaan',
        'lokasi',
        'nama_pemberi_tugas',
        'alamat_pemberi_tugas',
        'no_tanggal_kontrak',
        'nilai',
        'kontrak',
        'ba_serah_terima',
    ];

    public function datapengalaman()
    {
        return $this->belongsTo(Datapengalaman::class, 'id_datapengalaman');
    }
}
