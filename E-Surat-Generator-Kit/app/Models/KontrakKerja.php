<?php

namespace App\Models;

use App\Models\SubKontrak\JenisKontrak;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakKerja extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kontrakkerja';
    protected $fillable = [
        'nama_kontrak', 'id_vendor', 'tanggal_pekerjaan', 'tanggal_akhir_pekerjaan','lokasi_pekerjaan','no_urut','tahun','kode_masalah', 'filemaster'
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }
    public function pembuatansuratkontrak()
    {
        return $this->hasOne(PembuatanSuratKontrak::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }
    public function penyelenggara()
    {
        return $this->hasOne(Penyelenggara::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }
    public function sumberanggaran()
    {
        return $this->hasOne(SumberAnggaran::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }

    public function tandatangan()
    {
        return $this->hasOne(TandaTangan::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }


    // Relasi dengan jenis_kontrak
    public function jenis_kontrak()
    {
        return $this->hasMany(JenisKontrak::class, 'id_kontrak');
    }
}
